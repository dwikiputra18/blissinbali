<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\BelongsToSite;

class CarBooking extends Model
{
    use BelongsToSite;

    protected $fillable = [
        'site_id',
        'booking_code',
        'user_id',
        'car_rental_id',
        'name',
        'email',
        'phone',
        'rental_date',
        'rental_days',
        'total_amount',
        'payment_status',
        'snap_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carRental()
    {
        return $this->belongsTo(CarRental::class);
    }
}
