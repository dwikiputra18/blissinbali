<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'name',
        'domain',
        'prefix',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
