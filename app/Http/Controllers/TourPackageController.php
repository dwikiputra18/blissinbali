<?php

namespace App\Http\Controllers;

use App\Models\TourCategory;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    /**
     * Halaman daftar paket — bisa filter per kategori
     */
    public function index(Request $request)
    {
        $categories = TourCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->withCount(['packages' => fn($q) => $q->where('is_active', true)])
            ->get();

        $activeCategory = null;

        $query = TourPackage::with(['category', 'images'])
            ->where('is_active', true)
            ->orderBy('sort_order');

        if ($request->filled('category')) {
            $activeCategory = TourCategory::where('slug', $request->category)
                ->where('is_active', true)
                ->firstOrFail();
            $query->where('tour_category_id', $activeCategory->id);
        }

        $packages = $query->get();

        return view('tour.index', compact('categories', 'packages', 'activeCategory'));
    }

    /**
     * Halaman detail paket
     */
    public function show(TourPackage $tourPackage)
    {
        abort_if(! $tourPackage->is_active, 404);

        $tourPackage->load(['category', 'images']);

        $related = TourPackage::with('images')
            ->where('is_active', true)
            ->where('tour_category_id', $tourPackage->tour_category_id)
            ->where('id', '!=', $tourPackage->id)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        // ── Open Graph Meta Data ──────────────────────────────────────────────
        $ogTitle = $tourPackage->title . ' — Bliss in Bali';

        // Bersihkan HTML tag, normalisasi whitespace, lalu potong maks 160 karakter
        $rawDesc    = strip_tags($tourPackage->description ?? '');
        $rawDesc    = preg_replace('/\s+/', ' ', $rawDesc);
        $ogDescription = mb_strlen($rawDesc) > 160
            ? mb_substr($rawDesc, 0, 157) . '...'
            : $rawDesc;

        if (blank($ogDescription)) {
            $ogDescription = 'Temukan paket wisata terbaik di Bali bersama Bliss in Bali. Pesan sekarang!';
        }

        // Resolve absolute image URL (thumbnail > gallery image > fallback logo)
        $ogImage = null;
        if (filled($tourPackage->thumbnail_url)) {
            $ogImage = $tourPackage->thumbnail_url;
        } elseif ($tourPackage->images->isNotEmpty()) {
            $ogImage = $tourPackage->images->first()->image_url;
        }

        // Pastikan URL absolut dengan HTTPS
        if (filled($ogImage) && ! preg_match('#^https?://#i', $ogImage)) {
            $ogImage = config('app.url') . '/' . ltrim($ogImage, '/');
        }
        if (blank($ogImage)) {
            // Fallback ke gambar default — logo/banner website
            $ogImage = url('logo.png');
        }
        // Paksa HTTPS pada image URL agar WhatsApp dan platform sosial dapat memuat gambar
        $ogImage = preg_replace('#^http://#i', 'https://', $ogImage);

        $ogUrl = route('tour.show', $tourPackage->slug);

        return view('tour.show', compact('tourPackage', 'related', 'ogTitle', 'ogDescription', 'ogImage', 'ogUrl'));
    }
}