<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class SharedMediaTest extends TestCase
{
    use RefreshDatabase;

    protected string $mediaPath;
    protected string $testImagePath = 'tours-test-image.jpg';

    protected function setUp(): void
    {
        parent::setUp();
        $this->mediaPath = storage_path('app/public');
        config(['app.website_id' => 1]);
    }

    /**
    * TEST 2.1: Verify media belongs to this application
     */
    public function test_media_storage_belongs_to_this_application()
    {
        $this->assertSame(storage_path('app/public'), $this->mediaPath);
        $this->assertFalse(is_link($this->mediaPath));
    }

    /**
     * TEST 2.2: Verify shared media directory structure exists
     */
    public function test_local_media_directory_structure()
    {
        $subdirs = ['banners', 'car-rentals', 'tour-packages', 'livewire-tmp'];

        foreach ($subdirs as $subdir) {
            $path = "$this->mediaPath/$subdir";
            $this->assertTrue(
                is_dir($path),
                "Missing shared media subdirectory: $subdir"
            );
        }
    }

    /**
     * TEST 2.3: Count existing media files
     */
    public function test_media_files_exist()
    {
        $files = collect(File::allFiles($this->mediaPath))
            ->filter(fn($file) => !str_contains($file->getPath(), 'livewire-tmp')) // Skip temp files
            ->toArray();

        $this->assertGreaterThan(0, count($files), 'No media files found in local media storage');
    }

    /**
     * TEST 2.4: Verify no null values in tour package file references
     */
    public function test_no_null_file_references()
    {
        // Check if TourPackageImage model exists and has files
        if (class_exists('App\Models\TourPackageImage')) {
            $nullImages = \App\Models\TourPackageImage::whereNull('file_path')->count();
            $this->assertEquals(0, $nullImages, 'Found tour package images without file paths');
        }
    }

    /**
     * TEST 2.5: Verify file access permissions on shared media
     */
    public function test_local_media_permissions()
    {
        $this->assertTrue(
            is_readable($this->mediaPath),
            'Local media directory is not readable'
        );

        $this->assertTrue(
            is_writable($this->mediaPath),
            'Local media directory is not writable'
        );
    }

    /**
     * TEST 2.6: Verify subdirectory permissions
     */
    public function test_subdirectory_permissions()
    {
        $tourPackagesPath = "$this->mediaPath/tour-packages";
        
        $this->assertTrue(is_dir($tourPackagesPath), 'Tour packages directory missing');
        $this->assertTrue(is_readable($tourPackagesPath), 'Tour packages directory not readable');
        $this->assertTrue(is_writable($tourPackagesPath), 'Tour packages directory not writable');
    }

    /**
     * TEST 2.7: Identify potential duplicate files by size
     */
    public function test_identify_potential_duplicates_by_size()
    {
        $files = File::allFiles($this->mediaPath);
        $sizeMap = [];

        foreach ($files as $file) {
            $size = $file->getSize();
            if (!isset($sizeMap[$size])) {
                $sizeMap[$size] = [];
            }
            $sizeMap[$size][] = $file->getPathname();
        }

        // Find sizes that appear multiple times
        $duplicateSizes = array_filter($sizeMap, fn($files) => count($files) > 1);

        // Log results
        if (!empty($duplicateSizes)) {
            echo "\n⚠️  Files with identical sizes (potential duplicates):\n";
            foreach ($duplicateSizes as $size => $files) {
                echo "  Size: $size bytes - " . count($files) . " files\n";
                foreach ($files as $file) {
                    echo "    - $file\n";
                }
            }
        }

        // This is informational - not a failure condition
        $this->assertIsArray($duplicateSizes);
    }
}
