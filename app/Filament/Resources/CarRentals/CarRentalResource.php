<?php

namespace App\Filament\Resources\CarRentals;

use App\Filament\Resources\CarRentals\Pages\CreateCarRental;
use App\Filament\Resources\CarRentals\Pages\EditCarRental;
use App\Filament\Resources\CarRentals\Pages\ListCarRentals;
use App\Filament\Resources\CarRentals\Schemas\CarRentalForm;
use App\Filament\Resources\CarRentals\Tables\CarRentalsTable;
use App\Models\CarRental;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CarRentalResource extends Resource
{
    protected static ?string $model = CarRental::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationGroup(): ?string
    {
        return 'Car Management';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function form(Schema $schema): Schema
    {
        return CarRentalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CarRentalsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCarRentals::route('/'),
            'create' => CreateCarRental::route('/create'),
            'edit' => EditCarRental::route('/{record}/edit'),
        ];
    }
}
