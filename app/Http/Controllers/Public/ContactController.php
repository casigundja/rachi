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

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Mensagem recebida. A nossa equipa responderá em breve.',
            ]);
        }

        return redirect('/contacto?enviado=1')->with('success', 'Obrigado pelo seu contacto! A nossa equipa responderá em breve.');
    }
}
