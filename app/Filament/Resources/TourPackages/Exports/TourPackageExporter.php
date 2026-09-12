<?php

namespace App\Filament\Resources\TourPackages\Exports;

use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class TourPackageExporter extends Exporter
{
    protected static ?string $model = \App\Models\TourPackage::class;

    public function getFormats(): array
    {
        return [ExportFormat::Csv];
    }

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('slug')->label('slug'),
            ExportColumn::make('category_slug')
                ->label('category_slug')
                ->getStateUsing(fn (\App\Models\TourPackage $record): ?string => $record->category?->slug),
            ExportColumn::make('is_activity')->label('is_activity'),
            ExportColumn::make('title')->label('title'),
            ExportColumn::make('subtitle')->label('subtitle'),
            ExportColumn::make('sub_category')->label('sub_category'),
            ExportColumn::make('description')->label('description'),
            ExportColumn::make('highlights')->label('highlights'),
            ExportColumn::make('itinerary')->label('itinerary'),
            ExportColumn::make('includes')->label('includes'),
            ExportColumn::make('excludes')->label('excludes'),
            ExportColumn::make('thumbnail')->label('thumbnail'),
            ExportColumn::make('price_1_pax')->label('price_1_pax'),
            ExportColumn::make('price_2_4')->label('price_2_4'),
            ExportColumn::make('price_5_7')->label('price_5_7'),
            ExportColumn::make('price_8_14')->label('price_8_14'),
            ExportColumn::make('activity_single_price')->label('activity_single_price'),
            ExportColumn::make('activity_tandem_price')->label('activity_tandem_price'),
            ExportColumn::make('tandem_price_2_4')->label('tandem_price_2_4'),
            ExportColumn::make('tandem_price_5_7')->label('tandem_price_5_7'),
            ExportColumn::make('tandem_price_8_14')->label('tandem_price_8_14'),
            ExportColumn::make('duration')->label('duration'),
            ExportColumn::make('pickup_time')->label('pickup_time'),
            ExportColumn::make('location')->label('location'),
            ExportColumn::make('rating')->label('rating'),
            ExportColumn::make('badge_icon')->label('badge_icon'),
            ExportColumn::make('badge_label')->label('badge_label'),
            ExportColumn::make('terms')->label('terms'),
            ExportColumn::make('is_active')->label('is_active'),
            ExportColumn::make('is_featured')->label('is_featured'),
            ExportColumn::make('sort_order')->label('sort_order'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'Tour packages berhasil diekspor ke CSV.';
    }
}