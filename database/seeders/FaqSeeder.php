<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apakah semua produk di King Vapezone 100% Original?',
                'answer' => 'Ya, kami hanya menjual produk yang 100% original, berpita cukai resmi untuk seluruh kategori liquid, dan bergaransi distributor resmi untuk perangkat pod maupun mod.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Bagaimana alur transaksi dan integrasi WhatsApp di King Vapezone?',
                'answer' => 'Sangat mudah! Pilih produk yang Anda inginkan, masukkan ke keranjang belanja, lakukan checkout di web dan transfer pembayaran. Setelah pesanan dibuat, sistem otomatis mengarahkan Anda ke WhatsApp resmi kami dengan format pesan otomatis lengkap untuk konfirmasi dan update pengiriman.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Metode pembayaran apa saja yang diterima?',
                'answer' => 'Saat ini kami melayani pembayaran transfer bank manual ke rekening BCA resmi kami. Anda cukup mengunggah bukti transfer di halaman checkout atau riwayat pesanan.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Berapa batasan usia minimal untuk berbelanja?',
                'answer' => 'Sesuai regulasi hukum dan komitmen perlindungan konsumen, Anda wajib berusia minimal 21 tahun (21+) untuk berbelanja produk vape di King Vapezone.',
                'sort_order' => 4,
            ],
            [
                'question' => 'Berapa lama waktu pengemasan dan pengiriman barang?',
                'answer' => 'Pesanan yang telah diverifikasi pembayarannya sebelum pukul 17.00 WIB akan dikirim pada hari yang sama. Nomor resi akan diupdate di dashboard Anda dan melalui WhatsApp.',
                'sort_order' => 5,
            ],
            [
                'question' => 'Apakah ada garansi untuk device rusak?',
                'answer' => 'Device bergaransi toko selama 7 hari sejak barang diterima (kerusakan pabrik/factory defect, bukan karena jatuh, terkena air, atau kelalaian pemakaian). Wajib menyertakan video unboxing tanpa jeda.',
                'sort_order' => 6,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                [
                    'answer' => $faq['answer'],
                    'sort_order' => $faq['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
