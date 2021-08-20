<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Requests\AppointmentsRequest;
use App\Http\Requests\EditAppointmentsRequest;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AppointmentsController extends Controller
{
    public function index($filter = null)
    {
        return view('dashboard.appointment.index',compact('filter'));
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

    public function delete($id)
    {
        Appointment::findOrFail($id)->delete();
        return back();
    }

    public function datatable($filter = null)
    {
        $data = [];
        if($filter  == 1)
        {
            $data = Appointment::orderBy('created_at','desc')->whereDate('time', Carbon::today())->get();
        }
        elseif($filter == 2)
        {
            $data = Appointment::orderBy('created_at','desc')->whereBetween('time', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            
        }
        elseif($filter == 3)
        {
            $data = Appointment::orderBy('created_at','desc')->whereMonth('time', Carbon::now()->month)->get();
        }
        else
        {
            $data = Appointment::orderBy('created_at','desc')->get();
        }

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
        ->editColumn('time',function(Appointment $appointment){
            $data = str_replace('-"', '/', $appointment->time);
            $newDate = date("d/m/Y", strtotime($data));  
            return date('D', strtotime($appointment->time)).' '.$newDate;
        })
        ->editColumn('created_at',function(Appointment $appointment){
            return $appointment->created_at->diffForHumans();
        })
        ->addColumn('action',function(Appointment $data){
            return view('dashboard.actions.edit',compact('data'));
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
