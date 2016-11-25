<?php

use Illuminate\Database\Seeder;
use App\CategoryGroup;

class CategoryGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $new  = new CategoryGroup;
        $new->user_id = 1;
        $new->name = 'Category 1';
        $new->save();

        $new  = new CategoryGroup;
        $new->user_id = 1;
        $new->name = 'Category 2';
        $new->save();
    }
}
