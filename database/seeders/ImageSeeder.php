<?php

namespace Database\Seeders;

use App\Models\Images;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            ['link'=>'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8cGVyc29ufGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&w=1000&q=80'],
            ['link'=>'https://images.unsplash.com/photo-1475821660373-587d74229161?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max'],
            ['link'=>'https://media.newyorker.com/photos/5ec2d7a40fe2fbfb61a298c8/4:3/w_1808,h_1356,c_limit/Russell-NormalPeople-3.jpg'],
            ['link'=>'https://www.intouchweekly.com/wp-content/uploads/2017/12/Is-Alaskan-Bush-People-Fake-2.jpg?resize=1080%2C810']

        ];

        foreach($images as $image)
        {
            $image = Images::create($image);
        }
    }
}
