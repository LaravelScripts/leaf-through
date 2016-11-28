<?php

use App\Setting;
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
        Setting::create([
        	'name'     => 'app_name',
        	'value'    => 'Leaf Through',
        	'required' => 1
        ]);
    }
}
