<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Quote;
use App\Models\Order;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $customer = $user->customer;

        $customerId = $customer ? $customer->id : 0;

        $openRequestsCount = ServiceRequest::where('customer_id', $customerId)
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->count();

        $pendingQuotesCount = Quote::where('customer_id', $customerId)
            ->where('status', 'sent')
            ->count();

        $ordersCount = Order::where('customer_id', $customerId)->count();
        $activeCoursesCount = CourseEnrollment::where('customer_id', $customerId)->where('status', 'active')->count();

        $recentRequests = ServiceRequest::where('customer_id', $customerId)
            ->with('businessUnit')
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact(
            'openRequestsCount',
            'pendingQuotesCount',
            'ordersCount',
            'activeCoursesCount',
            'recentRequests'
        ));
    }
}
