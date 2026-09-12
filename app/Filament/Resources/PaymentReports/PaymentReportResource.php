<?php

namespace App\Filament\Resources\PaymentReports;

use App\Models\Booking;
use App\Models\CarBooking;
use App\Models\Site;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Filament\Resources\PaymentReports\Pages\ListPaymentReports;

class PaymentReportResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $label = 'Paid Booking';
    protected static ?string $pluralLabel = 'Paid Bookings';

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-banknotes';
    }

    public static function getNavigationGroup(): ?string
    {
        return null;
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }

    public static function getEloquentQuery(): Builder
    {
        return Booking::query()
            ->where('bookings.payment_status', 'Paid')
            ->select([
                'bookings.id',
                'bookings.booking_code',
                'bookings.name',
                'bookings.email',
                'bookings.phone',
                'bookings.travel_date',
                'bookings.quantity',
                'bookings.total_amount',
                'bookings.payment_status',
                'bookings.created_at',
                'bookings.site_id',
                'sites.name as site_name',
                'tour_packages.title as package_title',
                DB::raw("'Tour' as booking_type"),
            ])
            ->leftJoin('sites', 'sites.id', '=', 'bookings.site_id')
            ->leftJoin('tour_packages', 'tour_packages.id', '=', 'bookings.tour_package_id');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')
                    ->label('Website')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Bliss in Bali' => 'success',
                        default       => 'info',
                    })
                    ->searchable(query: fn (Builder $query, string $search) =>
                        $query->where('sites.name', 'like', "%{$search}%")
                    )
                    ->sortable(query: fn (Builder $query, string $direction) =>
                        $query->orderBy('sites.name', $direction)
                    ),

                Tables\Columns\TextColumn::make('booking_code')
                    ->label('Kode Booking')
                    ->searchable()
                    ->copyable()
                    ->fontFamily('mono'),

                Tables\Columns\TextColumn::make('package_title')
                    ->label('Paket / Produk')
                    ->searchable(query: fn (Builder $query, string $search) =>
                        $query->where('tour_packages.title', 'like', "%{$search}%")
                    )
                    ->limit(30),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Customer')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('travel_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Pax')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money('IDR')
                            ->label('Grand Total'),
                    ]),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Status')
                    ->colors([
                        'success' => 'Paid',
                        'danger'  => 'Failed',
                        'warning' => 'Unpaid',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Booking')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('site_id')
                    ->label('Website')
                    ->options(Site::pluck('name', 'id'))
                    ->query(fn (Builder $query, array $data) =>
                        $data['value'] ? $query->where('bookings.site_id', $data['value']) : $query
                    ),

                Tables\Filters\Filter::make('travel_date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')->label('Dari Tanggal'),
                        \Filament\Forms\Components\DatePicker::make('until')->label('Sampai Tanggal'),
                    ])
                    ->query(fn (Builder $query, array $data) =>
                        $query
                            ->when($data['from'], fn ($q) => $q->whereDate('travel_date', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('travel_date', '<=', $data['until']))
                    ),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([25, 50, 100]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentReports::route('/'),
        ];
    }

    // Read-only — no create/edit
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        return true;
    }
}
