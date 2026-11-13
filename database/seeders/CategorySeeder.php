<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Pod System', 'description' => 'Perangkat pod praktis, compact, cocok untuk pemula dan penggunaan harian.'],
            ['name' => 'Mod Kit', 'description' => 'Mod kit bertenaga tinggi untuk cloud chaser dan kustomisasi maksimal.'],
            ['name' => 'Liquid', 'description' => 'Liquid vape premium aneka rasa creamy dan fruity terbaik.'],
            ['name' => 'Coil', 'description' => 'Replacement coil original berbagai varian ohm untuk cita rasa optimal.'],
            ['name' => 'Cartridge', 'description' => 'Cartridge pod original untuk berbagai merk ternama.'],
            ['name' => 'Aksesoris', 'description' => 'Baterai, charger, lanyard, casing, drip tip, dan kapas vape.'],
            ['name' => 'Freebase', 'description' => 'E-liquid freebase untuk rasa mantap dan uap tebal.'],
            ['name' => 'Salt Nic', 'description' => 'E-liquid salt nicotine untuk throat hit halus dan penyerapan cepat.'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                    'is_active' => true,
                ]
            );
        }
    }
}
