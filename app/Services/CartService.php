<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;

class CartService
{
    /**
     * Get existing cart or create a new one for the user.
     */
    public function getOrCreateCart(User $user): Cart
    {
        return Cart::firstOrCreate(['user_id' => $user->id]);
    }

    /**
     * Add a product to the cart.
     * If the product already exists in the cart, increment the quantity.
     */
    public function addItem(Cart $cart, int $productId, int $quantity = 1): CartItem
    {
        $product = Product::findOrFail($productId);

        // Check if product is active
        if (!$product->is_active) {
            throw new \Exception('Produk tidak tersedia.');
        }

        // Check existing cart item
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;

            // Check stock availability
            if ($newQuantity > $product->stock) {
                throw new \Exception('Stok produk tidak mencukupi. Stok tersedia: ' . $product->stock);
            }

            $cartItem->update(['quantity' => $newQuantity]);

            return $cartItem->fresh();
        }

        // Check stock for new item
        if ($quantity > $product->stock) {
            throw new \Exception('Stok produk tidak mencukupi. Stok tersedia: ' . $product->stock);
        }

        return CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    /**
     * Update the quantity of a cart item.
     */
    public function updateItem(CartItem $item, int $quantity): CartItem
    {
        $product = $item->product;

        if ($quantity > $product->stock) {
            throw new \Exception('Stok produk tidak mencukupi. Stok tersedia: ' . $product->stock);
        }

        if ($quantity <= 0) {
            $this->removeItem($item);
            return $item;
        }

        $item->update(['quantity' => $quantity]);

        return $item->fresh();
    }

    /**
     * Remove an item from the cart.
     */
    public function removeItem(CartItem $item): void
    {
        $item->delete();
    }

    /**
     * Clear all items from the cart.
     */
    public function clearCart(Cart $cart): void
    {
        $cart->items()->delete();
    }

    /**
     * Calculate the total price of all items in the cart.
     */
    public function getCartTotal(Cart $cart): float
    {
        return $cart->items()
            ->with('product')
            ->get()
            ->sum(function (CartItem $item) {
                return $item->product->price * $item->quantity;
            });
    }
}
