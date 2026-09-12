# Checkout Booking Form — Update Log

**Date:** 2026-03-28  
**Branch/Context:** Integrasi form data dari `formtour.blade.php` ke halaman checkout utama.

---

## Ringkasan Perubahan

### 1. View: `resources/views/checkout/index.blade.php`

Halaman checkout diperbarui dengan mengintegrasikan field-field dari `formtour.blade.php`:

| Field | Perubahan |
|---|---|
| **Phone** | Ditambahkan `country_code` selector (Asia, Eropa, Amerika, Afrika, Oceania) |
| **Date** | Diganti dari `<input type="date">` biasa ke **Flatpickr** (date picker interaktif, min: hari ini) |
| **Quantity** | Diganti dari `<input type="number">` ke tombol `−` / `+` berbasis **Alpine.js** |
| **Pickup Point** | Field baru — textarea + tombol "📍 Use this location" dengan GPS & reverse geocoding (Nominatim) |
| **Dynamic Pricing** | Order summary sidebar sekarang reaktif: harga per orang berubah sesuai jumlah tamu (`price_2_4`, `price_5_7`, `price_8_14`) |

**Dependensi yang ditambahkan (via CDN):**
- `flatpickr` — date picker
- `alpinejs` — reactive form state
- Hidden inputs: `latitude`, `longitude`

---

### 2. Migration: `database/migrations/2026_03_28_101223_add_booking_fields_to_bookings_table.php`

Menambahkan kolom baru ke tabel `bookings`:

```php
$table->string('country_code')->default('+62')->after('phone');
$table->text('pickup_point')->nullable()->after('travel_date');
$table->decimal('latitude', 10, 8)->nullable()->after('pickup_point');
$table->decimal('longitude', 11, 8)->nullable()->after('latitude');
```

---

### 3. Migration: `database/migrations/2026_03_28_101223_add_pricing_tiers_to_tour_packages_table.php`

Menambahkan kolom harga berjenjang ke tabel `tour_packages`:

```php
$table->decimal('price_2_4', 12, 2)->nullable()->after('price');   // harga untuk 2–4 tamu
$table->decimal('price_5_7', 12, 2)->nullable()->after('price_2_4'); // harga untuk 5–7 tamu
$table->decimal('price_8_14', 12, 2)->nullable()->after('price_5_7'); // harga untuk 8–14 tamu
```

---

### 4. Model: `app/Models/Booking.php`

Ditambahkan ke `$fillable`:

```php
'country_code',
'pickup_point',
'latitude',
'longitude',
```

---

### 5. Model: `app/Models/TourPackage.php`

Ditambahkan ke `$fillable` dan `$casts`:

```php
// $fillable
'price_2_4',
'price_5_7',
'price_8_14',

// $casts
'price_2_4'  => 'decimal:2',
'price_5_7'  => 'decimal:2',
'price_8_14' => 'decimal:2',
```

---

## Cara Menjalankan Migrasi

```bash
php artisan migrate
```

---

## Tindak Lanjut yang Diperlukan

- [ ] Update **controller `checkout.process`** untuk menyimpan `country_code`, `pickup_point`, `latitude`, `longitude` ke database.
- [ ] Tambahkan field `price_2_4`, `price_5_7`, `price_8_14` di **Filament TourPackage Resource** agar bisa diisi dari admin panel.
- [ ] Pastikan **validation rules** di controller checkout sudah mencakup field baru.
