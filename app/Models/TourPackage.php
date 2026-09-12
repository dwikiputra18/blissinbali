<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TourPackage extends Model
{

    protected static function booted(): void
    {
        static::creating(function (TourPackage $tourPackage): void {
            if (filled($tourPackage->tour_category_id)) {
                return;
            }

            $category = TourCategory::query()->orderBy('sort_order')->first();

            if (! $category) {
                $category = TourCategory::create([
                    'name' => 'Uncategorized',
                    'slug' => 'uncategorized',
                    'is_active' => true,
                    'sort_order' => 999,
                ]);
            }

            $tourPackage->tour_category_id = $category->id;
        });
    }

    protected $fillable = [
        'site_id',
        'tour_category_id',
        'is_activity',
        'title',
        'slug',
        'subtitle',
        'sub_category',
        'description',
        'highlights',
        'itinerary',
        'includes',
        'excludes',
        'thumbnail',
        'price_1_pax',
        'price_2_4',
        'price_5_7',
        'price_8_14',
        'activity_single_price',
        'activity_tandem_price',
        'tandem_price_2_4',
        'tandem_price_5_7',
        'tandem_price_8_14',
        'duration',
        'pickup_time',
        'location',
        'rating',
        'badge_icon',
        'badge_label',
        'terms',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_activity'      => 'boolean',
        'is_active'        => 'boolean',
        'is_featured'      => 'boolean',
        'price_2_4'        => 'decimal:2',
        'price_5_7'        => 'decimal:2',
        'price_8_14'       => 'decimal:2',
        'price_1_pax'      => 'decimal:2',
        'activity_single_price' => 'decimal:2',
        'activity_tandem_price' => 'decimal:2',
        'tandem_price_2_4' => 'decimal:2',
        'tandem_price_5_7' => 'decimal:2',
        'tandem_price_8_14' => 'decimal:2',
        'rating'           => 'decimal:1',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TourCategory::class, 'tour_category_id');
    }

    public function getIsAdventureAttribute(): bool
    {
        $category = Str::lower(($this->category?->slug ?? '') . ' ' . ($this->category?->name ?? ''));

        return Str::contains($category, 'adventure');
    }

    public function getMinimumBookingQuantityAttribute(): int
    {
        $category = Str::lower(($this->category?->slug ?? '') . ' ' . ($this->category?->name ?? ''));

        if ($this->is_adventure) {
            return 2;
        }

        if (Str::contains($category, 'honeymoon')) {
            return 2;
        }

        if (Str::contains($category, ['family-package', 'family package', 'family'])) {
            return 2;
        }

        return 1;
    }

    public function images(): HasMany
    {
        return $this->hasMany(TourPackageImage::class)->orderBy('sort_order');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (blank($this->thumbnail)) {
            return '';
        }

        if (preg_match('#^https?://#i', $this->thumbnail)) {
            return $this->thumbnail;
        }

        return Storage::disk('public')->url($this->thumbnail);
    }

    public function getEffectivePriceAttribute(): ?string
    {
        return $this->price_2_4;
    }

    public function getIsDiscountedAttribute(): bool
    {
        return false;
    }
}