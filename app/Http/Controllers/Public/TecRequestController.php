<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\{BusinessUnit, Customer, Role, Service, ServiceRequest, ServiceRequestStatusHistory, User};
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TecRequestController extends Controller
{
    public function store(Request $request)
    {
        $raw = json_decode($request->getContent(), true);
        if (is_array($raw)) {
            $request->merge($raw);
        }

        $nome = trim($request->input('name', $request->input('nome', '')));
        $telefone = trim($request->input('phone', $request->input('telefone', '')));
        $email = trim($request->input('email', ''));
        $empresa = trim($request->input('empresa', $request->input('company', '')));
        $servico = trim($request->input('servico', $request->input('assunto', $request->input('service_name', ''))));
        $serviceSlug = trim($request->input('service_slug', ''));
        $plano = trim($request->input('plano_selecionado', $request->input('plano', '')));
        $detalhes = trim($request->input('message', $request->input('mensagem', $request->input('detalhes', ''))));

        if (empty($nome)) {
            throw ValidationException::withMessages(['name' => 'Por favor, indique o seu nome.']);
        }

        $phoneDigits = preg_replace('/\D/', '', $telefone);
        if (strlen($phoneDigits) < 6 || strlen($phoneDigits) > 15) {
            throw ValidationException::withMessages(['phone' => 'Indique um contacto telefónico válido.']);
        }

        $result = DB::transaction(function () use ($nome, $telefone, $email, $empresa, $servico, $serviceSlug, $plano, $detalhes, $phoneDigits) {
            $unit = BusinessUnit::where('slug', 'tec')->firstOrFail();

            $address = !empty($email) ? strtolower($email) : 'tec-' . substr(hash('sha256', $phoneDigits), 0, 20) . '@contact.rachi.ao';
            $user = User::firstOrCreate(['email' => $address], [
                'name' => $nome,
                'phone' => $telefone,
                'password' => bcrypt(Str::random(32)),
                'role_id' => Role::where('slug', 'customer')->first()?->id ?? 6,
                'status' => 'active',
            ]);

            $customer = Customer::firstOrCreate(['user_id' => $user->id], [
                'type' => !empty($empresa) ? 'company' : 'individual',
                'company_name' => !empty($empresa) ? $empresa : null,
                'trade_name' => !empty($empresa) ? $empresa : $nome,
                'phone' => $telefone,
                'whatsapp' => $telefone,
                'status' => 'active',
            ]);

            if (!empty($empresa) && empty($customer->company_name)) {
                $customer->update(['company_name' => $empresa, 'type' => 'company']);
            }

            $title = !empty($servico) ? $servico : 'Solicitação de Tecnologia & Consultoria';

            $description = collect([
                '🖥️ Unidade: RACHI Tec',
                '📌 Serviço / Assunto: ' . $title,
                '👤 Solicitante: ' . $nome,
                !empty($empresa) ? '🏢 Empresa: ' . $empresa : null,
                '📞 Contacto: ' . $telefone,
                !empty($email) ? '✉️ Email: ' . $email : null,
                !empty($plano) ? '⭐ Plano / Modalidade: ' . $plano : null,
                !empty($detalhes) ? "\n📝 Detalhes da Demanda:\n" . $detalhes : null,
            ])->filter()->implode("\n");

            $serviceId = null;
            if ($serviceSlug) {
                $serviceId = Service::where('business_unit_id', $unit->id)->where('slug', $serviceSlug)->value('id');
            }

            $record = ServiceRequest::create([
                'protocol' => 'TMP-' . Str::uuid(),
                'customer_id' => $customer->id,
                'business_unit_id' => $unit->id,
                'service_id' => $serviceId,
                'title' => Str::limit($title, 255, ''),
                'description' => $description,
                'status' => 'new',
                'priority' => 'normal',
                'requested_date' => now()->toDateString(),
            ]);

            $protocol = sprintf('TEC-%s-%06d', now()->year, $record->id);
            $record->update(['protocol' => $protocol]);

            ServiceRequestStatusHistory::create([
                'service_request_id' => $record->id,
                'user_id' => $user->id,
                'old_status' => null,
                'new_status' => 'new',
                'comment' => 'Formulário preenchido na página RACHI Tec (' . $title . ')',
                'created_at' => now(),
            ]);

            return [
                'success' => true,
                'protocol' => $protocol,
                'request_id' => $record->id,
                'message' => "Solicitação registada com sucesso! O protocolo é {$protocol}. A equipa da RACHI Tec responderá em breve.",
            ];
        });

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json($result);
        }

        return redirect()->back()->with('success', $result['message']);
    }
}
