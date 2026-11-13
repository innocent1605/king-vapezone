<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getOrCreateCart(Auth::user());
        $cart->load(['items.product.category']);

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->isInStock()) {
            return back()->with('error', 'Mohon maaf, stok produk ini sedang habis.');
        }

        $cart = $this->cartService->getOrCreateCart(Auth::user());
        $quantity = (int) ($request->quantity ?? 1);

        $this->cartService->addItem($cart, $product->id, $quantity);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang belanja.');
    }

    public function update(Request $request, CartItem $item)
    {
        // Security: Ensure item belongs to logged-in user's cart
        if ($item->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $this->cartService->updateItem($item, $request->quantity);

        return back()->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function remove(CartItem $item)
    {
        // Security check
        if ($item->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $this->cartService->removeItem($item);

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
