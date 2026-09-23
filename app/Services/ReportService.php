<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\ServiceRequest;
use App\Models\CourseEnrollment;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Retorna os principais indicadores para o Dashboard Administrativo (Seção 48 e 49).
     */
    public function getAdminKpis(?int $businessUnitId = null): array
    {
        $orderQuery = Order::query();
        $requestQuery = ServiceRequest::query();
        $productQuery = Product::query();

        if ($businessUnitId) {
            $orderQuery->where('business_unit_id', $businessUnitId);
            $requestQuery->where('business_unit_id', $businessUnitId);
            $productQuery->where('business_unit_id', $businessUnitId);
        }

        $totalSales = (clone $orderQuery)->where('payment_status', 'paid')->sum('total');
        $totalOrders = (clone $orderQuery)->count();
        $openRequests = (clone $requestQuery)->whereNotIn('status', ['completed', 'cancelled'])->count();
        $completedRequests = (clone $requestQuery)->where('status', 'completed')->count();
        $lowStockProducts = (clone $productQuery)->whereColumn('stock_quantity', '<=', 'minimum_stock')->count();
        $totalCustomers = Customer::count();
        $totalEmployees = Employee::count();
        $totalEnrollments = CourseEnrollment::count();

        return [
            'total_sales' => $totalSales,
            'total_sales_formatted' => number_format($totalSales, 2, ',', '.') . ' AOA',
            'total_orders' => $totalOrders,
            'open_requests' => $openRequests,
            'completed_requests' => $completedRequests,
            'low_stock_products' => $lowStockProducts,
            'total_customers' => $totalCustomers,
            'total_employees' => $totalEmployees,
            'total_enrollments' => $totalEnrollments,
        ];
    }
}
