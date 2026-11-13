<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function verify(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'notes' => 'nullable|string|max:500',
        ]);

        $payment->update([
            'status' => $request->status,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
            'notes' => $request->notes,
        ]);

        if ($request->status === 'verified') {
            $payment->order->update(['status' => 'confirmed']);
            $msg = 'Pembayaran berhasil diverifikasi dan pesanan otomatis dikonfirmasi.';
        } else {
            $msg = 'Pembayaran telah ditolak.';
        }

        return back()->with('success', $msg);
    }
}
