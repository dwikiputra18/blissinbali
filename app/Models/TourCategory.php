<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class TourCategory extends Model
{


    protected $fillable = [
        'site_id',
        'name',
        'slug',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function packages(): HasMany
    {
        return $this->hasMany(TourPackage::class, 'tour_category_id')
                    ->orderBy('sort_order');
    }

    public function activePackages(): HasMany
    {
        return $this->hasMany(TourPackage::class, 'tour_category_id')
                    ->where('is_active', true)
                    ->orderBy('sort_order');
    }
}