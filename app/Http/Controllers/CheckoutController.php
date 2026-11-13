<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Setting;
use App\Services\CartService;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    protected CartService $cartService;
    protected WhatsAppService $whatsappService;

    public function __construct(CartService $cartService, WhatsAppService $whatsappService)
    {
        $this->cartService = $cartService;
        $this->whatsappService = $whatsappService;
    }

    public function index()
    {
        $user = Auth::user();
        $cart = $this->cartService->getOrCreateCart($user);
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        // Validate stock before checkout
        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('cart.index')->with(
                    'error',
                    "Stok {$item->product->name} tidak mencukupi (tersedia: {$item->product->stock})."
                );
            }
        }

        $bankInfo = [
            'name' => Setting::get('bank_name', 'Bank Central Asia (BCA)'),
            'account' => Setting::get('bank_account', '8830123456'),
            'holder' => Setting::get('bank_holder', 'PT KING VAPEZONE INDONESIA'),
        ];

        return view('checkout.index', compact('cart', 'user', 'bankInfo'));
    }

    public function store(CheckoutRequest $request)
    {
        $user = Auth::user();
        $cart = $this->cartService->getOrCreateCart($user);
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        return DB::transaction(function () use ($request, $user, $cart) {
            $subtotal = $cart->total;
            $total = $subtotal; // Free shipping or flat in MVP

            // 1. Create Order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => Order::generateOrderNumber(),
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'notes' => $request->notes,
                'subtotal' => $subtotal,
                'total' => $total,
                'status' => 'pending',
            ]);

            // 2. Create Order Items & Decrease Stock
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'product_price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->subtotal,
                ]);

                // Decrease stock automatically
                $item->product->decreaseStock($item->quantity);
            }

            // 3. Handle Payment Proof Upload (Security: store in public storage disk)
            $proofPath = $request->file('payment_proof')->store('payments', 'public');

            // 4. Create Payment Record
            Payment::create([
                'order_id' => $order->id,
                'payment_proof' => $proofPath,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'amount' => $total,
                'status' => 'pending',
            ]);

            // 5. Clear Cart
            $this->cartService->clearCart($cart);

            return redirect()->route('checkout.success', $order->order_number);
        });
    }

    public function success(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->with(['items', 'payment'])
            ->firstOrFail();

        $whatsappUrl = $this->whatsappService->getWhatsAppUrl($order);

        return view('checkout.success', compact('order', 'whatsappUrl'));
    }
}
