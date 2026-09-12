<?php

namespace Database\Seeders;

use App\Models\TourCategory;
use Illuminate\Database\Seeder;

class TourCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Adventure', 'slug' => 'adventure', 'sort_order' => 1],
            ['name' => 'Beach & Snorkeling', 'slug' => 'beach-snorkeling', 'sort_order' => 2],
            ['name' => 'Culture & Temple', 'slug' => 'culture-temple', 'sort_order' => 3],
            ['name' => 'Island Hopping', 'slug' => 'island-hopping', 'sort_order' => 4],
        ];

        foreach ($categories as $category) {
            TourCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'site_id' => 1,
                    'name' => $category['name'],
                    'is_active' => true,
                    'sort_order' => $category['sort_order'],
                ],
            );
        }
    }
}
