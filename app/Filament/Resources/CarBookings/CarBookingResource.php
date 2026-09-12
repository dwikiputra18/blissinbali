<?php

namespace App\Filament\Resources\CarBookings;

use App\Filament\Resources\CarBookings\Pages\CreateCarBooking;
use App\Filament\Resources\CarBookings\Pages\EditCarBooking;
use App\Filament\Resources\CarBookings\Pages\ListCarBookings;
use App\Filament\Resources\CarBookings\Schemas\CarBookingForm;
use App\Filament\Resources\CarBookings\Tables\CarBookingsTable;
use App\Models\CarBooking;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CarBookingResource extends Resource
{
    protected static ?string $model = CarBooking::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('site_id', config('app.site_id'));
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationGroup(): ?string
    {
        return 'Car Management';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function form(Schema $schema): Schema
    {
        return CarBookingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CarBookingsTable::configure($table);
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
            'index' => ListCarBookings::route('/'),
            'create' => CreateCarBooking::route('/create'),
            'edit' => EditCarBooking::route('/{record}/edit'),
        ];
    }
}
