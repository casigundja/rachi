<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Order;
use Illuminate\View\View;

class EmployeeDashboardController extends Controller
{
    public function index(): View
    {
        $newCount = ServiceRequest::where('status', 'new')->count();
        $analysisCount = ServiceRequest::where('status', 'in_analysis')->count();
        $inProgressCount = ServiceRequest::where('status', 'in_progress')->count();
        $waitingCount = ServiceRequest::where('status', 'waiting_customer')->count();
        $completedCount = ServiceRequest::where('status', 'completed')->count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();

        $requests = ServiceRequest::with(['customer.user', 'businessUnit', 'assignedEmployee.user'])
            ->latest()
            ->take(10)
            ->get();

        return view('employee.dashboard', compact(
            'newCount',
            'analysisCount',
            'inProgressCount',
            'waitingCount',
            'completedCount',
            'pendingOrdersCount',
            'requests'
        ));
    }
}
