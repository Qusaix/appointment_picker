<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            ['name'=>'Sunday','isOff'=>'0','number'=>'0'],
            ['name'=>'Monday','isOff'=>'0','number'=>'1'],
            ['name'=>'Tuesday','isOff'=>'1','number'=>'2'],
            ['name'=>'Wednesday','isOff'=>'0','number'=>'3'],
            ['name'=>'Thursday','isOff'=>'0','number'=>'4'],
            ['name'=>'Friday','isOff'=>'1','number'=>'5'],
            ['name'=>'Saturday','isOff'=>'0','number'=>'6'],
        ];
        foreach($days as $day)
        {
            Day::create($day);
        }
    }
}
