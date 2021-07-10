<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt(123456)
        ];
        User::create($admin);
    }
}
