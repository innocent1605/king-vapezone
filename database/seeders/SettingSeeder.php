<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'King Vapezone',
            'site_tagline' => 'Toko Vape Terlengkap, Original & Terpercaya',
            'site_description' => 'King Vapezone adalah destinasi utama bagi penikmat vape di Indonesia. Menyediakan device pod, mod, liquid premium lokal & internasional, coil, cartridge, dan aksesoris 100% original bergaransi resmi.',
            'whatsapp_number' => '6281234567890',
            'email' => 'contact@kingvapezone.com',
            'phone' => '+62 812-3456-7890',
            'address' => 'Jl. Kemang Raya No. 88, Jakarta Selatan, DKI Jakarta 12730',
            'opening_hours' => 'Setiap Hari: 10.00 - 23.00 WIB',
            'bank_name' => 'Bank Central Asia (BCA)',
            'bank_account' => '8830123456',
            'bank_holder' => 'PT KING VAPEZONE INDONESIA',
            'about_story' => 'Didirikan dengan semangat memberikan pengalaman vaping yang aman, autentik, dan berkualitas tinggi. King Vapezone mengedepankan produk bersertifikasi, edukasi harm reduction yang bertanggung jawab bagi perokok dewasa, dan pelayanan ramah secepat kilat.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
