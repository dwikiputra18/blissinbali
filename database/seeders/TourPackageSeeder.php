<?php

namespace Database\Seeders;

use App\Models\TourCategory;
use App\Models\TourPackage;
use Illuminate\Database\Seeder;

class TourPackageSeeder extends Seeder
{
    public function run(): void
    {
        $categories = TourCategory::pluck('id', 'slug');

        $packages = [
            [
                'title' => 'Ubud Waterfall Adventure',
                'slug' => 'ubud-waterfall-adventure',
                'category' => 'adventure',
                'subtitle' => 'Waterfall trekking & scenic village tour',
                'description' => 'Explore Bali’s lush countryside with waterfall trekking, rice terrace stops, and a refreshing swim in natural pools.',
                'highlights' => "- Waterfall trekking\n- Rice terrace view\n- Jungle swing photo stop\n- Local lunch",
                'itinerary' => "08:00 Pick up from hotel\n09:30 Visit waterfall\n12:00 Lunch at local restaurant\n14:00 Rice terrace stop\n16:00 Return to hotel",
                'includes' => "Private transport\nEntrance tickets\nLunch\nGuide",
                'excludes' => "Personal expenses\nOptional activities\nTips",
                'thumbnail' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
                'price' => 350000,
                'price_2_4' => 350000,
                'price_5_7' => 320000,
                'price_8_14' => 300000,
                'duration' => '8 Hours',
                'location' => 'Ubud, Bali',
                'rating' => 4.8,
                'badge_icon' => '🔥',
                'badge_label' => 'Best Seller',
                'pickup_time' => '08:00 - 09:00',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Nusa Penida Island Escape',
                'slug' => 'nusa-penida-island-escape',
                'category' => 'island-hopping',
                'subtitle' => 'Cliff views, snorkeling & island hopping',
                'description' => 'Enjoy stunning cliff views, snorkeling at Crystal Bay, and a full-day island hopping experience around Nusa Penida.',
                'highlights' => "- Manta Bay snorkeling\n- Kelingking Beach photo stop\n- Crystal Bay swim\n- Fast boat ride",
                'itinerary' => "07:30 Hotel pickup\n08:30 Fast boat to Nusa Penida\n10:00 Beach stop\n13:00 Lunch\n15:30 Return to Bali",
                'includes' => "Fast boat transfer\nSnorkeling gear\nLunch\nGuide",
                'excludes' => "Marine park fees\nPersonal expenses\nTips",
                'thumbnail' => 'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=1200&q=80',
                'price' => 550000,
                'price_2_4' => 550000,
                'price_5_7' => 520000,
                'price_8_14' => 500000,
                'duration' => '10 Hours',
                'location' => 'Nusa Penida, Bali',
                'rating' => 4.9,
                'badge_icon' => '🌊',
                'badge_label' => 'Popular',
                'pickup_time' => '07:00 - 08:00',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Bali Snorkeling Day Tour',
                'slug' => 'bali-snorkeling-day-tour',
                'category' => 'beach-snorkeling',
                'subtitle' => 'Beach, coral reef & crystal water',
                'description' => 'A fun beach and snorkeling package featuring vibrant coral reefs, crystal-clear water, and a relaxed coastal atmosphere.',
                'highlights' => "- Coral reef snorkeling\n- Beach time\n- Lunch by the sea\n- Equipment included",
                'itinerary' => "09:00 Pick up\n10:00 Snorkeling stop\n12:30 Beach lunch\n14:00 Free time\n16:00 Return",
                'includes' => "Transport\nSnorkeling gear\nLunch\nTicket entry",
                'excludes' => "Personal expenses\nTips\nExtra drinks",
                'thumbnail' => 'https://images.unsplash.com/photo-1527631746610-bca00a040d60?auto=format&fit=crop&w=1200&q=80',
                'price' => 480000,
                'price_2_4' => 480000,
                'price_5_7' => 450000,
                'price_8_14' => 430000,
                'duration' => '7 Hours',
                'location' => 'Padangbai, Bali',
                'rating' => 4.7,
                'badge_icon' => '🐠',
                'badge_label' => 'Top Rated',
                'pickup_time' => '08:30 - 09:30',
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'title' => 'Ubud Culture & Temple Tour',
                'slug' => 'ubud-culture-temple-tour',
                'category' => 'culture-temple',
                'subtitle' => 'Temple visits & local heritage experience',
                'description' => 'Discover Bali’s spiritual heritage with temple visits, traditional craft villages, and a local cultural experience.',
                'highlights' => "- Temple exploration\n- Traditional village\n- Dance performance\n- Local artisan market",
                'itinerary' => "08:30 Pick up\n09:30 Taman Ayun Temple\n11:30 Ubud art village\n13:00 Lunch\n15:30 Return",
                'includes' => "Private car\nEntry tickets\nLunch\nGuide",
                'excludes' => "Personal shopping\nTips\nOptional add-ons",
                'thumbnail' => 'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1200&q=80',
                'price' => 420000,
                'price_2_4' => 420000,
                'price_5_7' => 390000,
                'price_8_14' => 370000,
                'duration' => '9 Hours',
                'location' => 'Ubud & Taman Ayun',
                'rating' => 4.8,
                'badge_icon' => '🛕',
                'badge_label' => 'Cultural',
                'pickup_time' => '08:00 - 09:00',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'East Bali Highlights',
                'slug' => 'east-bali-highlights',
                'category' => 'adventure',
                'subtitle' => 'Waterfalls, villages & panoramic views',
                'description' => 'A memorable sightseeing day through Bali’s scenic east coast, including waterfalls, villages, and panoramic viewpoints.',
                'highlights' => "- Waterfall stop\n- Scenic viewpoints\n- Local village\n- Photo-friendly route",
                'itinerary' => "08:00 Hotel pickup\n09:30 Waterfall visit\n12:00 Lunch\n14:00 Scenic viewpoint\n16:30 Return",
                'includes' => "Transport\nGuide\nLunch\nTickets",
                'excludes' => "Personal shopping\nTips\nExtra drinks",
                'thumbnail' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
                'price' => 390000,
                'price_2_4' => 390000,
                'price_5_7' => 360000,
                'price_8_14' => 340000,
                'duration' => '8 Hours',
                'location' => 'East Bali',
                'rating' => 4.6,
                'badge_icon' => '📍',
                'badge_label' => 'Scenic',
                'pickup_time' => '08:30 - 09:30',
                'is_featured' => false,
                'sort_order' => 5,
            ],
        ];

        foreach ($packages as $package) {
            $categoryId = $categories[$package['category']] ?? null;

            if (! $categoryId) {
                continue;
            }

            TourPackage::updateOrCreate(
                ['slug' => $package['slug']],
                [
                    'site_id' => 1,
                    'tour_category_id' => $categoryId,
                    'title' => $package['title'],
                    'subtitle' => $package['subtitle'],
                    'description' => $package['description'],
                    'highlights' => $package['highlights'],
                    'itinerary' => $package['itinerary'],
                    'includes' => $package['includes'],
                    'excludes' => $package['excludes'],
                    'thumbnail' => $package['thumbnail'],
                    'price' => $package['price'],
                    'price_2_4' => $package['price_2_4'],
                    'price_5_7' => $package['price_5_7'],
                    'price_8_14' => $package['price_8_14'],
                    'duration' => $package['duration'],
                    'location' => $package['location'],
                    'rating' => $package['rating'],
                    'badge_icon' => $package['badge_icon'],
                    'badge_label' => $package['badge_label'],
                    'pickup_time' => $package['pickup_time'],
                    'is_active' => true,
                    'is_featured' => $package['is_featured'],
                    'sort_order' => $package['sort_order'],
                ],
            );
        }
    }
}
