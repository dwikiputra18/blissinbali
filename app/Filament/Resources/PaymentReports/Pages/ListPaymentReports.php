<?php

namespace App\Filament\Resources\PaymentReports\Pages;

use App\Filament\Resources\PaymentReports\PaymentReportResource;
use Filament\Resources\Pages\ListRecords;

class ListPaymentReports extends ListRecords
{
    protected static string $resource = PaymentReportResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
