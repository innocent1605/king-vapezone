<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\ReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(Request $request)
    {
        $startDate = $request->filled('start_date') ? Carbon::parse($request->start_date) : Carbon::now()->startOfMonth();
        $endDate = $request->filled('end_date') ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();

        $salesData = $this->reportService->getSalesData('daily', $startDate, $endDate);
        $topProducts = $this->reportService->getTopProducts(10);

        $orders = Order::with(['user', 'items'])
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->whereNotIn('status', ['cancelled'])
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.reports.index', compact('salesData', 'topProducts', 'orders', 'startDate', 'endDate'));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->filled('start_date') ? Carbon::parse($request->start_date) : Carbon::now()->startOfMonth();
        $endDate = $request->filled('end_date') ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();

        $salesData = $this->reportService->getSalesData('daily', $startDate, $endDate);
        $topProducts = $this->reportService->getTopProducts(10);

        $orders = Order::with(['user', 'items'])
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->whereNotIn('status', ['cancelled'])
            ->latest()
            ->get();

        $data = [
            'startDate' => $startDate->format('d M Y'),
            'endDate' => $endDate->format('d M Y'),
            'salesData' => $salesData,
            'topProducts' => $topProducts,
            'orders' => $orders,
            'generatedAt' => now()->translatedFormat('d F Y, H:i:s'),
        ];

        // Check if DomPDF is available
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.sales-pdf', $data);
            return $pdf->download('Laporan-Penjualan-King-Vapezone-' . now()->format('YmdHis') . '.pdf');
        }

        // Clean HTML printable fallback if dompdf isn't installed yet
        return view('admin.reports.sales-pdf', $data);
    }
}
