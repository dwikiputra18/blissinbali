<?php

namespace App\Filament\Resources\CarBookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CarBookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('booking_code')
                    ->required(),
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('car_rental_id')
                    ->required()
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                DatePicker::make('rental_date')
                    ->required(),
                TextInput::make('rental_days')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('payment_status')
                    ->required()
                    ->default('Unpaid'),
            ]);
    }
}
