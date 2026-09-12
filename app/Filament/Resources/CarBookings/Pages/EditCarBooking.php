<?php

namespace App\Filament\Resources\CarBookings\Pages;

use App\Filament\Resources\CarBookings\CarBookingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCarBooking extends EditRecord
{
    protected static string $resource = CarBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
