# KING VAPEZONE — Website E-Commerce & Profil Terintegrasi WhatsApp

Proyek Tugas Besar Pengembangan & Pengamanan Aplikasi Web — Mata Kuliah: **Cyber Security**.  
Dibangun dengan arsitektur **Laravel 10**, **PHP 8.1 / 8.3**, **MySQL**, serta mengusung filosofi desain visual modern **Neo-Brutalism Enterprise** (High Contrast, Acid Lime `#D4FF00`, Off-White Paper, Charcoal Black).

* **URL Repository Git:** [https://github.com/innocent1605/king-vapezone](https://github.com/innocent1605/king-vapezone)
* **URL Aplikasi Aktif (Produksi):** [https://king-vapezone.gamer.gd](https://king-vapezone.gamer.gd)

---

## ⚡ Fitur Utama Sistem

1. **Autentikasi & Multi-Role Authorization (RBAC):**
   - **Admin:** Kelola produk, kategori, pesanan, verifikasi pembayaran, manajemen akun & role pengguna, pengaturan toko, FAQ, rekap omset, serta **Export Laporan Penjualan (PDF)**.
   - **Kasir:** Pantau antrean pesanan masuk, verifikasi bukti transfer, pembaruan status transaksi, dan pembaruan stok produk.
   - **Pelanggan:** Registrasi mandiri, penjelajahan katalog dengan filter kategori/pencarian, keranjang belanja dinamis, formulir checkout, unggah bukti bayar, pelacakan riwayat transaksi, dan manajemen profil.

2. **Integrasi Transaksi & WhatsApp Otomatis:**
   - Setelah checkout berhasil, pelanggan langsung mendapatkan tombol redirect menuju WhatsApp resmi toko dengan **teks pesan pesanan terstruktur otomatis** (No. Pesanan, Daftar Produk, Jumlah, Total Bayar, Alamat Pengiriman).

3. **Manajemen Stok Real-Time:**
   - Stok produk berkurang otomatis saat checkout berhasil dan dapat dikembalikan (*rollback*) apabila pesanan dibatalkan.

4. **Desain Responsif Neo-Brutalist:**
   - Tampilan berkarakter kuat (*bold borders, hard offset shadows, high contrast typography* Bebas Neue & Playfair Display).
   - Dilengkapi **Dark Mode / Light Mode Toggle** (default: *Dark Mode*).
   - 100% responsif pada perangkat *desktop*, *tablet*, maupun *mobile*.

---

## 🛡️ Aspek Keamanan yang Diterapkan (*Secure Coding*)

| Kategori Keamanan | Mekanisme Pertahanan | Keterangan Implementasi |
|---|---|---|
| **Penyimpanan Password** | Bcrypt Hashing | Disimpan dengan algoritma Bcrypt (work factor 10), tidak ada plaintext di database. |
| **Pencegahan SQLi** | Eloquent ORM & Prepared Statements | Parameterized queries memisahkan query dari user input. |
| **Pencegahan XSS** | Blade Escaping & Input Validation | Auto-escaping `htmlspecialchars` pada template Blade `{{ }}` dan validasi ketat request. |
| **Proteksi CSRF** | CSRF Token Middleware | Setiap form POST/PUT/DELETE wajib menyertakan token CSRF unik per sesi. |
| **Kontrol Akses (RBAC)** | Custom RoleMiddleware | Verifikasi otorisasi berbasis peran pada rute admin, kasir, dan pelanggan. |
| **Brute-Force Defense** | Rate Limiter / Throttle Middleware | Pembatasan frekuensi percobaan request pada endpoint autentikasi. |
| **Proteksi Sesi** | Session Regeneration | Sesi di-regenerasi secara otomatis saat login/logout untuk mencegah *Session Fixation*. |
| **Secret Management** | Isolated Environment Variables | File kredensial `.env` dieksklusi secara penuh pada file `.gitignore`. |

---

## 🧪 Ringkasan Hasil Self-Testing Keamanan

| No | Skenario Uji | Metode Pengujian | Hasil Pengujian | Keterangan Mitigasi |
|:--:|---|---|:---:|---|
| 1 | **SQL Injection (SQLi)** | Injeksi payload `' OR '1'='1` pada form pencarian & filter | **LOLOS** | Input dibaca sebagai string biasa via parameterized query. |
| 2 | **Cross-Site Scripting (XSS)** | Injeksi script `<script>alert('XSS')</script>` pada input | **LOLOS** | Karakter khusus otomatis di-escape menjadi entitas HTML. |
| 3 | **Kontrol Akses (RBAC & IDOR)** | Akses langsung URL `/admin/dashboard` menggunakan akun pelanggan | **LOLOS** | Dicegat oleh middleware dan merespons `403 Forbidden`. |
| 4 | **Pemeriksaan Secret (.env)** | Audit riwayat commit Git dan inspeksi file `.gitignore` | **LOLOS** | File `.env` tidak pernah terlacak / terunggah ke repositori. |
| 5 | **Password Storage Verification** | Inspeksi kolom `password` pada tabel `users` di database | **LOLOS** | Tersimpan sebagai string hash `$2y$10$...` (Bcrypt). |

---

## 🤖 Ringkasan Penggunaan AI Agent

Sesuai ketentuan akademik tugas, pembuatan proyek ini dibantu oleh asisten AI (**Google Antigravity / Gemini 3.8 Flash**):
* **Cakupan Bantuan:**
  1. Perancangan skema relasi database (11 tabel terelasi) dan seeding data awal.
  2. Pembuatan template frontend dengan konsep desain Neo-Brutalism (Tailwind CSS CDN + Alpine.js).
  3. Pemecahan masalah (*debugging*) service provider routing Laravel 10 dan middleware registration.
  4. Penyusunan skenario pengujian mandiri keamanan (*self-testing*) berbasis standar OWASP Top 10.
* **Contoh Prompt Utama:**
  > *"Buatkan arsitektur sistem e-commerce vape store dengan Laravel 10 dan desain Neo-Brutalist yang aman dari kerentanan OWASP Top 10 (SQLi, XSS, CSRF, IDOR), lengkapi dengan multi-role auth untuk Admin, Kasir, dan Pelanggan."*
* **Verifikasi & Tanggung Jawab Mahasiswa:**
  Seluruh kode hasil AI ditinjau (*code review*), diuji coba secara lokal pada lingkungan Laragon (PHP 8.1/8.3 + MySQL), dan diverifikasi logikanya secara mandiri oleh mahasiswa.

---

## 🚀 Panduan Instalasi & Menjalankan Lokal

### 1. Kebutuhan Sistem
- PHP >= 8.1
- Composer
- MySQL Database (disarankan via Laragon)

### 2. Kloning Repositori
```bash
git clone https://github.com/innocent1605/king-vapezone.git
cd king-vapezone
```

### 3. Konfigurasi Environment Variable
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Sesuaikan konfigurasi database pada file `.env`:
```env
APP_NAME="King Vapezone"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=king-vapezone
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Instalasi Dependensi & Setup Database
```bash
# 1. Install package vendor
composer install

# 2. Generate security app key
php artisan key:generate

# 3. Jalankan migrasi dan isi data awal (seeder)
php artisan migrate:fresh --seed

# 4. Hubungkan storage symlink
php artisan storage:link
```

### 5. Menjalankan Server Lokal
```bash
php artisan serve
```
Buka browser pada alamat: `http://127.0.0.1:8000`

---

## 🔑 Akun Demo Pengujian

Semua akun berikut otomatis tersedia setelah proses *seeding*:

| Role Pengguna | Email | Password | Akses Utama |
|---|---|---|---|
| 👑 **Administrator** | `admin@kingvapezone.com` | `password123` | Dashboard, Produk, Kategori, Order, Export PDF, User & Role |
| 💼 **Kasir** | `kasir@kingvapezone.com` | `password123` | Antrean Order, Verifikasi Bukti Bayar, Update Stok Produk |
| 👤 **Pelanggan** | `pelanggan@kingvapezone.com` | `password123` | Katalog, Keranjang, Checkout WhatsApp, Riwayat Transaksi |

---

## 📁 Struktur Direktori Proyek

```
king-vapezone/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/         # Controller Admin (Dashboard, Produk, Kategori, Order, Report, User)
│   │   │   ├── Auth/          # Login & Registrasi dengan Rate Limiting
│   │   │   ├── Kasir/         # Controller Kasir (Dashboard, Order, Update Stok)
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   └── HomeController.php
│   │   └── Middleware/
│   │       ├── Authenticate.php
│   │       ├── RedirectIfAuthenticated.php
│   │       └── RoleMiddleware.php # Otorisasi Role Keamanan
│   ├── Models/                # User, Product, Category, Order, Payment, Setting, Faq
│   └── Providers/             # AppServiceProvider & RouteServiceProvider
├── database/
│   ├── migrations/            # Struktur tabel termigrasi
│   └── seeders/               # Data seeder produk vape, kategori, dan pengguna
├── resources/
│   └── views/                 # Blade template responsif bergaya Neo-Brutalist
├── routes/
│   └── web.php                # Rute publik & terproteksi middleware
└── README.md                  # Dokumentasi proyek & pengujian keamanan
```
