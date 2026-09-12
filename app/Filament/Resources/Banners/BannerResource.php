<?php

namespace App\Filament\Resources\Banners;

use App\Filament\Resources\Banners\Pages;
use App\Models\Banner;
use App\Models\Site;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Banner';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Banner';

    protected static ?string $pluralModelLabel = 'Banner';

    public static function getNavigationGroup(): ?string
    {
        return 'Dashboard Menu';
    }

    public static function form(Schema $schema): Schema
{
    return $schema->components([



        Section::make('Dashboard Menu')
            ->columns(2)
            ->schema([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(100)
                    ->columnSpanFull(),

                TextInput::make('subtitle')
                    ->label('Sub-judul / Label Atas')
                    ->maxLength(100)
                    ->helperText('Ditampilkan dengan warna oranye di atas judul.'),

                TextInput::make('highlight_text')
                    ->label('Teks Highlight')
                    ->maxLength(100)
                    ->helperText('Teks bergradient di bawah judul utama.'),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(300)
                    ->columnSpanFull(),
            ]),

        Section::make('Tombol Aksi')
            ->columns(2)
            ->schema([
                TextInput::make('button_text')
                    ->label('Teks Tombol')
                    ->required()
                    ->default('Selengkapnya')
                    ->maxLength(50),

                TextInput::make('button_link')
                    ->label('URL Tombol')
                    ->required()
                    ->default('#'),
            ]),

        Section::make('Gambar & Tampilan')
            ->columns(2)
            ->schema([
                FileUpload::make('image')
                    ->label('Gambar Banner')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('banners')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(5120)
                    ->helperText('Resolusi disarankan: 1920×1080px. Maks 5 MB.')
                    ->columnSpanFull(),

                Select::make('gradient_color')
                    ->label('Warna Gradasi Highlight')
                    ->required()
                    ->default('from-indigo-400 to-purple-600')
                    ->options([
                        'from-indigo-400 to-purple-600' => '🟣 Indigo → Ungu',
                        'from-blue-400 to-cyan-500'     => '🔵 Biru → Cyan',
                        'from-orange-400 to-rose-500'   => '🟠 Oranye → Rose',
                        'from-green-400 to-teal-500'    => '🟢 Hijau → Teal',
                        'from-yellow-400 to-orange-500' => '🟡 Kuning → Oranye',
                        'from-pink-400 to-fuchsia-600'  => '🌸 Pink → Fuchsia',
                        'from-red-400 to-orange-500'    => '🔴 Merah → Oranye',
                        'from-sky-400 to-blue-600'      => '☁️ Sky → Biru',
                    ])
                    ->native(false),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
            ]),

        Section::make('Status')
            ->schema([
                Toggle::make('is_active')
                    ->label('Aktifkan Banner')
                    ->default(true),
            ]),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site.name')
                    ->label('Website')
                    ->sortable()
                    ->badge()
                    ->color('success'),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->height(60)
                    ->width(100),

                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Sub-judul')
                    ->limit(30)
                    ->color('warning'),

                Tables\Columns\TextColumn::make('button_text')
                    ->label('Tombol')
                    ->badge()
                    ->color('info'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif')
                    ->placeholder('Semua'),
            ])
            ->actions([
    EditAction::make(),
    DeleteAction::make(),
])
->bulkActions([
    DeleteBulkAction::make(),
]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit'   => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}