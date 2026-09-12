<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        Site::firstOrCreate(
            ['domain' => parse_url(config('app.url'), PHP_URL_HOST) ?? 'localhost'],
            [
                'name'      => config('app.name', 'Bliss in Bali'),
                'prefix'    => 'ZBT',
                'is_active' => true,
            ]
        );
    }
}
