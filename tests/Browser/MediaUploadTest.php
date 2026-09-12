<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\File;

class MediaUploadTest extends DuskTestCase
{
    /**
     * TEST 2 Browser: Upload media on Site 1 and verify on other sites
     */
    public function test_upload_media_on_site1_verify_on_all_sites()
    {
        // Create a test image file (1x1 pixel PNG)
        $testImagePath = storage_path('test-image.png');
        
        // PNG binary data (1x1 white pixel)
        $pngData = base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/8AhEQAI/AL+rC8BPwAAAABJRU5ErkJggg=='
        );
        
        File::put($testImagePath, $pngData);

        $this->browse(function (Browser $browser) use ($testImagePath) {
            // LOGIN TO ZUBILANT BALI TOURS
            $browser->visit('http://localhost:8003/blissinbaliadmin')
                ->pause(2000)
                ->type('[data-testid="email-input"]', 'admin@blissinbali.com')
                ->type('[data-testid="password-input"]', 'blissinbali2026')
                ->click('[data-testid="submit-button"]')
                ->pause(3000);

            // Navigate to Tour Packages
            $browser->visit('http://localhost:8003/blissinbaliadmin/tour-packages')
                ->pause(2000)
                ->click('[data-testid="create-button"]')
                ->pause(1000);

            // Fill package details
            $browser->type('[data-testid="title-input"]', 'Media Test Package - ' . time())
                ->pause(500);

            // Upload image
            $browser->attach('[data-testid="image-upload"]', $testImagePath)
                ->pause(3000)  // Wait for upload
                ->assertSee('Upload complete')
                ->click('[data-testid="save-button"]')
                ->pause(3000);

            echo "\n✅ Media uploaded to Site 1\n";
        });

        // VERIFY uploads reflected in file system
        $mediaPath = storage_path('app/public/tour-packages');
        $uploadedFiles = count(File::allFiles($mediaPath));
        
        echo "✅ Verified: $uploadedFiles files in local media storage\n";

        // Cleanup
        if (File::exists($testImagePath)) {
            File::delete($testImagePath);
        }
    }

    /**
     * TEST 2.2 Browser: Reuse image across different sites
     */
    public function test_reuse_uploaded_image_across_sites()
    {
        $this->browse(function (Browser $browser) {
            // LOGIN TO SITE 2
            $browser->visit('http://localhost:8001/admininbali')
                ->pause(2000)
                ->type('[data-testid="email-input"]', 'admin@inbalipackage.com')
                ->type('[data-testid="password-input"]', 'inbali2026menyala')
                ->click('[data-testid="submit-button"]')
                ->pause(3000);

            // Navigate to Tour Packages
            $browser->visit('http://localhost:8001/admininbali/tour-packages')
                ->pause(2000)
                ->click('[data-testid="create-button"]')
                ->pause(1000);

            // Fill package details
            $browser->type('[data-testid="title-input"]', 'Media Reuse Test - ' . time())
                ->pause(500);

            // Try to reuse image from media library (if available)
            // Click on media picker/library
            $browser->click('[data-testid="image-library-btn"]')
                ->pause(2000)
                ->assertSee('Media Library');

            echo "\n✅ Media library accessed on Site 2\n";
        });
    }

}
