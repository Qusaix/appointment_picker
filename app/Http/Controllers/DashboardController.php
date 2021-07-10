<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $appointments = Appointment::orderBy('created_at', 'desc')->get()->take(10);
        $today = Appointment::whereDate('created_at',Carbon::today())->orderBy('created_at','desc')->get();
        return view('dashboard.index',compact('appointments','today'));
    }
}
