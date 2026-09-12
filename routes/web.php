<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;
use App\Models\TourCategory;
use App\Models\TourPackage;
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CarRentalController;
use App\Http\Controllers\CarCheckoutController;
use App\Models\CarRental;
use App\Http\Controllers\PushSubscriptionController;
use App\Http\Controllers\SitemapController;

// Sitemap Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::post('/subscriptions', [PushSubscriptionController::class, 'store']);
Route::post('/subscriptions/delete', [PushSubscriptionController::class, 'destroy']);

Route::get('/', function () {
    $banners = Banner::where('is_active', true)->orderBy('order')->get();

 $categories = TourCategory::where('is_active', true)
    ->orderBy('sort_order', 'asc')
    ->get();

// 2. Ambil paket rekomendasi (untuk keperluan pengecekan @if di Blade)
$featuredPackages = TourPackage::with(['category', 'images'])
    ->where('is_active', true)
    ->where('is_featured', true)
    ->orderBy('sort_order', 'asc')
    ->take(9)
    ->get();

// 3. Ambil SEMUA paket (yang akan ditampilkan di grid)
$allPackages = TourPackage::with(['category', 'images'])
    ->where('is_active', true)
    ->orderBy('created_at', 'desc')
    ->get();

    $cars = CarRental::where('is_active', true)->take(3)->get();

    return view('dashboard', compact('banners', 'categories', 'featuredPackages', 'allPackages', 'cars'));
});

// Tour Package Routes
Route::get('/tour-packages', [TourPackageController::class, 'index'])->name('tour.index');
Route::get('/tour-packages/{tourPackage:slug}', [TourPackageController::class, 'show'])->name('tour.show');

// Checkout routes
Route::get('/checkout/{tourPackage:slug}', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/{tourPackage:slug}', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success/{booking:booking_code}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/pending/{booking:booking_code}', [CheckoutController::class, 'pending'])->name('checkout.pending');
Route::get('/checkout/error/{booking:booking_code}', [CheckoutController::class, 'error'])->name('checkout.error');
Route::post('/midtrans-callback', [CheckoutController::class, 'callback'])->name('checkout.callback');

// Car Rental Routes
Route::get('/car-rentals', [CarRentalController::class, 'index'])->name('car-rental.index');
Route::get('/car-rentals/checkout/{carRental:slug}', [CarCheckoutController::class, 'index'])->name('car-rental.checkout.index');
Route::post('/car-rentals/checkout/{carRental:slug}', [CarCheckoutController::class, 'process'])->name('car-rental.checkout.process');
Route::get('/car-rentals/checkout/success/{booking:booking_code}', [CarCheckoutController::class, 'success'])->name('car-rental.checkout.success');
Route::get('/car-rentals/checkout/pending/{booking:booking_code}', [CarCheckoutController::class, 'pending'])->name('car-rental.checkout.pending');
Route::get('/car-rentals/checkout/error/{booking:booking_code}', [CarCheckoutController::class, 'error'])->name('car-rental.checkout.error');
Route::post('/car-midtrans-callback', [CarCheckoutController::class, 'callback'])->name('car-rental.checkout.callback');

// Search Routes
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/autocomplete', function () {
    $q = trim(request('q', ''));

    if (strlen($q) < 2) {
        return response()->json(['packages' => [], 'categories' => []]);
    }

    $packages = TourPackage::with('category')
        ->where('is_active', true)
        ->where(function ($query) use ($q) {
            $query->where('title',       'like', "%{$q}%")
                  ->orWhere('location',  'like', "%{$q}%")
                  ->orWhere('duration',  'like', "%{$q}%")
                  ->orWhere('badge_label','like', "%{$q}%")
                  ->orWhere('description','like', "%{$q}%")
                  ->orWhereHas('category', fn($c) => $c->where('name', 'like', "%{$q}%"));
        })
        ->orderBy('sort_order')
        ->take(5)
        ->get()
        ->map(fn($p) => [
            'slug'             => $p->slug,
            'title'            => $p->title,
            'thumbnail'        => $p->thumbnail,
            'price'            => $p->price,
            'discounted_price' => $p->discounted_price,
            'location'         => $p->location,
            'category_name'    => $p->category?->name,
        ]);

    $categories = TourCategory::where('is_active', true)
        ->where('name', 'like', "%{$q}%")
        ->withCount(['packages' => fn($q) => $q->where('is_active', true)])
        ->orderBy('sort_order')
        ->take(3)
        ->get()
        ->map(fn($c) => [
            'slug'           => $c->slug,
            'name'           => $c->name,
            'packages_count' => $c->packages_count,
        ]);

    return response()->json(compact('packages', 'categories'));
})->name('search.autocomplete');

// Static Pages Routes
Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/help-center', function () {
    return view('pages.help');
})->name('help');

if (app()->environment('local')) { 
   Route::get('/storage/{path}', function ($path) { 
         $disk = Storage::disk('public');
         if ($disk->exists($path)) return response()->file($disk->path($path));
         abort(404);
   })->where('path', '.*'); 
}
Route::permanentRedirect('/tour/bali-ultimate-adventure-escape-4-days-of-thrills-culture-natural-wonders', '/');