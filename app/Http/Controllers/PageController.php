<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Setting;

class PageController extends Controller
{
    public function about()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('about', compact('settings'));
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('faq', compact('faqs'));
    }
}
