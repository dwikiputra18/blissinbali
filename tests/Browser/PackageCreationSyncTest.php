<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PackageCreationSyncTest extends DuskTestCase
{
    /**
     * TEST 1 Browser: Create package on Site 1 and verify sync
     */
    public function test_create_package_on_site1_verify_sync_to_other_sites()
    {
        $this->browse(function (Browser $browser) {
            // LOGIN TO ZUBILANT BALI TOURS
            $browser->visit('http://localhost:8003/blissinbaliadmin')
                ->waitForLocation('http://localhost:8003/blissinbaliadmin')
                ->assertPresent('[data-testid="email-input"]')
                ->type('[data-testid="email-input"]', 'admin@blissinbali.com')
                ->type('[data-testid="password-input"]', 'blissinbali2026')
                ->click('[data-testid="submit-button"]')
                ->pause(3000)
                ->waitForLocation('http://localhost:8003/blissinbaliadmin/dashboard', 10);

            // NAVIGATE TO TOUR PACKAGES
            $browser->visit('http://localhost:8003/blissinbaliadmin/tour-packages')
                ->pause(2000)
                ->assertSee('Tour Packages');

            // CREATE NEW PACKAGE
            $browser->click('[data-testid="create-button"]')
                ->pause(1000)
                ->assertPresent('[data-testid="title-input"]')
                ->type('[data-testid="title-input"]', 'Paket Promo Bali 2026 AUTO TEST')
                ->pause(500);

            // Fill other fields
            $browser->type('[data-testid="price-2-4-input"]', '2999000')
                ->type('[data-testid="price-5-7-input"]', '2599000')
                ->selectDropdown('[data-testid="category-select"]', 1) // Select first category
                ->pause(500)
                ->click('[data-testid="is-active-toggle"]')
                ->click('[data-testid="is-featured-toggle"]')
                ->pause(500);

            // SUBMIT FORM
            $browser->click('[data-testid="save-button"]')
                ->pause(3000)
                ->assertSee('Paket Promo Bali 2026 AUTO TEST');

            echo "\n✅ Package created on Site 1\n";
        });

        // VERIFY ON SITE 2
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8001/admininbali')
                ->waitForLocation('http://localhost:8001/admininbali')
                ->type('[data-testid="email-input"]', 'admin@inbalipackage.com')
                ->type('[data-testid="password-input"]', 'inbali2026menyala')
                ->click('[data-testid="submit-button"]')
                ->pause(3000);

            $browser->visit('http://localhost:8001/admininbali/tour-packages')
                ->pause(2000)
                ->assertSee('Paket Promo Bali 2026 AUTO TEST');

            echo "\n✅ Package synced to Site 2\n";
        });

    }

    /**
     * TEST 1.2 Browser: Update package on Site 2 and verify sync
     */
    public function test_update_package_on_site2_verify_sync()
    {
        $this->browse(function (Browser $browser) {
            // LOGIN TO SITE 2
            $browser->visit('http://localhost:8001/admininbali')
                ->waitForLocation('http://localhost:8001/admininbali')
                ->type('[data-testid="email-input"]', 'admin@inbalipackage.com')
                ->type('[data-testid="password-input"]', 'inbali2026menyala')
                ->click('[data-testid="submit-button"]')
                ->pause(3000);

            // FIND AND EDIT PACKAGE
            $browser->visit('http://localhost:8001/admininbali/tour-packages')
                ->pause(2000)
                ->assertSee('Paket Promo Bali 2026 AUTO TEST')
                ->click('tr:contains("Paket Promo Bali 2026 AUTO TEST")')
                ->pause(2000);

            // UPDATE PRICE
            $browser->type('[data-testid="price-2-4-input"]', '2499000')
                ->pause(500)
                ->click('[data-testid="save-button"]')
                ->pause(2000)
                ->assertSee('Paket Promo Bali 2026 AUTO TEST');

            echo "\n✅ Package updated on Site 2\n";
        });

        // VERIFY UPDATE IN ZUBILANT BALI TOURS
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8003/blissinbaliadmin')
                ->waitForLocation('http://localhost:8003/blissinbaliadmin')
                ->type('[data-testid="email-input"]', 'admin@blissinbali.com')
                ->type('[data-testid="password-input"]', 'blissinbali2026')
                ->click('[data-testid="submit-button"]')
                ->pause(3000)
                ->visit('http://localhost:8003/blissinbaliadmin/tour-packages')
                ->pause(2000)
                ->assertSee('Paket Promo Bali 2026 AUTO TEST')
                ->click('tr:contains("Paket Promo Bali 2026 AUTO TEST")')
                ->pause(1000)
                ->assertInputValue('[data-testid="price-2-4-input"]', '2499000');

            echo "\n✅ Update synced to Site 1\n";
        });
    }
}
