<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
class HomeController extends Controller
{
    public function index()
    {
        $name = "Salem";
        $appointments = Appointment::get();
        $formatedAppointments = [];
        foreach($appointments as $ap)
        {
            $newFormate = (object)array(
                'title' => $ap->name,
                'start' => $ap->time
            );
            array_push($formatedAppointments,$newFormate);
        }
        return view('welcome',compact('name','formatedAppointments'));
    }
}
