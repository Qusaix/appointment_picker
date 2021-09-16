<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Requests\AppointmentsRequest;
use App\Http\Requests\EditAppointmentsRequest;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Settings;


class AppointmentsController extends Controller
{

    public function index($filter = null,$date = null)
    {
        $appointments = [];
        if($filter  == 1)
        {
            $appointments = Appointment::orderBy('created_at','desc')->whereDate('time', Carbon::today())->paginate(10);
        }
        elseif($filter  == 2)
        {
            $appointments = Appointment::orderBy('created_at','desc')->whereDate('time', Carbon::tomorrow())->paginate(10);
        }
        elseif($filter == 3)
        {
            $appointments = Appointment::orderBy('created_at','desc')->whereBetween('time', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(10);
            
        }
        elseif($filter == 4)
        {
            $appointments = Appointment::orderBy('created_at','desc')->whereMonth('time', Carbon::now()->month)->paginate(10);
        }
        elseif($filter == 5)
        {
            $appointments = Appointment::orderBy('created_at','desc')->where('status', null)->paginate(10);
        }
        elseif($filter == 6)
        {
            $appointments = Appointment::orderBy('created_at','desc')->where('status', 1 )->paginate(10);
        }
        elseif($filter == 7)
        {
            $appointments = Appointment::orderBy('created_at','desc')->where('status', 0)->paginate(10);
        }
        elseif($filter == 8)
        {
            $appointments = Appointment::orderBy('created_at','desc')->whereDate('time', $date)->paginate(10);
        }
        elseif($filter != null&&$filter != 'null')
        {
            $appointments = Appointment::orderBy('created_at','desc')->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('phone', 'LIKE', "%{$filter}%")
            ->paginate(10);
        }
        else
        {
            $appointments = Appointment::orderBy('created_at','desc')->paginate(10);
        }

        // $appointments = Appointment::orderBy('created_at','desc')->paginate(10);
        return view('dashboard.appointment.index',compact('filter','appointments','date'));
    }
    public function store(AppointmentsRequest $request)
    {   
        $request->merge(['ip' => $request->getClientIp()]);
        // $setttings = Settings::get()[0];
        $dayCheck = Appointment::where('time',$request->time)
        ->where('status',1)
        ->get()
        ->count();
        $max_appointments_per_day = Settings::get()[0];
        
        if(date('D', strtotime($request->time)) == 'Sun')
        {
            if($dayCheck >= $max_appointments_per_day->Sun)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        elseif(date('D', strtotime($request->time)) == 'Mon')
        {
            if($dayCheck >= $max_appointments_per_day->Mon)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        elseif(date('D', strtotime($request->time)) == 'Tu')
        {
            if($dayCheck >= $max_appointments_per_day->Tu)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }

        }
        elseif(date('D', strtotime($request->time)) == 'Wed')
        {
            if($dayCheck >= $max_appointments_per_day->Wed)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        elseif(date('D', strtotime($request->time)) == 'Thu')
        {
            if($dayCheck >= $max_appointments_per_day->Thu)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        elseif(date('D', strtotime($request->time)) == 'Fri')
        {
            if($dayCheck >= $max_appointments_per_day->Fri)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        elseif(date('D', strtotime($request->time)) == 'Sat')
        {
            if($dayCheck >= $max_appointments_per_day->Sat)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }

        // if($dayCheck >= $max_appointments_per_day->max)
        // {
        //     return response()->json([
        //         'err'=>'the day is full',
        //         'status'=>202
        //     ],202);
        // }
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
        $appointment->note = $request->note;
        $appointment->status = $request->status;
        $appointment->save();
        Alert::toast('Appointment was updated', 'success');
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
        ->editColumn('name',function(Appointment $appointment){
            return view('dashboard.actions.userName',compact('appointment'));
        })
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
    
    public function checkDay(Request $request)
    {
        $dayCheck = Appointment::where('time',$request->time)
        ->where('status',1)
        ->get()
        ->count();
        $max_appointments_per_day = Settings::get()[0];

        if(date('D', strtotime($request->time)) == 'Sun')
        {
            if($dayCheck >= $max_appointments_per_day->Sun)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        elseif(date('D', strtotime($request->time)) == 'Mon')
        {
            if($dayCheck >= $max_appointments_per_day->Mon)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        elseif(date('D', strtotime($request->time)) == 'tu')
        {
            if($dayCheck >= $max_appointments_per_day->tu)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }

        }
        elseif(date('D', strtotime($request->time)) == 'Wed')
        {
            if($dayCheck >= $max_appointments_per_day->Wed)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        elseif(date('D', strtotime($request->time)) == 'Thu')
        {
            if($dayCheck >= $max_appointments_per_day->Thu)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        elseif(date('D', strtotime($request->time)) == 'Fri')
        {
            if($dayCheck >= $max_appointments_per_day->Fri)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        elseif(date('D', strtotime($request->time)) == 'Sat')
        {
            if($dayCheck >= $max_appointments_per_day->Sat)
            {
                return response()->json([
                    'err'=>'the day is full',
                    'status'=>202
                ],202);
            }
        }
        // else
        // {
        //     return response()->json([
        //         'msg'=>'day is avalible',
        //         'status'=>200
        //     ],200);

        // }
        return response()->json([
            'msg'=>'day is avalible',
            'status'=>200
        ],200);

    }
}
