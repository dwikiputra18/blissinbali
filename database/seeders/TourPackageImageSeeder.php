<?php

namespace Database\Seeders;

use App\Models\TourPackage;
use App\Models\TourPackageImage;
use Illuminate\Database\Seeder;

class TourPackageImageSeeder extends Seeder
{
    public function run(): void
    {
        $imagesBySlug = [
            'ubud-waterfall-adventure' => [
                'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1527631746610-bca00a040d60?auto=format&fit=crop&w=1200&q=80',
            ],
            'nusa-penida-island-escape' => [
                'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1200&q=80',
            ],
            'bali-snorkeling-day-tour' => [
                'https://images.unsplash.com/photo-1527631746610-bca00a040d60?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
            ],
            'ubud-culture-temple-tour' => [
                'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1527631746610-bca00a040d60?auto=format&fit=crop&w=1200&q=80',
            ],
            'east-bali-highlights' => [
                'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        foreach ($imagesBySlug as $slug => $images) {
            $tourPackage = TourPackage::where('slug', $slug)->first();

            if (! $tourPackage) {
                continue;
            }

            TourPackageImage::where('tour_package_id', $tourPackage->id)->delete();

            foreach ($images as $index => $image) {
                TourPackageImage::create([
                    'tour_package_id' => $tourPackage->id,
                    'image' => $image,
                    'sort_order' => $index + 1,
                ]);
            }
        }
    }
}
