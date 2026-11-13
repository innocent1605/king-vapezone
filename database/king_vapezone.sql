-- King Vapezone Database Dump
-- Prepared for Laragon MySQL / HeidiSQL / phpMyAdmin
-- Database: `king_vapezone`

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('admin','kasir','pelanggan') NOT NULL DEFAULT 'pelanggan',
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Password for all demo accounts: 'password' (bcrypt hashed)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`) VALUES
(1, 'Admin King Vapezone', 'admin@kingvapezone.com', '$2y$10$QcDVbymKBbRlTT1V7WIJr.XR7ChXRf6eooSWq6/IbAiqEDlgxtj/C', '081234567890', 'Store King Vapezone Pusat, Jl. Kemang Raya No. 88, Jakarta Selatan', 'admin'),
(2, 'Kasir King Vapezone', 'kasir@kingvapezone.com', '$2y$10$QcDVbymKBbRlTT1V7WIJr.XR7ChXRf6eooSWq6/IbAiqEDlgxtj/C', '081234567891', 'Store King Vapezone Counter A', 'kasir'),
(3, 'John Doe Vaper', 'pelanggan@kingvapezone.com', '$2y$10$QcDVbymKBbRlTT1V7WIJr.XR7ChXRf6eooSWq6/IbAiqEDlgxtj/C', '081234567892', 'Jl. Merdeka No. 45, Jakarta Selatan', 'pelanggan');

-- --------------------------------------------------------
-- Table structure for table `categories`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `is_active`) VALUES
(1, 'Pod System', 'pod-system', 'Perangkat pod praktis, compact, cocok untuk pemula dan harian.', 1),
(2, 'Mod Kit', 'mod-kit', 'Mod kit bertenaga tinggi untuk cloud chaser dan kustomisasi maksimal.', 1),
(3, 'Liquid', 'liquid', 'Liquid vape premium aneka rasa creamy dan fruity terbaik.', 1),
(4, 'Coil', 'coil', 'Replacement coil original berbagai varian ohm untuk cita rasa optimal.', 1),
(5, 'Cartridge', 'cartridge', 'Cartridge pod original untuk berbagai merk ternama.', 1),
(6, 'Aksesoris', 'aksesoris', 'Baterai, charger, lanyard, casing, drip tip, dan kapas vape.', 1),
(7, 'Freebase', 'freebase', 'E-liquid freebase untuk rasa mantap dan uap tebal.', 1),
(8, 'Salt Nic', 'salt-nic', 'E-liquid salt nicotine untuk throat hit halus dan penyerapan cepat.', 1);

-- --------------------------------------------------------
-- Table structure for table `products`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `stock`, `is_active`) VALUES
(1, 1, 'OXVA Xlim Pro 2 Pod Kit 1000mAh', 'oxva-xlim-pro-2-pod-kit-1000mah', 'OXVA Xlim Pro 2 hadir dengan layar warna HD 0.56 inci, baterai 1000mAh tahan hingga 4 hari, output maksimal 30W, dan kompatibel dengan semua cartridge Xlim Series V2 & V3.', 340000.00, 25, 1),
(2, 1, 'VOOPOO Argus G2 Pod Kit 1000mAh', 'voopoo-argus-g2-pod-kit-1000mah', 'Generasi penerus Argus G dengan layar warna animasi interaktif 0.96 inci, 3 mode daya (Super, Smart, ECO), pengisian daya cepat Type-C 2A, dan desain bodi seng alloy premium.', 320000.00, 18, 1),
(3, 2, 'Geekvape Aegis Legend 3 Mod Kit 200W', 'geekvape-aegis-legend-3-mod-kit-200w', 'Flagship rugged dual-battery box mod kit berdaya 200W, fitur smart lock pintar pengenal telapak tangan, AS Chip 4.0, standar IP68 tahan banting, debu, dan kedap air.', 850000.00, 12, 1),
(4, 2, 'Lost Vape Thelema Quest 200W Kit', 'lost-vape-thelema-quest-200w-kit', 'Kit mod bertenaga chipset Quest 2.0 dengan pintu baterai transparan retro-tech, 5 mode vaping cerdas (VPC, Bypass, Wattage, Voltage, TC), dan port Type-C fast charge.', 690000.00, 10, 1),
(5, 3, 'Oat Drips V1 Original Cereal Milk 60ml', 'oat-drips-v1-original-cereal-milk-60ml', 'Sensasi sereal gandum oatmeal renyah bercampur susu manis creamy hangat. Salah satu liquid legendaris terlaris di Indonesia dengan cukai resmi.', 140000.00, 45, 1),
(6, 3, 'Tokyo Banana Cream Dessert 60ml', 'tokyo-banana-cream-dessert-60ml', 'Kue sponge bolu pisang khas Tokyo dengan isian krim custard lembut dan manis pas, cocok untuk pecinta dessert creamy sejati.', 145000.00, 30, 1),
(7, 4, 'Geekvape Z Series Mesh Coil 0.2 ohm (Pack of 5)', 'geekvape-z-series-mesh-coil-0-2-ohm-pack-of-5', 'Replacement coil mesh Kanthal 0.2 ohm untuk Zeus Sub Ohm Tank. Menghasilkan uap ekstra tebal dan cita rasa liquid yang sangat jernih di daya 70-80W.', 175000.00, 40, 1),
(8, 4, 'VOOPOO PnP-VM6 Coil 0.15 ohm (Pack of 5)', 'voopoo-pnp-vm6-coil-0-15-ohm-pack-of-5', 'Coil mesh bertenaga untuk perangkat Drag Series, rekomendasi penggunaan pada rentang watt 60W - 80W untuk sensasi DTL maksimal.', 165000.00, 35, 1),
(9, 5, 'OXVA Xlim Top Fill Cartridge 0.6 ohm (Pack of 3)', 'oxva-xlim-top-fill-cartridge-0-6-ohm-pack-of-3', 'Cartridge top-fill anti bocor untuk OXVA Xlim Series. Varian 0.6 ohm sangat optimal untuk liquid freebase maupun salt nic dengan throat hit mantap.', 120000.00, 60, 1),
(10, 5, 'Uwell Caliburn G3 Integrated Coil Cartridge 0.9 ohm (Pack of 4)', 'uwell-caliburn-g3-integrated-coil-cartridge-0-9-ohm-pack-of-4', 'Cartridge Caliburn G3 berteknologi Pro-FOCS Flavor Technology dengan mekanisme penguncian cairan ultrasonik bebas bocor.', 140000.00, 50, 1),
(11, 6, 'Baterai Molicel P28A 18650 2800mAh 35A Original', 'baterai-molicel-p28a-18650-2800mah-35a-original', 'Baterai vape nomor satu dunia dengan rating continuous discharge 35A nyata, aman, stabil, dan tahan lama untuk mechanical maupun regulated mod.', 95000.00, 80, 1),
(12, 6, 'Nitecore Q2 Quick Charger Dual Slot 2A', 'nitecore-q2-quick-charger-dual-slot-2a', 'Charger pintar eksternal 2 slot dengan proteksi arus pendek, indikator LED status pengisian, dan kemampuan output hingga 2000mA per slot.', 185000.00, 20, 1),
(13, 7, 'Foom Freebase Ice Berry Blast 60ml 3mg/6mg', 'foom-freebase-ice-berry-blast-60ml-3mg-6mg', 'Perpaduan buah berry asam manis segar dengan sensasi mint dingin menyegarkan. Nicotine 3mg/6mg halus di tenggorokan.', 135000.00, 55, 1),
(14, 7, 'Juta Freeze Sweet Mango Freebase 60ml 3mg', 'juta-freeze-sweet-mango-freebase-60ml-3mg', 'Mangga manis matang pohon dingin menggelegar, sensasi aroma tropis yang memanjakan lidah setiap puff.', 125000.00, 40, 1),
(15, 8, 'Foom Salt Nic Ice Watermelon 30ml 30mg', 'foom-salt-nic-ice-watermelon-30ml-30mg', 'Semangka segar manis dingin yang melegakan dahaga, diformulasikan khusus untuk sistem pod dengan penyerapan nikotin cepat.', 110000.00, 65, 1),
(16, 8, 'Hero57 Salt Tiramisu Coffee Cake 30ml 30mg', 'hero57-salt-tiramisu-coffee-cake-30ml-30mg', 'Kombinasi harum espresso kopi italia dengan biskuit ladyfinger berbalut krim mascarpone gurih.', 115000.00, 45, 1);

-- --------------------------------------------------------
-- Table structure for table `carts` & `cart_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cart_items`;
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cart_items_cart_id_product_id_unique` (`cart_id`,`product_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `orders`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `notes` text DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','confirmed','processing','shipped','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_status_index` (`user_id`,`status`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `order_items`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `payments`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `status` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  `verified_by` bigint(20) unsigned DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `payments_order_id_foreign` (`order_id`),
  KEY `payments_verified_by_foreign` (`verified_by`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `settings`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`key`, `value`) VALUES
('site_name', 'King Vapezone'),
('site_tagline', 'Toko Vape Terlengkap, Original & Terpercaya'),
('site_description', 'King Vapezone adalah destinasi utama bagi penikmat vape di Indonesia. Menyediakan device pod, mod, liquid premium lokal & internasional, coil, cartridge, dan aksesoris 100% original bergaransi resmi.'),
('whatsapp_number', '6281234567890'),
('email', 'contact@kingvapezone.com'),
('phone', '+62 812-3456-7890'),
('address', 'Jl. Kemang Raya No. 88, Jakarta Selatan, DKI Jakarta 12730'),
('opening_hours', 'Setiap Hari: 10.00 - 23.00 WIB'),
('bank_name', 'Bank Central Asia (BCA)'),
('bank_account', '8830123456'),
('bank_holder', 'PT KING VAPEZONE INDONESIA'),
('about_story', 'Didirikan dengan semangat memberikan pengalaman vaping yang aman, autentik, dan berkualitas tinggi. King Vapezone mengedepankan produk bersertifikasi, edukasi harm reduction yang bertanggung jawab bagi perokok dewasa, dan pelayanan ramah secepat kilat.');

-- --------------------------------------------------------
-- Table structure for table `faqs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faqs` (`id`, `question`, `answer`, `sort_order`, `is_active`) VALUES
(1, 'Apakah semua produk di King Vapezone 100% Original?', 'Ya, kami hanya menjual produk yang 100% original, berpita cukai resmi untuk seluruh kategori liquid, dan bergaransi distributor resmi untuk perangkat pod maupun mod.', 1, 1),
(2, 'Bagaimana alur transaksi dan integrasi WhatsApp di King Vapezone?', 'Sangat mudah! Pilih produk yang Anda inginkan, masukkan ke keranjang belanja, lakukan checkout di web dan transfer pembayaran. Setelah pesanan dibuat, sistem otomatis mengarahkan Anda ke WhatsApp resmi kami dengan format pesan otomatis lengkap untuk konfirmasi dan update pengiriman.', 2, 1),
(3, 'Metode pembayaran apa saja yang diterima?', 'Saat ini kami melayani pembayaran transfer bank manual ke rekening BCA resmi kami. Anda cukup mengunggah bukti transfer di halaman checkout atau riwayat pesanan.', 3, 1),
(4, 'Berapa batasan usia minimal untuk berbelanja?', 'Sesuai regulasi hukum dan komitmen perlindungan konsumen, Anda wajib berusia minimal 21 tahun (21+) untuk berbelanja produk vape di King Vapezone.', 4, 1),
(5, 'Berapa lama waktu pengemasan dan pengiriman barang?', 'Pesanan yang telah diverifikasi pembayarannya sebelum pukul 17.00 WIB akan dikirim pada hari yang sama. Nomor resi akan diupdate di dashboard Anda dan melalui WhatsApp.', 5, 1),
(6, 'Apakah ada garansi untuk device rusak?', 'Device bergaransi toko selama 7 hari sejak barang diterima (kerusakan pabrik/factory defect, bukan karena jatuh, terkena air, atau kelalaian pemakaian). Wajib menyertakan video unboxing tanpa jeda.', 6, 1);

SET FOREIGN_KEY_CHECKS = 1;
`king-vapezone`