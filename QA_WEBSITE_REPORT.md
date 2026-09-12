# QA Website Report

## 1. Informasi Pengujian

- **Website:** Bliss in Bali
- **Tanggal pengujian awal:** 23 Agustus 2026
- **Tanggal retest:** 23 Agustus 2026
- **Environment:** local, `http://127.0.0.1:8000`
- **Peran:** QA functional, smoke, UI content, dan regression test
- **Browser:** integrated Chromium melalui Playwright
- **Scope:** homepage, katalog tour, detail tour, checkout tour activity sampai sebelum pembayaran, route publik, dan automated test suite
- **Out of scope:** car rental, integrasi Midtrans, callback pembayaran, dan verifikasi transaksi pembayaran

## 2. Executive Summary

Status: **NOT READY FOR PRODUCTION**.

Retest setelah perbaikan kategori menunjukkan peningkatan pada automated test suite. Status release tetap belum siap karena masih ada satu kegagalan environment/test setup.

Alur dasar homepage, katalog, detail paket, dan checkout dapat dibuka. Interaksi quantity activity juga berjalan sesuai ekspektasi pada smoke test. Akan tetapi, terdapat masalah pada data yang tampil ke publik dan automated test suite belum green. Car rental dan integrasi Midtrans sengaja tidak dinilai dalam laporan ini.

## 3. Hasil Test Otomatis

| Metric | Hasil |
|---|---:|
| Total test | 15 |
| Passed | 14 |
| Failed | 1 |
| Failed rate | 6.7% |
| Status gate | Failed |

Hasil retest: seluruh `MultiSiteSyncTest` lulus `6/6` setelah fallback `tour_category_id` dan migration backfill diterapkan. Satu kegagalan tersisa berasal dari `tests/Feature/ExampleTest.php`: SQLite in-memory pada test homepage tidak memiliki tabel `sites`, sehingga middleware site resolution gagal sebelum assertion status halaman. Test environment atau bootstrap migration perlu dilengkapi.

## 4. Temuan QA

### QA-01 - Data uji tampil di halaman publik

- **Severity:** High / P1
- **Area:** Homepage dan katalog tour
- **Bukti:** Banner menampilkan teks `Test`, `Button 2`, dan `TEST`; katalog juga menampilkan paket `test crop image`.
- **Dampak:** Pengunjung dapat menganggap website belum selesai atau kehilangan kepercayaan terhadap kualitas layanan. Paket uji juga berpotensi diklik dan masuk ke proses booking.
- **Rekomendasi:** Nonaktifkan/hapus record test dari data production, pastikan query publik hanya mengambil konten approved/active, dan tambahkan data-quality check untuk judul/banner placeholder.

### QA-02 - Tailwind CDN dipakai di production-facing layout

- **Severity:** Medium / P2
- **Area:** Global layout
- **Bukti:** Browser console memberi warning `cdn.tailwindcss.com should not be used in production` pada homepage, katalog, detail, dan checkout. Sumbernya ada di `resources/views/layouts/front.blade.php`.
- **Dampak:** Ketergantungan runtime pada CDN, performa dan reliabilitas lebih buruk, serta warning deployment tetap muncul.
- **Rekomendasi:** Gunakan asset hasil build Vite/Tailwind lokal melalui `@vite`, hapus script CDN, dan verifikasi build production.

### QA-03 - Link Privacy Policy belum memiliki tujuan

- **Severity:** Medium / P2
- **Area:** Footer
- **Bukti:** Link `Privacy Policy` menuju `#`.
- **Dampak:** Informasi legal/privacy tidak dapat diakses, terutama bermasalah karena website mengumpulkan email, nomor telepon, lokasi pickup, dan data booking.
- **Rekomendasi:** Buat halaman privacy policy yang sesuai proses pengumpulan data dan hubungkan route/footer ke halaman tersebut.

### QA-04 - Homepage test gagal karena tabel `sites` tidak tersedia di SQLite test

- **Severity:** Medium / P2
- **Area:** Test quality / CI gate
- **Bukti:** `tests/Feature/ExampleTest.php` menghasilkan `SQLSTATE[HY000]: General error: 1 no such table: sites` pada SQLite in-memory.
- **Dampak:** Perubahan aplikasi tidak memiliki sinyal regression yang dapat dipercaya; pipeline tidak dapat dijadikan quality gate.
- **Rekomendasi:** Pastikan seluruh migration termasuk `create_sites_table` dijalankan pada test bootstrap, atau sesuaikan `RefreshDatabase`/konfigurasi test agar schema lengkap tersedia.

## 5. Smoke Test Matrix

| ID | Skenario | Hasil | Catatan |
|---|---|---|---|
| SM-01 | Membuka homepage | Pass with issue | HTTP 200; banner berisi data uji; warning CDN |
| SM-02 | Membuka katalog tour | Pass with issue | HTTP 200; 51 paket tampil; ada paket `test crop image`; warning CDN |
| SM-03 | Membuka detail paket activity | Pass | Informasi harga, itinerary, dan CTA tersedia |
| SM-04 | Membuka checkout activity | Pass | Field wajib dan opsi activity tampil |
| SM-05 | Menambah 1 unit tandem | Pass | Menjadi 2 unit, 4 pax; hidden field sinkron |
| SM-06 | Menjalankan automated tests (retest) | Fail | 14 passed, 1 failed; MultiSiteSyncTest 6/6 lulus |

## 6. Prioritas Perbaikan Sebelum Release

1. Bersihkan seluruh data test/placeholder dari data publik.
2. Perbaiki test environment agar tabel `sites` tersedia dan seluruh suite green.
3. Migrasikan Tailwind CDN ke asset build lokal dan sediakan Privacy Policy.

## 7. Exit Criteria

Release dapat dipertimbangkan setelah:

- seluruh automated tests pass;
- tidak ada konten placeholder pada halaman publik;
- console tidak lagi memberi warning Tailwind CDN pada build production.
