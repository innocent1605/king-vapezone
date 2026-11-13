<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected WhatsAppService $whatsappService;

    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::id())->with(['items', 'payment'])->latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('orders.index', compact('orders'));
    }

    public function show(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->with(['items.product', 'payment'])
            ->firstOrFail();

        $whatsappUrl = $this->whatsappService->getWhatsAppUrl($order);

        return view('orders.show', compact('order', 'whatsappUrl'));
    }

    public function uploadPayment(Request $request, string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan ini tidak dalam status menunggu pembayaran.');
        }

        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $proofPath = $request->file('payment_proof')->store('payments', 'public');

        if ($order->payment) {
            $order->payment->update([
                'payment_proof' => $proofPath,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'status' => 'pending',
                'notes' => 'Diunggah ulang oleh pelanggan',
            ]);
        } else {
            Payment::create([
                'order_id' => $order->id,
                'payment_proof' => $proofPath,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'amount' => $order->total,
                'status' => 'pending',
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin/kasir.');
    }
}
