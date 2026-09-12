<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait BelongsToSite
{
    public static function bootBelongsToSite(): void
    {
        static::addGlobalScope('site', function (Builder $query) {
            $siteId = config('app.site_id');
            // Batasi akses admin ke site yang sedang aktif.
            if ($siteId && $siteId != 1) {
                $table = (new static())->getTable();
                $query->where("{$table}.site_id", '=', (int) $siteId);
            }
        });

        static::creating(function ($model) {
            if (empty($model->site_id)) {
                $model->site_id = config('app.site_id', 1);
            }
        });
    }

    public static function acrossAllSites(): Builder
    {
        return static::withoutGlobalScope('site');
    }
}
