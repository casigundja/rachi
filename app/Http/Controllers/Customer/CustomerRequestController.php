<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequestRequest;
use App\Models\BusinessUnit;
use App\Models\Message;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Services\FileService;
use App\Services\ServiceRequestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerRequestController extends Controller
{
    protected ServiceRequestService $requestService;
    protected FileService $fileService;

    public function __construct(ServiceRequestService $requestService, FileService $fileService)
    {
        $this->requestService = $requestService;
        $this->fileService = $fileService;
    }

    public function index(): View
    {
        $customerId = auth()->user()->customer?->id ?? 0;
        $requests = ServiceRequest::where('customer_id', $customerId)
            ->with(['businessUnit', 'service'])
            ->latest()
            ->paginate(15);

        return view('customer.requests.index', compact('requests'));
    }

    public function create(): View
    {
        $units = BusinessUnit::active()->get();
        $services = Service::where('status', 'active')->with('businessUnit')->get();

        return view('customer.requests.create', compact('units', 'services'));
    }

    public function store(StoreServiceRequestRequest $request): RedirectResponse
    {
        $customer = auth()->user()->customer;
        if (!$customer) {
            return back()->with('error', 'Registo de cliente não encontrado para o seu utilizador.');
        }

        $serviceRequest = $this->requestService->create(
            $request->validated(),
            $customer->id,
            $request->business_unit_id
        );

        if ($request->hasFile('attachment')) {
            $this->fileService->upload(
                $request->file('attachment'),
                $serviceRequest,
                auth()->id()
            );
        }

        return redirect()
            ->route('customer.requests.show', $serviceRequest->id)
            ->with('success', "Solicitação #{$serviceRequest->protocol} criada com sucesso.");
    }

    public function show(ServiceRequest $serviceRequest): View
    {
        abort_unless((int) $serviceRequest->customer_id === (int) (auth()->user()->customer?->id ?? 0), 403);
        $serviceRequest->load(['businessUnit', 'service', 'assignedEmployee.user', 'statusHistories.user', 'quotes.items', 'messages.user', 'files']);

        return view('customer.requests.show', ['request' => $serviceRequest]);
    }

    public function sendMessage(Request $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        abort_unless((int) $serviceRequest->customer_id === (int) (auth()->user()->customer?->id ?? 0), 403);
        $request->validate(['message' => 'required|string|max:2000']);

        Message::create([
            'service_request_id' => $serviceRequest->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return back()->with('success', 'Mensagem enviada com sucesso.');
    }

}
