<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\ServiceRequest;
use App\Services\QuoteService;
use App\Services\ServiceRequestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeRequestController extends Controller
{
    protected ServiceRequestService $requestService;
    protected QuoteService $quoteService;

    public function __construct(ServiceRequestService $requestService, QuoteService $quoteService)
    {
        $this->requestService = $requestService;
        $this->quoteService = $quoteService;
    }

    public function index(): View
    {
        $requests = ServiceRequest::with(['customer.user', 'businessUnit', 'assignedEmployee.user'])
            ->latest()
            ->paginate(20);

        return view('employee.dashboard', ['requests' => $requests]);
    }

    public function show(ServiceRequest $serviceRequest): View
    {
        $serviceRequest->load(['customer.user', 'businessUnit', 'service', 'assignedEmployee.user', 'statusHistories.user', 'quotes.items', 'messages.user', 'files']);

        return view('employee.requests.show', ['request' => $serviceRequest]);
    }

    public function assign(ServiceRequest $serviceRequest): RedirectResponse
    {
        $employee = auth()->user()->employee;
        if (!$employee) {
            return back()->with('error', 'Utilizador não tem perfil de funcionário.');
        }

        $this->requestService->assignToEmployee($serviceRequest, $employee->id, auth()->id());

        return back()->with('success', 'Chamado atribuído com sucesso!');
    }

    public function updateStatus(Request $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:in_analysis,waiting_customer,in_progress,in_review,completed,cancelled',
            'comment' => 'nullable|string'
        ]);

        $this->requestService->updateStatus($serviceRequest, $request->status, $request->comment, auth()->id());

        return back()->with('success', 'Estado atualizado com sucesso!');
    }

    public function sendMessage(Request $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        $request->validate(['message' => 'required|string|max:2000']);

        Message::create([
            'service_request_id' => $serviceRequest->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return back()->with('success', 'Mensagem enviada.');
    }

    public function storeQuote(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'service_request_id' => 'required|exists:service_requests,id',
            'customer_id' => 'required|exists:customers,id',
            'business_unit_id' => 'required|exists:business_units,id',
            'valid_until' => 'nullable|date',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $this->quoteService->create($data, $data['items'], auth()->id());

        return back()->with('success', 'Orçamento gerado e enviado ao cliente!');
    }
}
