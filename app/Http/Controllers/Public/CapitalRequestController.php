<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\{BusinessUnit, Customer, Role, Service, ServiceRequest, ServiceRequestStatusHistory, User};
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\{Rule, ValidationException};

class CapitalRequestController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $services = collect(BusinessUnitController::getCapitalServices())->keyBy('slug');
        $data = $request->validate([
            'nome' => 'required|string|max:255', 'telefone' => 'required|string|max:40',
            'email' => 'nullable|email|max:255', 'empresa' => 'nullable|string|max:255',
            'servico' => 'required|string|max:255',
            'service_slug' => ['nullable', 'string', Rule::in($services->keys()->all())],
            'plano' => 'nullable|string|max:255', 'detalhes' => 'nullable|string|max:3000',
        ]);
        $phoneDigits = preg_replace('/\D/', '', $data['telefone']);
        if (strlen($phoneDigits) < 6 || strlen($phoneDigits) > 15) {
            throw ValidationException::withMessages(['telefone' => 'Indique um contacto telefónico válido.']);
        }
        return DB::transaction(function () use ($data, $services, $phoneDigits) {
            $unit = BusinessUnit::where('slug', 'capital')->firstOrFail();
            $address = !empty($data['email']) ? strtolower($data['email']) : 'capital-' . substr(hash('sha256', $phoneDigits), 0, 24) . '@contact.rachi.invalid';
            $user = User::firstOrCreate(['email' => $address], [
                'name' => $data['nome'], 'phone' => $data['telefone'],
                'password' => bcrypt(Str::random(32)), 'role_id' => Role::where('slug', 'customer')->firstOrFail()->id, 'status' => 'active',
            ]);
            $customer = Customer::firstOrCreate(['user_id' => $user->id], [
                'type' => !empty($data['empresa']) ? 'company' : 'individual',
                'company_name' => $data['empresa'] ?? null, 'trade_name' => $data['empresa'] ?? $data['nome'],
                'phone' => $data['telefone'], 'whatsapp' => $data['telefone'], 'status' => 'active',
            ]);
            $slug = $data['service_slug'] ?? null;
            $title = $slug ? $services[$slug]['title'] : $data['servico'];
            $description = collect([
                'Serviço: ' . $title, 'Solicitante: ' . $data['nome'],
                !empty($data['empresa']) ? 'Empresa: ' . $data['empresa'] : null,
                'Telefone / WhatsApp: ' . $data['telefone'],
                !empty($data['email']) ? 'E-mail: ' . $data['email'] : null,
                !empty($data['plano']) ? 'Plano / Opção: ' . $data['plano'] : null,
                !empty($data['detalhes']) ? "Detalhes da solicitação:\n" . $data['detalhes'] : null,
            ])->filter()->implode("\n");
            $record = ServiceRequest::create([
                'protocol' => 'TMP-' . Str::uuid(), 'customer_id' => $customer->id, 'business_unit_id' => $unit->id,
                'service_id' => $slug ? Service::where('business_unit_id', $unit->id)->where('slug', $slug)->value('id') : null,
                'title' => Str::limit('Human Capital: ' . $title, 255, ''), 'description' => $description,
                'status' => 'new', 'priority' => 'normal', 'requested_date' => now()->toDateString(),
            ]);
            $protocol = sprintf('SOL-%s-%06d', now()->year, $record->id);
            $record->update(['protocol' => $protocol]);
            ServiceRequestStatusHistory::create([
                'service_request_id' => $record->id, 'user_id' => $user->id, 'old_status' => null, 'new_status' => 'new',
                'comment' => 'Solicitação enviada pelo site Human Capital: ' . $title,
            ]);
            return response()->json(['success' => true, 'protocol' => $protocol, 'request_id' => $record->id, 'message' => 'Solicitação registada. A nossa equipa entrará em contacto.']);
        });
    }
}
