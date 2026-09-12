<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class TourPackageImage extends Model
{
    protected $fillable = [
        'tour_package_id',
        'image',
        'sort_order',
    ];

    public function getImageUrlAttribute(): string
    {
        if (blank($this->image)) {
            return '';
        }

        if (preg_match('#^https?://#i', $this->image)) {
            return $this->image;
        }

        return Storage::disk('public')->url($this->image);
    }

    public function tourPackage(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class);
    }
}