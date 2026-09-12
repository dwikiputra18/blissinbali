<?php

namespace App\Filament\Resources\TourPackages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TourPackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tour_category_id')
                    ->required()
                    ->numeric(),
                Toggle::make('is_activity')
                    ->label('Activities')
                    ->live()
                    ->helperText('Aktifkan untuk produk Activities dengan pilihan harga Single/Tandem.'),
                Select::make('sub_category')
                    ->options([
                        'Ubud Tour' => 'Ubud Tour',
                        'Kintamani Tour' => 'Kintamani Tour',
                        'Island Tour' => 'Island Tour',
                        'South Bali' => 'South Bali',
                        'East Bali' => 'East Bali',
                        'North Bali' => 'North Bali',
                        'West Bali' => 'West Bali',
                    ])
                    ->placeholder('Select Sub Category (for Oneday Tour)'),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('subtitle')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('highlights')
                    ->columnSpanFull(),
                Textarea::make('itinerary')
                    ->columnSpanFull()
                    ->label('Destination / Itinerary'),
                Textarea::make('includes')
                    ->columnSpanFull(),
                Textarea::make('excludes')
                    ->columnSpanFull(),
                TextInput::make('pickup_time'),
                TextInput::make('thumbnail')
                    ->label('Thumbnail URL or local path')
                    ->helperText('Gunakan URL eksternal atau path file upload yang valid.'),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Base Price'),
                TextInput::make('price_1_pax')
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Price (1 Pax)')
                    ->helperText('Harga 1 pax, biasanya harga 2-4 pax + Rp300.000.'),
                TextInput::make('price_2_4')
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Price (2-4 Pax)'),
                TextInput::make('price_5_7')
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Price (5-7 Pax)'),
                TextInput::make('price_8_14')
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Price (8-14 Pax)'),
                Section::make('Activities Pricing')
                    ->description('Harga Tandem per pax Minimum booking: 2 pax.')
                    ->schema([
                        TextInput::make('tandem_price_2_4')
                            ->numeric()
                            ->prefix('Rp')
                            ->label('Tandem Price (2-4 Pax) / person'),
                        TextInput::make('tandem_price_5_7')
                            ->numeric()
                            ->prefix('Rp')
                            ->label('Tandem Price (5-7 Pax) / person'),
                        TextInput::make('tandem_price_8_14')
                            ->numeric()
                            ->prefix('Rp')
                            ->label('Tandem Price (8-14 Pax) / person'),
                    ])
                            ->columns(1)
                            ->columnSpanFull()
                    ->visible(fn ($get) => (bool) $get('is_activity')),
                TextInput::make('location')
                    ->label('Location')
                    ->placeholder('Contoh: Ubud, Bali'),
                TextInput::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(5)
                    ->step(0.1),
                TextInput::make('badge_label')
                    ->label('Badge Label')
                    ->placeholder('Contoh: Best Seller'),
                TextInput::make('badge_icon')
                    ->label('Badge Icon')
                    ->placeholder('Contoh: fa-star'),
                TextInput::make('discounted_price')
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Discounted Price')
                    ->nullable(),
                TextInput::make('duration')
                    ->label('Duration')
                    ->placeholder('Contoh: 8 Hours'),
                Textarea::make('terms')
                    ->label('Good to know')
                    ->helperText('Informasi penting seperti konfirmasi, pembatalan, cuaca, dan persyaratan peserta.')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
