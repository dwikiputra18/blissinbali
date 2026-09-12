<?php

namespace App\Filament\Resources\CarRentals\Pages;

use App\Filament\Resources\CarRentals\CarRentalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCarRental extends CreateRecord
{
    protected static string $resource = CarRentalResource::class;
}
