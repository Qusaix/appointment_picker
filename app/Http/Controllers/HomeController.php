<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Day;
use App\Models\Images;
use App\Models\Settings;

class HomeController extends Controller
{
    public function index()
    {
        $name = "Salem";
        $appointments = Appointment::where('status',1)->get();
        $images = Images::get();
        $daysOff = Day::where('isOff',1)->pluck('number')->all();
        $appInfo = Settings::find(1);
        $formatedAppointments = [];
        $makeCounterArray = [];
        foreach($appointments as $key => $ap)
        {
            $newFormate = (object)array(
                'title' => $ap->name,
                'start' => $ap->time
            );
            array_push($formatedAppointments,$newFormate);
        }
        return view('welcome',compact('name','formatedAppointments','daysOff','appInfo','images'));
    }
}
