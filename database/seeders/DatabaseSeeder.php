<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            SiteSeeder::class,
            TourCategorySeeder::class,
            TourPackageSeeder::class,
            TourPackageImageSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@blissinbali.com')],
            [
                'name' => 'Bliss in Bali Admin',
                'password' => 'blissinbali2026',
            ]
        );
    }
}
