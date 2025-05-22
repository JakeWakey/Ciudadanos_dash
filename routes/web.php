<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CitizenController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportMail;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('cities',   CityController::class);
    Route::resource('citizens', CitizenController::class);

    Route::post('/send-report', function () {
        Mail::to(auth()->user()->email)->send(new ReportMail);
        return back()->with('success','Reporte enviado al correo.');
    })->name('report.send');
});

require __DIR__.'/auth.php';