<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Get sales data for a given period.
     */
    public function getSalesData(string $period = 'monthly', ?Carbon $startDate = null, ?Carbon $endDate = null): array
    {
        $query = Order::whereNotIn('status', ['cancelled']);

        if ($startDate) {
            $query->where('created_at', '>=', $startDate->startOfDay());
        }

        if ($endDate) {
            $query->where('created_at', '<=', $endDate->endOfDay());
        }

        $orders = $query->get();

        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total');
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // Group by period
        $groupedData = [];

        if ($period === 'daily') {
            $groupedData = $orders->groupBy(function ($order) {
                return $order->created_at->format('Y-m-d');
            })->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'revenue' => $group->sum('total'),
                ];
            })->toArray();
        } elseif ($period === 'weekly') {
            $groupedData = $orders->groupBy(function ($order) {
                return $order->created_at->format('Y-W');
            })->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'revenue' => $group->sum('total'),
                ];
            })->toArray();
        } else {
            // monthly
            $groupedData = $orders->groupBy(function ($order) {
                return $order->created_at->format('Y-m');
            })->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'revenue' => $group->sum('total'),
                ];
            })->toArray();
        }

        return [
            'total_orders' => $totalOrders,
            'total_revenue' => $totalRevenue,
            'average_order_value' => $averageOrderValue,
            'grouped_data' => $groupedData,
        ];
    }

    /**
     * Get top selling products.
     */
    public function getTopProducts(int $limit = 10): Collection
    {
       return Product::select('products.id', 'products.name', 'products.price', 'products.image')
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->selectRaw('SUM(order_items.subtotal) as total_revenue')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereNotIn('orders.status', ['cancelled'])
            ->groupBy('products.id', 'products.name', 'products.price', 'products.image')
            ->orderByDesc('total_sold')
            ->limit($limit)
            ->get();
    }

    /**
     * Get dashboard statistics.
     */
    public function getDashboardStats(): array
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::whereNotIn('status', ['cancelled'])->sum('total');
        $totalCustomers = User::where('role', 'pelanggan')->count();
        $totalProducts = Product::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $todayRevenue = Order::whereDate('created_at', Carbon::today())
            ->whereNotIn('status', ['cancelled'])
            ->sum('total');

        return [
            'total_orders' => $totalOrders,
            'total_revenue' => $totalRevenue,
            'total_customers' => $totalCustomers,
            'total_products' => $totalProducts,
            'pending_orders' => $pendingOrders,
            'today_revenue' => $todayRevenue,
        ];
    }

    /**
     * Get monthly sales chart data for the last 12 months.
     */
    public function getMonthlySalesChart(): array
    {
        $labels = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->translatedFormat('M Y');

            $revenue = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->whereNotIn('status', ['cancelled'])
                ->sum('total');

            $data[] = (float) $revenue;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}
