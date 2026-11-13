<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $allowedKeys = [
            'site_name',
            'site_tagline',
            'site_description',
            'whatsapp_number',
            'email',
            'phone',
            'address',
            'opening_hours',
            'bank_name',
            'bank_account',
            'bank_holder',
            'about_story',
        ];

        foreach ($allowedKeys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        return back()->with('success', 'Pengaturan toko berhasil diperbarui.');
    }
}
