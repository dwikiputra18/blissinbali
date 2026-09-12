<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    protected function afterFill(): void
    {
        // Ketika admin membuka detail booking, set is_read menjadi true
        if (!$this->record->is_read) {
            $this->record->update([
                'is_read' => true,
            ]);
        }
    }
}
