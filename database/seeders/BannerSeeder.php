<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Site;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $site = Site::where('id', env('APP_WEBSITE_ID'))->where('is_active', true)->first() ?? Site::first();

        if (!$site) {
            $this->command->warn('⚠️  Tidak ada site yang ditemukan. Jalankan SiteSeeder terlebih dahulu.');
            return;
        }

        $banners = [
            [
                'site_id'        => $site->id,
                'title'          => 'Inovasi Tanpa Batas',
                'subtitle'       => 'PLATFORM TERPERCAYA',
                'highlight_text' => 'Masa Depan',
                'description'    => 'Kami menghadirkan solusi terbaik untuk kebutuhan Anda dengan teknologi mutakhir dan tim yang berpengalaman.',
                'button_text'    => 'Mulai Sekarang',
                'button_link'    => '/produk',
                'image'          => 'banners/placeholder-1.jpg',
                'gradient_color' => 'from-indigo-400 to-purple-600',
                'order'          => 1,
                'is_active'      => true,
            ],
            [
                'site_id'        => $site->id,
                'title'          => 'Layanan Premium',
                'subtitle'       => 'KUALITAS TERJAMIN',
                'highlight_text' => 'Untuk Anda',
                'description'    => 'Dapatkan pengalaman layanan premium dengan standar internasional yang selalu mengutamakan kepuasan pelanggan.',
                'button_text'    => 'Lihat Layanan',
                'button_link'    => '/layanan',
                'image'          => 'banners/placeholder-2.jpg',
                'gradient_color' => 'from-blue-400 to-cyan-500',
                'order'          => 2,
                'is_active'      => true,
            ],
            [
                'site_id'        => $site->id,
                'title'          => 'Bergabung Bersama Kami',
                'subtitle'       => 'KOMUNITAS GROWING',
                'highlight_text' => 'Bersama Kami',
                'description'    => 'Jadilah bagian dari komunitas kami yang terus berkembang dan raih sukses bersama ribuan anggota lainnya.',
                'button_text'    => 'Daftar Gratis',
                'button_link'    => '/daftar',
                'image'          => 'banners/placeholder-3.jpg',
                'gradient_color' => 'from-orange-400 to-rose-500',
                'order'          => 3,
                'is_active'      => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }

        $this->command->info('✅ 3 contoh banner berhasil dibuat.');
    }
}
