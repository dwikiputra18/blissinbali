<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'site_id',
        'title',
        'subtitle',
        'highlight_text',
        'description',
        'button_text',
        'button_link',
        'image',
        'gradient_color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('site_filter', function (Builder $query) {
            $siteId = config('app.site_id');
            $query->where(function ($q) use ($siteId) {
                $q->where('site_id', (int) $siteId)
                  ->orWhere('site_id', 0); 
            });
        });

        static::creating(function ($model) {
            if (empty($model->site_id)) {
                $model->site_id = config('app.site_id', 0);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
