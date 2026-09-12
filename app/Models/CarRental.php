<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarRental extends Model
{


    protected $fillable = [
        'site_id',
        'name',
        'slug',
        'image',
        'description',
        'price',
        'discounted_price',
        'is_active',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
