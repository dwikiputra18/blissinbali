<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action; // Pastikan class ini tetap dipertahankan
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->columns([
                TextColumn::make('booking_code')
                    ->searchable()
                    ->sortable()
                    ->weight(fn ($record) => $record->is_read ? 'normal' : 'bold'),

                TextColumn::make('name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable()
                    ->weight(fn ($record) => $record->is_read ? 'normal' : 'bold'),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('tourPackage.title')
                    ->label('Tour Package')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('travel_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->badge()
                    ->searchable()
                    ->color(fn (string $state): string => match ($state) {
                        'Paid' => 'success',
                        'Unpaid' => 'warning',
                        'Failed', 'Cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('payment_status')
                    ->label('Payment Status')
                    ->options([
                        'Paid' => 'Paid',
                        'Unpaid' => 'Unpaid',
                        'Cancelled' => 'Cancelled',
                    ]),
            ])
            ->recordActions([
                Action::make('markAsRead')
                    ->label('Mark as Read')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => !$record->is_read)
                    ->action(function ($record) {
                        $record->update(['is_read' => true]);
                    }),

                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('markSelectedAsRead')
                        ->label('Mark as Read')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->action(fn (Collection $records) => $records->each->update(['is_read' => true])),

                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}