<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AppointmentImport;
use App\Exports\AppointmentExport;



class DashboardController extends Controller
{
    public function index()
    {
        $appointments = Appointment::orderBy('created_at', 'desc')->get()->take(5);
        $today = Appointment::whereDate('created_at',Carbon::today())->orderBy('created_at','desc')->get();
        $currentMonthEarnings = number_format(Appointment::where('status',1)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('price'),2);
        $annualEarnings = number_format(Appointment::where('status',1)->whereYear('created_at', Carbon::now()->year)->sum('price'),2);
        $pendingRequest = Appointment::where('price','=',null)->get()->count();
        // $monthlySales = [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 1000];
        $monthlySales = [];
        $todaAppointments = Appointment::orderBy('created_at','desc')->where('status',1)->whereDate('time', Carbon::today())->get();
        $todaAppointmentsEaring = number_format(Appointment::orderBy('created_at','desc')->where('status',1)->whereDate('time', Carbon::today())->sum('price'),2);

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

        

        return view('dashboard.index',compact('appointments','today','monthlySales','currentMonthEarnings','annualEarnings','pendingRequest','todaAppointments','todaAppointmentsEaring'));
    }

    public function export() 
    {
        return Excel::download(new AppointmentExport, 'report.xlsx');
    }

    public function import() 
    {
        Excel::import(new AppointmentImport,request()->file('file'));
           
        return redirect()->back();
    }

}
