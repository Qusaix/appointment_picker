<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Requests\AppointmentsRequest;
class AppointmentsController extends Controller
{
    public function store(AppointmentsRequest $request)
    {
        Appointment::create($request->appointment);
        return response()->json([
            'msg'=>'appointment was created',
            'status'=>200
        ],200);
    }
}
