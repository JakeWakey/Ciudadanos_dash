<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportMail;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\CityController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {

    Route::resource('cities',   CityController::class);
    Route::resource('citizens', CitizenController::class);

    Route::post('/send-report', function () {
        Mail::to(auth()->user()->email)->send(new ReportMail);
        return back()->with('success','Reporte enviado al correo.');
    })->name('report.send');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ciudadanos', [CitizenController::class, 'index'])->name('ciudadanos');
});


Route::resource('ciudades', CityController::class)
    ->parameters(['ciudades' => 'ciudad'])
    ->middleware('auth');

Route::resource('ciudadanos', CitizenController::class)
    ->parameters(['ciudadanos' => 'ciudadano'])
    ->middleware('auth');

require __DIR__.'/auth.php';

