<?php

namespace App\Filament\Resources\CarBookings\Pages;

use App\Filament\Resources\CarBookings\CarBookingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCarBooking extends CreateRecord
{
    protected static string $resource = CarBookingResource::class;
}
