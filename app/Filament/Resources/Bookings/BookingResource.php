<?php

namespace App\Filament\Resources\Bookings;

use App\Filament\Resources\Bookings\Pages\CreateBooking;
use App\Filament\Resources\Bookings\Pages\EditBooking;
use App\Filament\Resources\Bookings\Pages\ListBookings;
use App\Filament\Resources\Bookings\Schemas\BookingForm;
use App\Filament\Resources\Bookings\Tables\BookingsTable;
use App\Models\Booking;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('site_id', config('app.site_id'));
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    /**
     * Menampilkan angka notifikasi di sidebar
     */
    public static function getNavigationBadge(): ?string
    {
        // Opsi A: Jika menggunakan kolom khusus is_read (Sangat Disarankan)
        $count = static::getModel()::where('site_id', config('app.site_id'))
            ->where('is_read', false)
            ->count();

        // Opsi B: Jika ingin menggunakan payment_status 'Unpaid' sebagai indikator
        // $count = static::getModel()::where('payment_status', 'Unpaid')->count();

        return $count > 0 ? (string) $count : null;
    }

    /**
     * Mengatur warna angka notifikasi menjadi merah (seperti WA/Notif)
     */
    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }


    public static function form(Schema $schema): Schema
    {
        return BookingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookingsTable::configure($table);
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
            'index' => ListBookings::route('/'),
            'create' => CreateBooking::route('/create'),
            'edit' => EditBooking::route('/{record}/edit'),
        ];
    }
}