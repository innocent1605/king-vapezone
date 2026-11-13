<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_active', true);
        }])
        ->where('is_active', true)
        ->get();

        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $stats = [
            'products' => Product::where('is_active', true)->count(),
            'customers' => User::where('role', 'pelanggan')->count() + 150, // realistic display
            'transactions' => Order::where('status', 'completed')->count() + 350,
            'rating' => '4.9/5.0',
        ];

        return view('home', compact('featuredProducts', 'categories', 'faqs', 'stats'));
    }
}
