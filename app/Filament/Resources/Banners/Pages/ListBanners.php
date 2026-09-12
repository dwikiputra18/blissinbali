<?php

namespace App\Filament\Resources\Banners\Pages;

use App\Filament\Resources\Banners\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;

class ListBanners extends ListRecords
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Banner'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Tambahkan widget statistik di sini jika diperlukan
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [
            'Banner',
        ];
    }
}
