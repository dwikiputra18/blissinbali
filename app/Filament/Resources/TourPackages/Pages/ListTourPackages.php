<?php

namespace App\Filament\Resources\TourPackages\Pages;

use App\Filament\Resources\TourPackages\TourPackageResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TourPackages\Exports\TourPackageExporter;
use App\Filament\Resources\TourPackages\Imports\TourPackageImporter;

class ListTourPackages extends ListRecords
{
    protected static string $resource = TourPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ImportAction::make()->importer(TourPackageImporter::class),
            ExportAction::make()->exporter(TourPackageExporter::class),
        ];
    }
}
