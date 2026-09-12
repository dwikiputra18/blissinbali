<?php

namespace App\Http\Controllers;

use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->get();

        return view('home', compact('banners'));
    }
}
