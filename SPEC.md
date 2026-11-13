# King Vapezone — Full Project Specification

## Database Schema

### users
id, name, email, password, phone, address, role ENUM('admin','kasir','pelanggan') default 'pelanggan', avatar nullable, email_verified_at, remember_token, timestamps

### categories
id, name, slug unique, description nullable, image nullable, is_active boolean default true, timestamps

### products
id, category_id FK, name, slug unique, description text, price decimal(12,2), stock int default 0, image nullable, is_active boolean default true, timestamps

### carts
id, user_id FK, timestamps

### cart_items
id, cart_id FK, product_id FK, quantity int default 1, timestamps

### orders
id, user_id FK, order_number unique, name, phone, address text, notes text nullable, subtotal decimal(12,2), total decimal(12,2), status ENUM('pending','confirmed','processing','shipped','completed','cancelled') default 'pending', timestamps

### order_items
id, order_id FK, product_id FK nullable, product_name, product_price decimal(12,2), quantity int, subtotal decimal(12,2), timestamps

### payments
id, order_id FK, payment_proof (file path), bank_name, account_name, amount decimal(12,2), status ENUM('pending','verified','rejected') default 'pending', verified_by nullable FK users, verified_at nullable, notes nullable, timestamps

### settings
id, key unique, value text nullable, timestamps

### faqs
id, question, answer text, sort_order int default 0, is_active boolean default true, timestamps

## Routes Summary

Public: / , /products, /products/{slug}, /about, /faq
Auth: /login, /register, /logout
Customer: /cart, /cart/add, /cart/update/{id}, /cart/remove/{id}, /checkout, /checkout/store, /orders, /orders/{order}, /orders/{order}/payment, /profile, /profile/update
Admin: /admin/dashboard, /admin/products (resource), /admin/categories (resource), /admin/orders, /admin/orders/{order}, /admin/orders/{order}/status, /admin/users, /admin/users/{user}/role, /admin/reports, /admin/reports/export-pdf, /admin/payments/{payment}/verify, /admin/settings, /admin/faqs (resource)
Kasir: /kasir/dashboard, /kasir/orders, /kasir/orders/{order}, /kasir/orders/{order}/status, /kasir/payments/{payment}/verify, /kasir/products, /kasir/products/{product}/edit, /kasir/products/{product}/update

## Design
Neo-Brutalist style. Colors: Off-White #F4F4F2, Charcoal #1C1C1C, Acid Lime #D4FF00, Text #111111, Muted #4A4A4A.
Dark mode default. Fonts: Bebas Neue (headings), Inter (body), Playfair Display (CTA/metrics).
