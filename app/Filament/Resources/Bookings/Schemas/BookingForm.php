<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('booking_code')
                    ->disabled()
                    ->dehydrated(false),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('tour_package_id')
                    ->relationship('tourPackage', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('country_code'),
                DatePicker::make('travel_date')
                    ->required(),
                TextInput::make('pickup_point')
                    ->required(),
                TextInput::make('quantity')
                    ->numeric()
                    ->default(1)
                    ->required(),
                TextInput::make('total_amount')
                    ->numeric()
                    ->prefix('IDR')
                    ->required(),
                Select::make('payment_status')
                    ->options([
                        'Unpaid' => 'Unpaid',
                        'Paid' => 'Paid',
                        'Cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->default('Unpaid'),
            ]);
    }
}
