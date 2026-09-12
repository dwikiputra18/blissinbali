<?php

namespace App\Http\Controllers;

use App\Models\CarRental;

class CarRentalController extends Controller
{
    public function index()
    {
        $cars = CarRental::where('is_active', true)->get();
        return view('car-rental.index', compact('cars'));
    }
}
