<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Requests\AppointmentsRequest;
class AppointmentsController extends Controller
{
    public function store(AppointmentsRequest $request)
    {
        $dayCheck = Appointment::where('time',$request->time)->get()->count();
        if($dayCheck > 4)
        {
            return response()->json([
                'err'=>'the day is full',
                'status'=>202
            ],202);
        }
        Appointment::create($request->appointment);
        return response()->json([
            'msg'=>'appointment was created',
            'status'=>201
        ],201);
    }
}
