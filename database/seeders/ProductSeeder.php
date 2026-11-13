<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Pod System
            [
                'category' => 'Pod System',
                'name' => 'OXVA Xlim Pro 2 Pod Kit 1000mAh',
                'price' => 340000,
                'stock' => 25,
                'description' => 'OXVA Xlim Pro 2 hadir dengan layar warna HD 0.56 inci, baterai 1000mAh tahan hingga 4 hari, output maksimal 30W, dan kompatibel dengan semua cartridge Xlim Series V2 & V3.',
            ],
            [
                'category' => 'Pod System',
                'name' => 'VOOPOO Argus G2 Pod Kit 1000mAh',
                'price' => 320000,
                'stock' => 18,
                'description' => 'Generasi penerus Argus G dengan layar warna animasi interaktif 0.96 inci, 3 mode daya (Super, Smart, ECO), pengisian daya cepat Type-C 2A, dan desain bodi seng alloy premium.',
            ],

            // Mod Kit
            [
                'category' => 'Mod Kit',
                'name' => 'Geekvape Aegis Legend 3 Mod Kit 200W',
                'price' => 850000,
                'stock' => 12,
                'description' => 'Flagship rugged dual-battery box mod kit berdaya 200W, fitur smart lock pintar pengenal telapak tangan, AS Chip 4.0, standar IP68 tahan banting, debu, dan kedap air.',
            ],
            [
                'category' => 'Mod Kit',
                'name' => 'Lost Vape Thelema Quest 200W Kit',
                'price' => 690000,
                'stock' => 10,
                'description' => 'Kit mod bertenaga chipset Quest 2.0 dengan pintu baterai transparan retro-tech, 5 mode vaping cerdas (VPC, Bypass, Wattage, Voltage, TC), dan port Type-C fast charge.',
            ],

            // Liquid
            [
                'category' => 'Liquid',
                'name' => 'Oat Drips V1 Original Cereal Milk 60ml',
                'price' => 140000,
                'stock' => 45,
                'description' => 'Sensasi sereal gandum oatmeal renyah bercampur susu manis creamy hangat. Salah satu liquid legendaris terlaris di Indonesia dengan cukai resmi.',
            ],
            [
                'category' => 'Liquid',
                'name' => 'Tokyo Banana Cream Dessert 60ml',
                'price' => 145000,
                'stock' => 30,
                'description' => 'Kue sponge bolu pisang khas Tokyo dengan isian krim custard lembut dan manis pas, cocok untuk pecinta dessert creamy sejati.',
            ],

            // Coil
            [
                'category' => 'Coil',
                'name' => 'Geekvape Z Series Mesh Coil 0.2 ohm (Pack of 5)',
                'price' => 175000,
                'stock' => 40,
                'description' => 'Replacement coil mesh Kanthal 0.2 ohm untuk Zeus Sub Ohm Tank. Menghasilkan uap ekstra tebal dan cita rasa liquid yang sangat jernih di daya 70-80W.',
            ],
            [
                'category' => 'Coil',
                'name' => 'VOOPOO PnP-VM6 Coil 0.15 ohm (Pack of 5)',
                'price' => 165000,
                'stock' => 35,
                'description' => 'Coil mesh bertenaga untuk perangkat Drag Series, rekomendasi penggunaan pada rentang watt 60W - 80W untuk sensasi DTL maksimal.',
            ],

            // Cartridge
            [
                'category' => 'Cartridge',
                'name' => 'OXVA Xlim Top Fill Cartridge 0.6 ohm (Pack of 3)',
                'price' => 120000,
                'stock' => 60,
                'description' => 'Cartridge top-fill anti bocor untuk OXVA Xlim Series. Varian 0.6 ohm sangat optimal untuk liquid freebase maupun salt nic dengan throat hit mantap.',
            ],
            [
                'category' => 'Cartridge',
                'name' => 'Uwell Caliburn G3 Integrated Coil Cartridge 0.9 ohm (Pack of 4)',
                'price' => 140000,
                'stock' => 50,
                'description' => 'Cartridge Caliburn G3 berteknologi Pro-FOCS Flavor Technology dengan mekanisme penguncian cairan ultrasonik bebas bocor.',
            ],

            // Aksesoris
            [
                'category' => 'Aksesoris',
                'name' => 'Baterai Molicel P28A 18650 2800mAh 35A Original',
                'price' => 95000,
                'stock' => 80,
                'description' => 'Baterai vape nomor satu dunia dengan rating continuous discharge 35A nyata, aman, stabil, dan tahan lama untuk mechanical maupun regulated mod.',
            ],
            [
                'category' => 'Aksesoris',
                'name' => 'Nitecore Q2 Quick Charger Dual Slot 2A',
                'price' => 185000,
                'stock' => 20,
                'description' => 'Charger pintar eksternal 2 slot dengan proteksi arus pendek, indikator LED status pengisian, dan kemampuan output hingga 2000mA per slot.',
            ],

            // Freebase
            [
                'category' => 'Freebase',
                'name' => 'Foom Freebase Ice Berry Blast 60ml 3mg/6mg',
                'price' => 135000,
                'stock' => 55,
                'description' => 'Perpaduan buah berry asam manis segar dengan sensasi mint dingin menyegarkan. Nicotine 3mg/6mg halus di tenggorokan.',
            ],
            [
                'category' => 'Freebase',
                'name' => 'Juta Freeze Sweet Mango Freebase 60ml 3mg',
                'price' => 125000,
                'stock' => 40,
                'description' => 'Mangga manis matang pohon dingin menggelegar, sensasi aroma tropis yang memanjakan lidah setiap puff.',
            ],

            // Salt Nic
            [
                'category' => 'Salt Nic',
                'name' => 'Foom Salt Nic Ice Watermelon 30ml 30mg',
                'price' => 110000,
                'stock' => 65,
                'description' => 'Semangka segar manis dingin yang melegakan dahaga, diformulasikan khusus untuk sistem pod dengan penyerapan nikotin cepat.',
            ],
            [
                'category' => 'Salt Nic',
                'name' => 'Hero57 Salt Tiramisu Coffee Cake 30ml 30mg',
                'price' => 115000,
                'stock' => 45,
                'description' => 'Kombinasi harum espresso kopi italia dengan biskuit ladyfinger berbalut krim mascarpone gurih.',
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->first();
            if ($category) {
                Product::updateOrCreate(
                    ['slug' => Str::slug($item['name'])],
                    [
                        'category_id' => $category->id,
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'stock' => $item['stock'],
                        'description' => $item['description'],
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
