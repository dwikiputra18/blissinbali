<?php

namespace App\Http\Controllers;

use App\Models\TourCategory;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->get('q', ''));

        if (empty($query)) {
            return redirect()->route('tour.index');
        }

        $packages = TourPackage::with(['category', 'images'])
            ->where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title',       'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('location',    'like', "%{$query}%")
                  ->orWhere('duration',    'like', "%{$query}%")
                  ->orWhere('badge_label', 'like', "%{$query}%")
                  ->orWhereHas('category', fn($c) => $c->where('name', 'like', "%{$query}%"));
            })
            ->orderBy('sort_order')
            ->get();

        $categories = TourCategory::where('is_active', true)
            ->where('name', 'like', "%{$query}%")
            ->orderBy('sort_order')
            ->get();

        return view('tour.search', compact('packages', 'categories', 'query'));
    }
}