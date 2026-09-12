<?php

namespace App\Filament\Resources\CarRentals\Pages;

use App\Filament\Resources\CarRentals\CarRentalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCarRentals extends ListRecords
{
    protected static string $resource = CarRentalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
