<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
        'services' => \App\Models\Service::whereNull('parent_id')->with('children.children')->get(),
    ]);
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::post('/callback-request', [\App\Http\Controllers\CallbackController::class, 'store'])->name('callback.request');

Route::get('/service/{slug}', [\App\Http\Controllers\ServiceController::class, 'publicShow'])->name('services.public.show');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('services', \App\Http\Controllers\ServiceController::class);
});

Route::get('/api/services/top', [\App\Http\Controllers\ServiceController::class, 'topMenu'])->name('services.api.top');

require __DIR__ . '/settings.php';
