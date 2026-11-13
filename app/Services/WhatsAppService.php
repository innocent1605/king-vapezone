<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Setting;

class WhatsAppService
{
    /**
     * Generate a formatted WhatsApp message for an order.
     */
    public function generateOrderMessage(Order $order): string
    {
        $order->load('items');

        $itemsText = '';
        foreach ($order->items as $item) {
            $subtotal = number_format($item->subtotal, 0, ',', '.');
            $itemsText .= "- {$item->product_name} x{$item->quantity} = Rp {$subtotal}\n";
        }

        $total = number_format($order->total, 0, ',', '.');

        $message = "Halo King Vapezone! 🛒\n\n";
        $message .= "*Pesanan Baru*\n";
        $message .= "No. Pesanan: {$order->order_number}\n\n";
        $message .= "Nama: {$order->name}\n";
        $message .= "No. HP: {$order->phone}\n";
        $message .= "Alamat: {$order->address}\n\n";
        $message .= "*Detail Produk:*\n";
        $message .= $itemsText . "\n";
        $message .= "*Total: Rp {$total}*\n\n";
        $message .= "Terima kasih! 🙏";

        return $message;
    }

    /**
     * Get the WhatsApp URL for sending an order message.
     */
    public function getWhatsAppUrl(Order $order): string
    {
        $whatsappNumber = Setting::get('whatsapp_number', '6281234567890');
        $message = $this->generateOrderMessage($order);

        return "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);
    }
}
