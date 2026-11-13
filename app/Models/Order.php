<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'name',
        'phone',
        'address',
        'notes',
        'subtotal',
        'total',
        'status',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public static function generateOrderNumber(): string
    {
        return 'KV-' . date('Ymd') . '-' . strtoupper(Str::random(5));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Pembayaran',
            'confirmed' => 'Dikonfirmasi',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-yellow-500 text-black border-yellow-600',
            'confirmed' => 'bg-blue-500 text-white border-blue-700',
            'processing' => 'bg-purple-500 text-white border-purple-700',
            'shipped' => 'bg-indigo-500 text-white border-indigo-700',
            'completed' => 'bg-[#D4FF00] text-black border-[#b2d900]',
            'cancelled' => 'bg-red-500 text-white border-red-700',
            default => 'bg-gray-500 text-white border-gray-700',
        };
    }
}
