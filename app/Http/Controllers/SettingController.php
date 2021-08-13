<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Day;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Settings::get()[0];
        $days = Day::get();
        return view('dashboard.setting.index',compact('setting','days'));
    }

    public function update(SettingRequest $request)
    {
        $setting = Settings::get()[0];
        $setting->instagram = $request->instagram;
        $setting->facebook = $request->facebook;
        $setting->appointmentsRange = $request->appointmentsRange;
        $setting->save();
        $allDays = Day::get();
        // remove all the days off
        foreach($allDays as $d)
        {
            $day = Day::find($d->id);
            $day->isOff = 0;
            $day->save();
        }
        //make new off Days
        foreach($request->daysOff as $d)
        {
            $day = Day::find($d);
            $day->isOff = 1;
            $day->save();
        }

        return redirect()->route('dashboard');
    }
}
