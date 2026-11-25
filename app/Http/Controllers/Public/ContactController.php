<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('public.contact');
    }

    public function send(Request $request)
    {
        $raw = json_decode($request->getContent(), true);
        if (is_array($raw)) {
            $request->merge($raw);
        }

        $request->merge([
            'name' => $request->input('name', $request->input('nome')),
            'phone' => $request->input('phone', $request->input('telefone')),
            'subject' => $request->input('subject', $request->input('assunto', $request->input('unidade', 'Contacto Geral'))),
            'message' => $request->input('message', $request->input('mensagem')),
        ]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:3000',
        ]);

        \Illuminate\Support\Facades\DB::table('worker_contacts')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        $subjectLower = mb_strtolower($data['subject']);
        $unitParam = mb_strtolower((string)$request->input('unidade', ''));
        if (str_contains($subjectLower, 'tec') || str_contains($subjectLower, 'adesão ao serviço') || str_contains($subjectLower, 'tecnologia') || str_contains($unitParam, 'tec') || $request->input('business_unit_id') == 1) {
            try {
                app(\App\Http\Controllers\Public\TecRequestController::class)->store($request);
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning('Falha ao espelhar contacto Tec em ServiceRequest: ' . $e->getMessage());
            }
        }

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Mensagem recebida. A nossa equipa responderá em breve.',
            ]);
        }

        return redirect('/contacto?enviado=1')->with('success', 'Obrigado pelo seu contacto! A nossa equipa responderá em breve.');
    }

    public function crmLead(Request $request)
    {
        $raw = json_decode($request->getContent(), true);
        if (is_array($raw)) {
            $request->merge($raw);
        }

        $name = (string)$request->input('name', $request->input('nome', 'Visitante Chat IA'));
        $phone = (string)$request->input('phone', $request->input('telefone', 'Não informado'));
        $email = (string)$request->input('email', '');
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = 'lead.chat@rachi.ao';
        }
        $subject = (string)$request->input('subject', $request->input('assunto', 'Lead Capturado — Chat IA CRM'));
        $message = (string)$request->input('message', $request->input('mensagem', 'Lead gerado pelo Chat IA no website.'));

        \Illuminate\Support\Facades\DB::table('worker_contacts')->insert([
            'name' => mb_substr($name, 0, 120),
            'email' => mb_substr($email, 0, 120),
            'phone' => mb_substr($phone, 0, 40),
            'subject' => mb_substr($subject, 0, 150),
            'message' => mb_substr($message, 0, 5000),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lead registado com sucesso no CRM!',
        ]);
    }
}
