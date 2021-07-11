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
        $currentMonthEarnings = Appointment::whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('price');
        $annualEarnings = Appointment::whereYear('created_at', Carbon::now()->year)
        ->sum('price');
        $pendingRequest = Appointment::where('price','=',null)->get()->count();
        // $monthlySales = [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 1000];
        $monthlySales = [];
        //monthlySales logic
        $year = Carbon::now()->year;
        $month = 1;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 2;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 3;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 4;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 5;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 6;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 7;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 8;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 9;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 10;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 11;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);
        $month = 12;
        $m1 = Appointment::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->where('price','>',0)
        ->sum('price');
        array_push($monthlySales,$m1);

        

        return view('dashboard.index',compact('appointments','today','monthlySales','currentMonthEarnings','annualEarnings','pendingRequest'));
    }
}
