<?php

namespace App\Http\Controllers;

use App\Mail\ReportCitizens;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportCitizenController extends Controller
{
    public function send_report(Request $request) {
        $user= $request->user();
        $email = $user->email;

        $cities = City::withCount('citizens')->get();

        $lines = $cities->map(function($city) {
            return "{$city->name}: {$city->citizens_count} ciudadanos";
        });

        Mail::to($email)->send(new ReportCitizens($lines));
        return back()->with('success', 'Reporte enviado exitosamente');
    }
}
