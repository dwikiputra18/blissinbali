<?php
namespace App\Http\Controllers;

use App\Models\TourPackage;
use App\Models\CarRental;
use App\Models\TourCategory;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    /**
     * Generate sitemap.xml dengan semua URL
     */
    public function index()
    {
        $sitemap = Sitemap::create();

        // 1. Add homepage
        $sitemap->add(
            Url::create(url('/'))
                ->setLastModificationDate(now())
                ->setChangeFrequency('daily')
                ->setPriority(1.0)
        );

        // 2. Add Tour Packages
        $tourPackages = TourPackage::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($tourPackages as $package) {
            $sitemap->add(
                Url::create(route('tour.show', $package->slug))
                    ->setLastModificationDate($package->updated_at)
                    ->setChangeFrequency('weekly')
                    ->setPriority(0.8)
            );
        }

        // 3. Add Tour Packages List Page
        $sitemap->add(
            Url::create(route('tour.index'))
                ->setLastModificationDate(now())
                ->setChangeFrequency('daily')
                ->setPriority(0.9)
        );

        // 4. Add Car Rentals
        $carRentals = CarRental::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($carRentals as $car) {
            $sitemap->add(
                Url::create(url("/car-rentals/{$car->slug}"))
                    ->setLastModificationDate($car->updated_at)
                    ->setChangeFrequency('weekly')
                    ->setPriority(0.7)
            );
        }

        // 5. Add Car Rentals List Page (if route exists)
        if (route('car-rental.index', [], false)) {
            $sitemap->add(
                Url::create(route('car-rental.index'))
                    ->setLastModificationDate(now())
                    ->setChangeFrequency('daily')
                    ->setPriority(0.8)
            );
        }

        // 6. Add Tour Categories
        $categories = TourCategory::where('is_active', true)->get();
        foreach ($categories as $category) {
            $sitemap->add(
                Url::create(url("/tour-category/{$category->slug}"))
                    ->setLastModificationDate($category->updated_at ?? now())
                    ->setChangeFrequency('weekly')
                    ->setPriority(0.7)
            );
        }

        return $sitemap->toResponse(request());
    }
}
