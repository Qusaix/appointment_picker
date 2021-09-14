<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'instagram' => 'required',
            'facebook' => 'required',
            'daysOff' => 'required',
            'appointmentsRange' => 'required|min:0',
            'sun'=>'required|integer|min:1',
            'mon'=>'required|integer|min:1',
            'tu'=>'required|integer|min:1',
            'wed'=>'required|integer|min:1',
            'thu'=>'required|integer|min:1',
            'fri'=>'required|integer|min:1',
            'sat'=>'required|integer|min:1',
            'appointmentsRange' => 'required|integer|min:2'
        ];
    }
    public function messages()
    {
        return [
     'sun.required' => 'should add how many appointment in sunday',
     'mon.required' => 'should add how many appointment in monday',
     'tu.required' =>'should add how many appointment in tuesday',
     'wed.required' => 'should add how many appointment in wednesday',
     'thu.required' => 'should add how many appointment in thursday',
     'fri.required' =>'should add how many appointment in Thursday',
     'sat.required' =>'should add how many appointment in saturday',
     'sun.min' => 'Sunday should have more than 0 appointment',
     'mon.min' => 'Monday should have more than 0 appointment',
     'tu.min' =>'Tuesday should have more than 0 appointment',
     'wed.min' => 'Wednesday should have more than 0 appointment',
     'thu.min' => 'Thursday should have more than 0 appointment in ',
     'fri.min' =>'Friday should have more than 0 appointment',
     'sat.min' =>'Saturday should have more than 0 appointment',
     'appointmentsRange.min' => 'The range should be more than 0',
     'appointmentsRange.required' => 'The range is required'

        ];
    }
}
