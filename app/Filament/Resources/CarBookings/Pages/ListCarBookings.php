<?php

namespace App\Filament\Resources\CarBookings\Pages;

use App\Filament\Resources\CarBookings\CarBookingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCarBookings extends ListRecords
{
    protected static string $resource = CarBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
