# Catatan Integrasi Midtrans Sandbox

## Status Integrasi

Website sudah menggunakan Midtrans Snap melalui package `midtrans/midtrans-php`.

Alur yang tersedia:

- Pembayaran tour melalui `CheckoutController`
- Pembayaran car rental melalui `CarCheckoutController`
- Callback pembayaran untuk memperbarui status booking

## 1. Ambil Kredensial Sandbox

1. Buka [Midtrans Sandbox Dashboard](https://dashboard.sandbox.midtrans.com/).
2. Masuk ke **Settings -> Access Keys**.
3. Salin **Server Key** dan **Client Key**.

Isi file `.env`:

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxx
MIDTRANS_IS_PRODUCTION=false
```

`Server Key` bersifat rahasia dan tidak boleh ditampilkan di frontend atau dibagikan.

## 2. Gunakan Snap.js Sandbox

URL Snap.js harus menggunakan endpoint sandbox pada kedua halaman pembayaran:

- `resources/views/checkout/payment.blade.php`
- `resources/views/car-rental/payment.blade.php`

Gunakan:

```html
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
```

Jangan menggunakan URL production berikut saat testing sandbox:

```text
https://app.midtrans.com/snap/snap.js
```

## 3. Bersihkan Cache Laravel

Setelah mengubah `.env`, jalankan:

```bash
php artisan optimize:clear
```

Hal ini diperlukan agar konfigurasi baru terbaca oleh Laravel.

## 4. Atur Notification URL

Di Sandbox Dashboard, buka **Settings -> Configuration** dan isi URL berikut. Domain harus dapat diakses oleh Midtrans dan sebaiknya menggunakan HTTPS.

Untuk pembayaran tour:

```text
https://domain-anda.com/midtrans-callback
```

Untuk pembayaran car rental:

```text
https://domain-anda.com/car-midtrans-callback
```

Jika aplikasi masih berjalan di komputer lokal, gunakan Ngrok atau Cloudflare Tunnel untuk mendapatkan URL HTTPS publik.

## 5. Pengujian

1. Buka halaman checkout tour atau car rental.
2. Isi data booking.
3. Klik tombol pembayaran.
4. Gunakan kartu, virtual account, atau metode pembayaran uji yang tersedia di Sandbox Dashboard Midtrans.
5. Periksa status transaksi di dashboard dan status booking di website.
6. Periksa log Laravel jika terjadi error:

```text
storage/logs/laravel.log
```

## 6. Pemeriksaan Keamanan

- `MIDTRANS_SERVER_KEY` hanya digunakan di backend.
- `MIDTRANS_CLIENT_KEY` boleh digunakan pada halaman frontend.
- Callback memverifikasi `signature_key` sebelum mengubah status pembayaran.
- Route callback sudah dikecualikan dari CSRF agar dapat menerima notifikasi Midtrans.
- Jangan commit file `.env` ke repository.

## File Terkait

- `config/services.php`
- `app/Http/Controllers/CheckoutController.php`
- `app/Http/Controllers/CarCheckoutController.php`
- `routes/web.php`
- `bootstrap/app.php`
