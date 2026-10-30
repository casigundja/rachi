<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ComplaintReportController extends Controller
{
    /**
     * Ensure table exists even if migrations haven't been executed manually yet.
     */
    private function ensureTableExists(): void
    {
        if (Schema::hasTable('complaints_reports')) {
            return;
        }

        Schema::create('complaints_reports', function (Blueprint $table) {
            $table->id();
            $table->string('protocol', 32)->unique();
            $table->string('type', 20)->index();
            $table->boolean('is_anonymous')->default(false);
            $table->string('business_unit', 80)->nullable();
            $table->string('category', 120);
            $table->string('order_or_invoice_ref', 80)->nullable();
            $table->date('incident_date')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 40)->nullable();
            $table->string('nif_or_company', 160)->nullable();
            $table->string('subject', 255);
            $table->text('description');
            $table->unsignedBigInteger('attachment_id')->nullable();
            $table->string('attachment_name', 255)->nullable();
            $table->string('attachment_mime', 100)->nullable();
            $table->string('status', 30)->default('recebido')->index();
            $table->text('response_notes')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });
    }

    public function index(Request $request): View
    {
        $initialTab = in_array($request->query('tipo'), ['reclamacao', 'denuncia', 'consultar'], true)
            ? $request->query('tipo')
            : 'reclamacao';

        return view('public.legal.complaints', [
            'initialTab' => $initialTab,
        ]);
    }

    public function store(Request $request)
    {
        $this->ensureTableExists();

        $raw = json_decode($request->getContent(), true);
        if (is_array($raw) && empty($request->allFiles())) {
            $request->merge($raw);
        }

        $type = $request->input('type', 'reclamacao');
        if (!in_array($type, ['reclamacao', 'denuncia'], true)) {
            $type = 'reclamacao';
        }

        $isAnonymous = $type === 'denuncia' && filter_var($request->input('is_anonymous', false), FILTER_VALIDATE_BOOLEAN);

        // Auto-generate subject from category + unit if not explicitly sent
        if (!$request->filled('subject') && $request->filled('category')) {
            $autoSubject = trim($request->input('category') . ' — ' . $request->input('business_unit', 'RACHI'));
            $request->merge(['subject' => mb_substr($autoSubject, 0, 255)]);
        }

        $rules = [
            'type' => 'required|in:reclamacao,denuncia',
            'business_unit' => 'required|string|max:80',
            'category' => 'required|string|max:120',
            'order_or_invoice_ref' => 'nullable|string|max:80',
            'incident_date' => 'nullable|date',
            'subject' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10|max:6000',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
        ];

        if ($isAnonymous) {
            $rules['name'] = 'nullable|string|max:255';
            $rules['email'] = 'nullable|email|max:255';
            $rules['phone'] = 'nullable|string|max:40';
            $rules['nif_or_company'] = 'nullable|string|max:160';
        } else {
            $rules['name'] = 'required|string|min:2|max:255';
            $rules['email'] = 'required|email|max:255';
            $rules['phone'] = 'nullable|string|max:40';
            $rules['nif_or_company'] = 'nullable|string|max:160';
        }

        $messages = [
            'business_unit.required' => 'Seleccione a unidade de negócio ou área relacionada.',
            'category.required' => 'Seleccione a categoria da ocorrência.',
            'name.required' => 'Introduza o seu nome completo ou razão social.',
            'email.required' => 'Introduza um endereço de e-mail válido para resposta formal.',
            'email.email' => 'Introduza um endereço de e-mail válido.',
            'subject.required' => 'Introduza o título ou assunto resumido.',
            'subject.min' => 'O assunto deve ter pelo menos 5 caracteres.',
            'description.required' => 'Descreva brevemente o ocorrido.',
            'description.min' => 'A descrição deve ter pelo menos 10 caracteres.',
            'attachment.mimes' => 'O ficheiro anexo deve estar em formato PDF, JPG, PNG ou WEBP.',
            'attachment.max' => 'O ficheiro anexo não pode exceder 5 MB.',
        ];

        $validated = $request->validate($rules, $messages);

        // Generate unique cryptographic protocol
        $prefix = $type === 'denuncia' ? 'DEN' : 'REC';
        $year = date('Y');
        do {
            $code = strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));
            $protocol = "{$prefix}-{$year}-{$code}";
        } while (DB::table('complaints_reports')->where('protocol', $protocol)->exists());

        // Optional attachment handling via worker_attachments
        $attachmentId = null;
        $attachmentName = null;
        $attachmentMime = null;

        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            try {
                $file = $request->file('attachment');
                $attachmentName = mb_substr($file->getClientOriginalName(), 0, 255);
                $attachmentMime = $file->getMimeType() ?: 'application/octet-stream';

                if (Schema::hasTable('worker_attachments')) {
                    $attachmentId = DB::table('worker_attachments')->insertGetId([
                        'service_request_id' => null,
                        'user_id' => null,
                        'name' => "[{$protocol}] {$attachmentName}",
                        'mime_type' => $attachmentMime,
                        'content' => base64_encode(file_get_contents($file->getRealPath())),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } catch (\Throwable $e) {
                Log::warning('Não foi possível guardar anexo de reclamação/denúncia: ' . $e->getMessage());
            }
        }

        $now = now();

        DB::table('complaints_reports')->insert([
            'protocol' => $protocol,
            'type' => $type,
            'is_anonymous' => $isAnonymous,
            'business_unit' => $validated['business_unit'],
            'category' => $validated['category'],
            'order_or_invoice_ref' => $validated['order_or_invoice_ref'] ?? null,
            'incident_date' => $validated['incident_date'] ?? null,
            'name' => $isAnonymous ? null : ($validated['name'] ?? null),
            'email' => $isAnonymous ? null : ($validated['email'] ?? null),
            'phone' => $isAnonymous ? null : ($validated['phone'] ?? null),
            'nif_or_company' => $isAnonymous ? null : ($validated['nif_or_company'] ?? null),
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'attachment_id' => $attachmentId,
            'attachment_name' => $attachmentName,
            'attachment_mime' => $attachmentMime,
            'status' => 'recebido',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Mirror summary into worker_contacts so Admin Dashboard receives immediate alert
        try {
            if (Schema::hasTable('worker_contacts')) {
                $typeBadge = $type === 'denuncia'
                    ? ($isAnonymous ? 'DENÚNCIA ANÓNIMA' : 'DENÚNCIA CONFIDENCIAL')
                    : 'RECLAMAÇÃO';

                $summaryLines = [
                    "Protocolo: {$protocol}",
                    "Tipo: {$typeBadge}",
                    "Unidade: {$validated['business_unit']}",
                    "Categoria: {$validated['category']}",
                ];
                if (!empty($validated['order_or_invoice_ref'])) {
                    $summaryLines[] = "Ref. Factura/Pedido: {$validated['order_or_invoice_ref']}";
                }
                if (!empty($validated['incident_date'])) {
                    $summaryLines[] = "Data da Ocorrência: {$validated['incident_date']}";
                }
                if (!$isAnonymous && !empty($validated['nif_or_company'])) {
                    $summaryLines[] = "Empresa / NIF: {$validated['nif_or_company']}";
                }
                if ($attachmentName) {
                    $summaryLines[] = "Anexo: {$attachmentName} (ID #{$attachmentId})";
                }
                $summaryLines[] = "---";
                $summaryLines[] = $validated['description'];

                DB::table('worker_contacts')->insert([
                    'name' => $isAnonymous ? 'Relato Anónimo (Canal de Ética)' : ($validated['name'] ?? 'Utente RACHI'),
                    'email' => $isAnonymous ? 'anonimo@compliance.rachi.ao' : ($validated['email'] ?? 'sem-email@rachi.ao'),
                    'phone' => $isAnonymous ? null : ($validated['phone'] ?? null),
                    'subject' => "[{$typeBadge} #{$protocol}] {$validated['subject']}",
                    'message' => implode("\n", $summaryLines),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('Falha ao espelhar reclamação/denúncia em worker_contacts: ' . $e->getMessage());
        }

        $slaLabel = $type === 'denuncia'
            ? 'Triagem confidencial pelo Comité de Ética e Compliance em até 48 horas úteis.'
            : 'Resposta formal pela equipa de Qualidade e Atendimento em até 5 dias úteis.';

        if ($request->expectsJson() || $request->ajax() || $request->is('api/*')) {
            return response()->json([
                'ok' => true,
                'protocol' => $protocol,
                'type' => $type,
                'is_anonymous' => $isAnonymous,
                'business_unit' => $validated['business_unit'],
                'category' => $validated['category'],
                'created_at' => $now->format('d/m/Y H:i'),
                'sla_label' => $slaLabel,
                'message' => $type === 'denuncia'
                    ? 'A sua comunicação foi registada com total confidencialidade no Canal de Ética e Denúncia da RACHI.'
                    : 'A sua reclamação foi registada com sucesso e encaminhada para tratamento prioritário.',
            ]);
        }

        return redirect()
            ->route('legal.complaints', ['protocolo' => $protocol])
            ->with('success_protocol', $protocol);
    }

    public function lookup(Request $request): JsonResponse
    {
        $this->ensureTableExists();

        $protocol = strtoupper(trim((string) $request->query('protocol', $request->input('protocol', ''))));

        if ($protocol === '' || strlen($protocol) < 8) {
            return response()->json([
                'ok' => false,
                'message' => 'Introduza um número de protocolo válido (ex.: REC-2026-A1B2C ou DEN-2026-A1B2C).',
            ], 422);
        }

        $record = DB::table('complaints_reports')
            ->where('protocol', $protocol)
            ->first();

        if (!$record) {
            return response()->json([
                'ok' => false,
                'message' => 'Não foi encontrado nenhum registo com o protocolo indicado. Verifique o código e tente novamente.',
            ], 404);
        }

        $statusMap = [
            'recebido' => 'Recebido — Aguarda Triagem Inicial',
            'em_analise' => 'Em Análise pelo Departamento Responsável',
            'respondido' => 'Respondido / Parecer Emitido',
            'encerrado' => 'Concluído e Arquivado',
        ];

        return response()->json([
            'ok' => true,
            'record' => [
                'protocol' => $record->protocol,
                'type' => $record->type,
                'type_label' => $record->type === 'denuncia' ? 'Denúncia de Ética & Compliance' : 'Reclamação de Cliente / Utente',
                'is_anonymous' => (bool) $record->is_anonymous,
                'business_unit' => $record->business_unit,
                'category' => $record->category,
                'subject' => $record->subject,
                'status' => $record->status,
                'status_label' => $statusMap[$record->status] ?? ucfirst($record->status),
                'response_notes' => $record->response_notes,
                'created_at' => \Carbon\Carbon::parse($record->created_at)->format('d/m/Y H:i'),
                'updated_at' => \Carbon\Carbon::parse($record->updated_at)->format('d/m/Y H:i'),
            ],
        ]);
    }
}

