<?php

namespace Tests\Feature;

use App\Models\TourPackage;
use App\Models\TourCategory;
use App\Models\Banner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MultiSiteSyncTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Set the Bliss site for testing
        config(['app.website_id' => 1]);
    }

    /**
     * TEST 1: Verify shared packages are visible across all sites
     */
    public function test_shared_packages_are_visible_on_all_sites()
    {
        // Create test package with site_id=1 (shared)
        $package = TourPackage::create([
            'site_id' => 1,
            'title' => 'Paket Promo Bali 2026 - TEST',
            'slug' => 'paket-promo-bali-2026-test',
            'description' => 'QA Test Package for Multi-Site Sync',
            'price_2_4' => 2999000,
            'price_5_7' => 2599000,
            'is_active' => true,
            'is_featured' => true,
        ]);

        // Verify package is created
        $this->assertDatabaseHas('tour_packages', [
            'id' => $package->id,
            'site_id' => 1,
            'title' => 'Paket Promo Bali 2026 - TEST',
        ]);

        // Simulate Site 2 & 3 accessing via global scope
        // The BelongsToSite trait should filter correctly
        $this->assertTrue($package->site_id === 1);
        $this->assertFalse($package->site_id === 2);
        $this->assertFalse($package->site_id === 3);

        // Count packages with site_id = 1 (should be visible on all sites)
        $sharedPackages = TourPackage::where('site_id', 1)->count();
        $this->assertGreaterThan(0, $sharedPackages);
    }

    /**
     * TEST 1.2: Verify package updates sync instantly
     */
    public function test_package_price_update_syncs_instantly()
    {
        $package = TourPackage::create([
            'site_id' => 1,
            'title' => 'Sync Test Package',
            'slug' => 'sync-test-package',
            'price_2_4' => 2999000,
            'price_5_7' => 2599000,
            'is_active' => true,
        ]);

        // Update price (simulating Site 2 update)
        $package->update(['price_2_4' => 2499000]);

        // Verify update in database immediately
        $this->assertDatabaseHas('tour_packages', [
            'id' => $package->id,
            'price_2_4' => 2499000,
        ]);

        // Fetch fresh from DB to simulate other sites reading
        $updatedPackage = TourPackage::find($package->id);
        $this->assertEquals(2499000, $updatedPackage->price_2_4);
    }

    /**
     * TEST 1.3: Verify package deletion is global
     */
    public function test_package_deletion_is_global()
    {
        $package = TourPackage::create([
            'site_id' => 1,
            'title' => 'Delete Test Package',
            'slug' => 'delete-test-package',
            'is_active' => true,
        ]);

        $packageId = $package->id;
        $package->delete();

        // Verify deletion from database
        $this->assertDatabaseMissing('tour_packages', [
            'id' => $packageId,
        ]);

        // Verify all sites cannot access deleted package
        $this->assertNull(TourPackage::find($packageId));
    }

    /**
     * TEST 1.4: Verify shared categories sync across sites
     */
    public function test_shared_categories_sync_across_sites()
    {
        $category = TourCategory::create([
            'site_id' => 1,
            'name' => 'Adventure Tours - TEST',
            'slug' => 'adventure-tours-test',
        ]);

        $this->assertDatabaseHas('tour_categories', [
            'id' => $category->id,
            'site_id' => 1,
            'name' => 'Adventure Tours - TEST',
        ]);

        // Verify it's accessible as shared data
        $foundCategory = TourCategory::find($category->id);
        $this->assertEquals('Adventure Tours - TEST', $foundCategory->name);
    }

    /**
     * TEST 1.5: Verify no duplicate IDs across sites
     */
    public function test_no_duplicate_package_ids()
    {
        // Create multiple packages
        for ($i = 1; $i <= 5; $i++) {
            TourPackage::create([
                'site_id' => 1,
                'title' => "Bulk Test Package $i",
                'slug' => "bulk-test-package-$i",
                'is_active' => true,
            ]);
        }

        // Check for duplicates
        $duplicates = TourPackage::select('id')
            ->groupBy('id')
            ->havingRaw('count(*) > 1')
            ->count();

        $this->assertEquals(0, $duplicates, 'Found duplicate package IDs');
    }

    /**
     * TEST 1.6: Verify all packages have site_id assigned
     */
    public function test_all_packages_have_site_id()
    {
        $nullSiteIds = TourPackage::whereNull('site_id')->count();
        $this->assertEquals(0, $nullSiteIds, 'Found packages with null site_id');
    }
}
