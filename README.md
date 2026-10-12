# Cleaning Service

Aplikasi web layanan kebersihan berbasis Laravel untuk:
- menampilkan layanan, katalog paket, FAQ, dan halaman informasi publik,
- melakukan booking oleh user terdaftar,
- mengelola paket, booking, dan FAQ melalui panel admin.

## Stack

- PHP 8.3+
- Laravel 13
- MySQL
- Vite + Tailwind CSS + Alpine.js
- Pest (testing)

## Fitur Utama

### Publik
- Landing page dengan daftar layanan dan paket unggulan
- Halaman About
- Katalog paket
- Detail paket
- FAQ

### User (autentikasi)
- Register / login / logout / reset password
- Buat booking paket
- Lihat daftar booking pribadi
- Lihat detail booking
- Batalkan booking (kecuali booking yang sudah `completed`)
- Kelola profil

### Admin
- Dashboard statistik booking
- CRUD paket
- Manajemen status booking (`pending`, `confirmed`, `completed`, `cancelled`)
- CRUD FAQ

## Instalasi & Menjalankan Project

1. Clone repository.
2. Install dependency backend:
   ```bash
   composer install
   ```
3. Install dependency frontend:
   ```bash
   npm install
   ```
4. Buat file environment:
   ```bash
   cp .env.example .env
   ```
5. Atur konfigurasi database di `.env` (default project ini: MySQL dengan nama DB `cleaning_service`).
6. Generate app key:
   ```bash
   php artisan key:generate
   ```
7. Migrasi dan seed data:
   ```bash
   php artisan migrate --seed
   ```
8. Jalankan aplikasi:
   ```bash
   composer run dev
   ```

Alternatif setup cepat:
```bash
composer run setup
```

## Akun Seed Default

Setelah `php artisan migrate --seed`, tersedia akun:

- Admin  
  Email: `admin@cleaningservice.com`  
  Password: `password123`

- User  
  Email: `test@example.com`  
  Password: `password123`

## Menjalankan Test

```bash
composer test
```

## Struktur Route Utama

- Publik: `/`, `/about`, `/katalog`, `/faq`, `/package/{id}`
- User: `/booking/*`, `/bookings`, `/dashboard`, `/profile`
- Admin: prefix `/admin/*` dengan middleware `auth` + `admin`

## Catatan Audit README

README sebelumnya masih template default Laravel dan belum menggambarkan fungsi project ini.  
README ini sudah disesuaikan dengan fitur, alur setup, akun seed, dan route yang ada di codebase saat ini.
