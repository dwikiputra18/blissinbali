<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\BelongsToSite;

class Booking extends Model
{
    use BelongsToSite;

    protected $fillable = [
        'site_id',
        'booking_code',
        'user_id',
        'tour_package_id',
        'name',
        'email',
        'phone',
        'country_code',
        'travel_date',
        'pickup_point',
        'latitude',
        'longitude',
        'quantity',
        'single_quantity',
        'tandem_quantity',
        'pricing_option',
        'total_amount',
        'payment_status',
        'snap_token',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
