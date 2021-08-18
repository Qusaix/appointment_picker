<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Requests\AppointmentsRequest;
use App\Http\Requests\EditAppointmentsRequest;
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
        $dayCheck = Appointment::where('time',$request->time)
        ->where('status',0)
        ->get()
        ->count();
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

    public function edit($id)
    {
        $appointment = Appointment::find($id);
        return view('dashboard.appointment.edit',compact('appointment'));
    }
    public function update(EditAppointmentsRequest $request,$id)
    {
        $appointment = Appointment::find($id);
        $appointment->price = $request->price;
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->route('dashboard.appointment.index');
    }

    public function datatable()
    {
        $data = Appointment::orderBy('created_at','desc')->get();
        $numberOfAppointment = 0;
        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('price',function(Appointment $appointment){
            if($appointment->price == null)
            {
                return 'no price avalible';
            }
            else
            {
                return '$'.$appointment->price;
            }
        })
        ->editColumn('status',function(Appointment $appointment){
            if($appointment->status == null)
            {
                return 'no status avalible';
            }
            elseif($appointment->status == 0)
            {
                return 'Deny';
            }
            else
            {
                return 'Conform';
            }
        })
        ->editColumn('created_at',function(Appointment $image){
            return $image->created_at->diffForHumans();
        })
        ->addColumn('action',function(Appointment $data){
            return view('dashboard.actions.edit',compact('data'));
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
