<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $todayRevenue = Order::whereDate('created_at', Carbon::today())
            ->whereNotIn('status', ['cancelled'])
            ->sum('total');

        $recentPending = Order::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('kasir.dashboard', compact('todayOrders', 'pendingOrders', 'todayRevenue', 'recentPending'));
    }
}
