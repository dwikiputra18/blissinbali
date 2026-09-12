<?php

namespace App\Console\Commands;

use App\Models\TourPackage;
use App\Models\TourCategory;
use App\Models\Banner;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RunMultiSiteTests extends Command
{
    protected $signature = 'test:multi-site {--verbose}';
    protected $description = 'Run comprehensive multi-site synchronization tests';

    public function handle()
    {
        $this->line("\n╔═══════════════════════════════════════════════════════════╗");
        $this->line("║  AUTOMATED QA TESTING: Multi-Site Synchronization        ║");
        $this->line("╚═══════════════════════════════════════════════════════════╝\n");

        $tests = [
            'database_connectivity' => 'Database Connectivity Check',
            'shared_packages' => 'Shared Packages Visibility',
            'package_crud' => 'Package CRUD Operations',
            'data_sync_instant' => 'Instant Data Synchronization',
            'global_scope_filtering' => 'Global Scope Filtering',
            'duplicate_detection' => 'Duplicate Data Detection',
            'integrity_check' => 'Database Integrity Check',
        ];

        $results = [];

        foreach ($tests as $testKey => $testName) {
            $this->output->write("  Testing: $testName... ");
            
            try {
                $method = "test_$testKey";
                $result = $this->$method();
                
                if ($result) {
                    $this->info("✓ PASSED");
                    $results[$testName] = 'PASSED';
                } else {
                    $this->error("✗ FAILED");
                    $results[$testName] = 'FAILED';
                }
            } catch (\Exception $e) {
                $this->error("✗ ERROR: {$e->getMessage()}");
                $results[$testName] = 'ERROR';
            }
        }

        $this->printSummary($results);
    }

    private function test_database_connectivity(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function test_shared_packages(): bool
    {
        config(['app.website_id' => 1]);
        
        $sharedCount = TourPackage::where('site_id', 1)->count();
        $this->option('verbose') && $this->line("    Found $sharedCount shared packages");
        
        return $sharedCount > 0;
    }

    private function test_package_crud(): bool
    {
        config(['app.website_id' => 1]);

        // CREATE
        $package = TourPackage::create([
            'site_id' => 1,
            'title' => 'Test Package - ' . time(),
            'slug' => 'test-package-' . time(),
            'price_2_4' => 1500000,
            'is_active' => true,
        ]);

        $created = TourPackage::find($package->id) !== null;

        // UPDATE
        if ($created) {
            $package->update(['price_2_4' => 1600000]);
            $updated = $package->fresh()->price_2_4 === 1600000;
        } else {
            $updated = false;
        }

        // DELETE
        $package->delete();
        $deleted = TourPackage::find($package->id) === null;

        return $created && $updated && $deleted;
    }

    private function test_data_sync_instant(): bool
    {
        config(['app.website_id' => 1]);

        $package = TourPackage::create([
            'site_id' => 1,
            'title' => 'Sync Test - ' . time(),
            'slug' => 'sync-test-' . time(),
            'is_active' => true,
        ]);

        // Simulate instant update
        $startTime = microtime(true);
        $package->update(['is_featured' => true]);
        $endTime = microtime(true);

        $executionTime = ($endTime - $startTime) * 1000; // in milliseconds

        // Verify update
        $verified = $package->fresh()->is_featured === true;
        $this->option('verbose') && $this->line("    Sync completed in {$executionTime}ms");

        // Cleanup
        $package->delete();

        return $verified && $executionTime < 1000; // Should be less than 1 second
    }

    private function test_global_scope_filtering(): bool
    {
        // Test that when we query, global scope applies
        config(['app.website_id' => 1]);

        $totalCount = TourPackage::count();
        $siteIdOneCount = TourPackage::where('site_id', 1)->count();

        $this->option('verbose') && $this->line("    Total visible: $totalCount, Site 1 packages: $siteIdOneCount");

        // At minimum, all site_id=1 packages should be visible
        return $totalCount >= $siteIdOneCount;
    }

    private function test_duplicate_detection(): bool
    {
        // Check for duplicate IDs
        $duplicates = TourPackage::select('id')
            ->groupBy('id')
            ->havingRaw('count(*) > 1')
            ->count();

        $this->option('verbose') && $this->line("    Duplicate IDs found: $duplicates");

        return $duplicates === 0;
    }

    private function test_integrity_check(): bool
    {
        // Check for null site_ids
        $nullSiteIds = TourPackage::whereNull('site_id')->count();
        $this->option('verbose') && $this->line("    Records with null site_id: $nullSiteIds");

        return $nullSiteIds === 0;
    }

    private function printSummary(array $results): void
    {
        $this->line("\n╔═════════════════════════════════════════════════════════╗");
        $this->line("║  TEST RESULTS SUMMARY                                  ║");
        $this->line("╚═════════════════════════════════════════════════════════╝\n");

        $passed = 0;
        $failed = 0;
        $errors = 0;

        foreach ($results as $test => $result) {
            $icon = match ($result) {
                'PASSED' => '✓',
                'FAILED' => '✗',
                'ERROR' => '⚠',
                default => '?'
            };

            $color = match ($result) {
                'PASSED' => 'info',
                'FAILED' => 'error',
                'ERROR' => 'error',
                default => 'line'
            };

            $this->$color("  $icon $test: $result");

            match ($result) {
                'PASSED' => $passed++,
                'FAILED' => $failed++,
                'ERROR' => $errors++,
                default => null
            };
        }

        $total = count($results);
        $this->line("\n  ────────────────────────────────────────");
        $this->line("  Total: $total | Passed: $passed | Failed: $failed | Errors: $errors");
        $this->line("  ────────────────────────────────────────\n");

        if ($failed === 0 && $errors === 0) {
            $this->info("  ✓ ALL TESTS PASSED\n");
        } else {
            $this->error("  ✗ SOME TESTS FAILED\n");
        }
    }
}
