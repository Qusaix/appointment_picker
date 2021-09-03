<?php

namespace App\Imports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\ToModel;

class AppointmentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Appointment([
            'name'=>$row['name'],
            'phone'=>$row['phone'],
            'time'=>$row['time'],
            'price'=>$row['price']
        ]);
    }
}
