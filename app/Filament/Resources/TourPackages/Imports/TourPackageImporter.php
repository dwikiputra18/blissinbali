<?php

namespace App\Filament\Resources\TourPackages\Imports;

use App\Models\TourCategory;
use App\Models\TourPackage;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class TourPackageImporter extends Importer
{
    protected static ?string $model = TourPackage::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('slug')->requiredMappingForNewRecordsOnly()->rules(['required', 'string', 'max:255']),
            ImportColumn::make('tour_category_id')
                ->label('category_slug')
                ->guesses(['category_slug', 'category', 'category_name'])
                ->requiredMappingForNewRecordsOnly()
                ->rules(['required'])
                ->castStateUsing(fn (?string $state): ?int => TourCategory::query()
                    ->where('site_id', 1)
                    ->where(fn ($query) => $query->where('slug', $state)->orWhere('name', $state))
                    ->value('id')),
            ImportColumn::make('is_activity')->boolean(),
            ImportColumn::make('title')->requiredMappingForNewRecordsOnly()->rules(['required', 'string', 'max:255']),
            ImportColumn::make('subtitle'),
            ImportColumn::make('sub_category'),
            ImportColumn::make('description'),
            ImportColumn::make('highlights'),
            ImportColumn::make('itinerary'),
            ImportColumn::make('includes'),
            ImportColumn::make('excludes'),
            ImportColumn::make('thumbnail'),
            ImportColumn::make('price_1_pax')->numeric(),
            ImportColumn::make('price_2_4')->numeric(),
            ImportColumn::make('price_5_7')->numeric(),
            ImportColumn::make('price_8_14')->numeric(),
            ImportColumn::make('activity_single_price')->numeric(),
            ImportColumn::make('activity_tandem_price')->numeric(),
            ImportColumn::make('tandem_price_2_4')->numeric(),
            ImportColumn::make('tandem_price_5_7')->numeric(),
            ImportColumn::make('tandem_price_8_14')->numeric(),
            ImportColumn::make('duration'),
            ImportColumn::make('pickup_time'),
            ImportColumn::make('location'),
            ImportColumn::make('rating')->numeric(decimalPlaces: 1),
            ImportColumn::make('badge_icon'),
            ImportColumn::make('badge_label'),
            ImportColumn::make('terms'),
            ImportColumn::make('is_active')->boolean(),
            ImportColumn::make('is_featured')->boolean(),
            ImportColumn::make('sort_order')->integer(),
        ];
    }

    public function resolveRecord(): ?TourPackage
    {
        return TourPackage::query()->firstOrNew([
            'site_id' => 1,
            'slug' => $this->data['slug'] ?? null,
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        return 'Tour packages berhasil diimpor. Periksa hasil dan baris yang gagal bila ada.';
    }
}