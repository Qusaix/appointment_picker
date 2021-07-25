<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'instagram'=>'',
            'facebook'=>'',
            'appointmentsRange'=>'3'
        ];
        Settings::create($data);
    }
}
