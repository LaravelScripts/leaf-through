<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//$faker = new \Faker\Generator;
        $user = new User;
        $user->name = "User 1";
        $user->email = "me@sarav.co";
        $user->password = bcrypt('admin123');
        $user->is_confirmed = 1;
        $user->save();

        $user = new User;
        $user->name = "User 2";
        $user->email = "me@vinaykumar.co";
        $user->password = bcrypt('asdfgh');
        $user->is_confirmed = 1;
        $user->save();
    }
}
