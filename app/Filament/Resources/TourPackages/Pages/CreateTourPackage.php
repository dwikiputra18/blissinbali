<?php

namespace App\Filament\Resources\TourPackages\Pages;

use App\Filament\Resources\TourPackages\TourPackageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTourPackage extends CreateRecord
{
    protected static string $resource = TourPackageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Force site_id to 1 (shared) so packages appear on all websites
        $data['site_id'] = 1;
        return $data;
    }
}
