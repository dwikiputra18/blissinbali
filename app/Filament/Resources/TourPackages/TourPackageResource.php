<?php

namespace App\Filament\Resources\TourPackages;

use App\Filament\Resources\TourPackages\Pages;
use App\Models\TourPackage;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TourPackageResource extends Resource
{
    protected static ?string $model = TourPackage::class;
    protected static ?string $label = 'Tour Package';
    protected static ?string $pluralLabel = 'Tour Packages';

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-map';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Tour Management';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informasi Paket')
                ->schema([
                    Select::make('tour_category_id')
                        ->label('Kategori')
                        ->relationship('category', 'name',
                            fn ($query) => $query->where('is_active', true)
                                                 ->orderBy('sort_order')
                        )
                        ->searchable()
                        ->preload()
                        ->live()
                        ->required(),

                    Select::make('sub_category')
                        ->label('Sub Kategori (Khusus Oneday Tour)')
                        ->options([
                            'Ubud Tour' => 'Ubud Tour',
                            'Kintamani Tour' => 'Kintamani Tour',
                            'Island Tour' => 'Island Tour',
                            'South Bali' => 'South Bali',
                            'East Bali' => 'East Bali',
                            'North Bali' => 'North Bali',
                            'West Bali' => 'West Bali',
                        ])
                        ->placeholder('Pilih Sub Kategori')
                        ->visible(fn ($get): bool => 
                            stripos(\App\Models\TourCategory::find($get('tour_category_id'))?->name ?? '', 'oneday') !== false
                        )
                        ->nullable(),

                    TextInput::make('title')
                        ->label('Judul Paket')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($set, ?string $state) =>
                            $set('slug', Str::slug($state))
                        ),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    TextInput::make('subtitle')
                        ->label('Sub Judul / Intro Singkat')
                        ->columnSpanFull()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->label('Deskripsi Umum')
                        ->rows(4)
                        ->columnSpanFull(),

                    Textarea::make('highlights')
                        ->label('Highlights')
                        ->rows(4)
                        ->columnSpanFull()
                        ->helperText('Gunakan baris baru untuk setiap poin highlights.'),

                    Textarea::make('itinerary')
                        ->label('Destination / Itinerary')
                        ->rows(6)
                        ->columnSpanFull()
                        ->helperText('Gunakan baris baru untuk setiap destinasi/titik itinerary.'),

                    Textarea::make('includes')
                        ->label('Include')
                        ->rows(4)
                        ->columnSpanFull()
                        ->helperText('Gunakan baris baru untuk setiap item yang termasuk.'),

                    Textarea::make('excludes')
                        ->label('Exclude')
                        ->rows(4)
                        ->columnSpanFull()
                        ->helperText('Gunakan baris baru untuk setiap item yang tidak termasuk.'),

                    TextInput::make('pickup_time')
                        ->label('Pickup & Time')
                        ->placeholder('Contoh: 08:30 AM')
                        ->nullable(),
                ])
                ->columns(2),

            Section::make('Harga & Detail')
                ->schema([
                    TextInput::make('duration')
                        ->label('Durasi')
                        ->placeholder('Contoh: 1 Day, 3 Days 2 Nights')
                        ->nullable(),

                    TextInput::make('location')
                        ->label('Lokasi')
                        ->placeholder('Contoh: Klungkung, Bali')
                        ->nullable(),

                    Section::make('Tiered Pricing (Pricelist)')
                        ->description('Harga berdasarkan jumlah peserta.')
                        ->schema([
                            TextInput::make('price_1_pax')
                                ->label('Price (1 Pax)')
                                ->numeric()
                                ->prefix('Rp')
                                ->nullable(),
                            TextInput::make('price_2_4')
                                ->label('Price (2-4 Pax)')
                                ->numeric()
                                ->prefix('Rp')
                                ->nullable(),
                            TextInput::make('price_5_7')
                                ->label('Price (5-7 Pax)')
                                ->numeric()
                                ->prefix('Rp')
                                ->nullable(),
                            TextInput::make('price_8_14')
                                ->label('Price (8-14 Pax)')
                                ->numeric()
                                ->prefix('Rp')
                                ->nullable(),
                        ]),

                    Toggle::make('is_activity')
                        ->label('Activities')
                        ->live()
                        ->helperText('Aktifkan untuk menampilkan pilihan harga Single/Tandem saat booking.')
                        ->inline(false),

                    Section::make('Activities Pricing')
                        ->description('Harga Tandem per pax Minimum booking: 2 pax.')
                        ->schema([
                            TextInput::make('tandem_price_2_4')
                                ->label('Tandem Price (2-4 Pax) / person')
                                ->numeric()
                                ->prefix('Rp')
                                ->nullable(),
                            TextInput::make('tandem_price_5_7')
                                ->label('Tandem Price (5-7 Pax) / person')
                                ->numeric()
                                ->prefix('Rp')
                                ->nullable(),
                            TextInput::make('tandem_price_8_14')
                                ->label('Tandem Price (8-14 Pax) / person')
                                ->numeric()
                                ->prefix('Rp')
                                ->nullable(),
                        ])
                            ->columns(1)
                            ->columnSpanFull()
                        ->visible(fn ($get): bool => (bool) $get('is_activity')),

                    TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true)
                        ->inline(false),
                ])
                ->columns(2),

            Section::make('Terms & Conditions')
                ->schema([
                    Textarea::make('terms')
                        ->label('Terms')
                        ->rows(4)
                        ->columnSpanFull()
                        ->helperText('Syarat dan ketentuan khusus untuk paket ini.'),
                ]),

            Section::make('Tampilkan di Beranda')
                ->description('Pengaturan card destinasi yang ditampilkan di halaman utama website.')
                ->schema([
                    Toggle::make('is_featured')
                        ->label('Jadikan Rekomendasi di Beranda')
                        ->helperText('Aktifkan untuk menampilkan paket ini di section Destinasi Populer.')
                        ->default(false)
                        ->inline(false)
                        ->columnSpanFull(),

                    TextInput::make('rating')
                        ->label('Rating')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(5)
                        ->step(0.1)
                        ->placeholder('Contoh: 4.9')
                        ->nullable()
                        ->helperText('Skala 0.0 - 5.0'),

                    TextInput::make('badge_label')
                        ->label('Badge Label')
                        ->placeholder('Contoh: Fotografi, Pantai, Sunset View')
                        ->nullable(),

                    TextInput::make('badge_icon')
                        ->label('Badge Icon (Font Awesome)')
                        ->placeholder('Contoh: fa-camera, fa-umbrella-beach, fa-mountain')
                        ->nullable()
                        ->helperText('Isi nama class Font Awesome tanpa "fas". Lihat: fontawesome.com/icons'),
                ])
                ->columns(2),

            Section::make('Gambar')
                ->schema([
                    FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->disk('public')
                        ->image()
                        ->directory('tour-packages')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeTargetWidth('800')
                        ->imageResizeTargetHeight('450')
                        ->nullable(),
                ]),

            Section::make('Galeri Foto')
                ->description('Tambahkan foto-foto tambahan untuk paket ini. Urutan dapat diatur dengan drag & drop.')
                ->schema([
                    Repeater::make('images')
                        ->relationship('images')
                        ->label('')
                        ->schema([
                            FileUpload::make('image')
                                ->label('Foto')
                                ->disk('public')
                                ->image()
                                ->directory('tour-packages/gallery')
                                ->imageResizeMode('cover')
                                ->imageCropAspectRatio('16:9')
                                ->imageResizeTargetWidth('1200')
                                ->imageResizeTargetHeight('675')
                                ->required(),
                        ])
                        ->orderColumn('sort_order')
                        ->reorderable()
                        ->addActionLabel('+ Tambah Foto')
                        ->grid(3)
                        ->defaultItems(0)
                        ->minItems(0),
                ]),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Foto')
                    ->disk('public')
                    ->width(80)
                    ->height(50),

                Tables\Columns\TextColumn::make('images_count')
                    ->label('Galeri')
                    ->counts('images')
                    ->badge()
                    ->color('info')
                    ->suffix(' foto'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_2_4')
                    ->label('Price (2-4)')
                    ->money('IDR')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('price_5_7')
                    ->label('Price (5-7)')
                    ->money('IDR')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('price_8_14')
                    ->label('Price (8-14)')
                    ->money('IDR')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('activity_single_price')
                    ->label('Activities Single')
                    ->money('IDR')
                    ->placeholder('-')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('activity_tandem_price')
                    ->label('Activities Tandem')
                    ->money('IDR')
                    ->placeholder('-')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Durasi')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Rekomendasi'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tour_category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Rekomendasi Beranda'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTourPackages::route('/'),
            'create' => Pages\CreateTourPackage::route('/create'),
            'edit'   => Pages\EditTourPackage::route('/{record}/edit'),
        ];
    }
}