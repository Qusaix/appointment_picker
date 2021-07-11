<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Requests\AppointmentsRequest;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointment::paginate(50);
        return view('dashboard.appointment.index',compact('appointments'));
    }
    public function store(AppointmentsRequest $request)
    {   
        $request->merge(['ip' => $request->getClientIp()]);
        // return $request;
        $dayCheck = Appointment::where('time',$request->time)->get()->count();
        if($dayCheck >= 4)
        {
            return response()->json([
                'err'=>'the day is full',
                'status'=>202
            ],202);
        }
        Appointment::create($request->all());
        return response()->json([
            'msg'=>'appointment was created',
            'ip'=>$request->getClientIp(),
            'status'=>201
        ],201);
    }

    public function datatable()
    {
        $data = Appointment::orderBy('created_at','desc')->get();

        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('price',function(Appointment $appointment){
            if($appointment->price == null)
            {
                return 'no price avalible';
            }
            else
            {
                return $appointment->price;
            }
        })
        ->addColumn('action','dashboard.actions.edit')
        ->rawColumns(['action'])
        ->make(true);
    }
}
