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
        $formatedAppointments = [];
        $makeCounterArray = [];
        $appInfo = Settings::get()[0];
        $appFullDaysDates = [];
        foreach($appointments as $key => $ap)
        {
            $dayCheck = Appointment::where('time',$ap->time)
            ->where('status',1)
            ->get()
            ->count();
            $dayIsFull = false;
            $todaName =date('D', strtotime($ap->time));

            if($todaName == 'Sun')
            {
                if($dayCheck >= $appInfo->Sun&&!in_array($ap->time,$appFullDaysDates))
                {
                    $newFormate = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate);
                    $newFormate2 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate2);
                    $newFormate3 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate3);
                    $newFormate4 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate4);
                    array_push($appFullDaysDates,$ap->time);
                    $todaName = true;

                }
            }
            if($todaName == 'Mon')
            {
                if($dayCheck >= $appInfo->Mon&&!in_array($ap->time,$appFullDaysDates))
                {
                    $newFormate = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate);
                    $newFormate2 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate2);
                    $newFormate3 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate3);
                    $newFormate4 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate4);
                    array_push($appFullDaysDates,$ap->time);
                    $dayIsFull = true;

                }
            }
            if($todaName == 'Tu')
            {
                if($dayCheck >= $appInfo->Tu&&!in_array($ap->time,$appFullDaysDates))
                {
                    $newFormate = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate);
                    $newFormate2 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate2);
                    $newFormate3 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate3);
                    $newFormate4 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate4);
                    array_push($appFullDaysDates,$ap->time);
                    $dayIsFull = true;

                }
            }
            if($todaName == 'Wed')
            {
                if($dayCheck >= $appInfo->Wed&&!in_array($ap->time,$appFullDaysDates))
                {
                    $newFormate = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate);
                    $newFormate2 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate2);
                    $newFormate3 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate3);
                    $newFormate4 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate4);
                    array_push($appFullDaysDates,$ap->time);
                    $dayIsFull = true;

                }
            }
            if($todaName == 'Thu')
            {
                if($dayCheck >= $appInfo->Thu&&!in_array($ap->time,$appFullDaysDates))
                {
                    $newFormate = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate);
                    $newFormate2 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate2);
                    $newFormate3 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate3);
                    $newFormate4 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate4);
                    array_push($appFullDaysDates,$ap->time);
                    $dayIsFull = true;

                }
            }
            if($todaName == 'Fri')
            {
                if($dayCheck >= $appInfo->Fri&&!in_array($ap->time,$appFullDaysDates))
                {
                    $newFormate = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate);
                    $newFormate2 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate2);
                    $newFormate3 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate3);
                    $newFormate4 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate4);
                    array_push($appFullDaysDates,$ap->time);
                    $dayIsFull = true;

                }
            }
            if($todaName == 'Sat')
            {
                if($dayCheck >= $appInfo->Sat&&!in_array($ap->time,$appFullDaysDates))
                {
                    $newFormate = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate);
                    $newFormate2 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate2);
                    $newFormate3 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate3);
                    $newFormate4 = (object)array(
                        'title' => 'Full',
                        'start' => $ap->time,
                        'display'=>'background',
                    );
                    array_push($formatedAppointments,$newFormate4);
                    array_push($appFullDaysDates,$ap->time);
                    $dayIsFull = true;

                }
            }

            if($dayIsFull == false)
            {
                $newFormate = (object)array(
                    'title' => 'Appointment',
                    'start' => $ap->time,
                );
                if(!in_array($ap->time,$appFullDaysDates))
                {
                    array_push($formatedAppointments,$newFormate);
                }
            }



            // old logic
            // if($dayCheck >= $appInfo->max&&!in_array($ap->time,$appFullDaysDates))
            // {
            //     $newFormate = (object)array(
            //         'title' => 'Full',
            //         'start' => $ap->time,
            //         'display'=>'background',
            //     );
            //     array_push($formatedAppointments,$newFormate);
            //     $newFormate2 = (object)array(
            //         'title' => 'Full',
            //         'start' => $ap->time,
            //         'display'=>'background',
            //     );
            //     array_push($formatedAppointments,$newFormate2);
            //     $newFormate3 = (object)array(
            //         'title' => 'Full',
            //         'start' => $ap->time,
            //         'display'=>'background',
            //     );
            //     array_push($formatedAppointments,$newFormate3);
            //     $newFormate4 = (object)array(
            //         'title' => 'Full',
            //         'start' => $ap->time,
            //         'display'=>'background',
            //     );
            //     array_push($formatedAppointments,$newFormate4);
            //     array_push($appFullDaysDates,$ap->time);

            // }
            // else
            // {
            //     $newFormate = (object)array(
            //         'title' => 'Appointment',
            //         'start' => $ap->time,
            //     );
            //     if(!in_array($ap->time,$appFullDaysDates))
            //     {
            //         array_push($formatedAppointments,$newFormate);
            //     }
            // }

        }
        return view('welcome',compact('name','formatedAppointments','daysOff','appInfo','images'));
    }
}
