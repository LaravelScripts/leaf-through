<?php

use Illuminate\Database\Seeder;
use App\CategorizedMail;

class CategorizedMailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $new = new CategorizedMail;
        $new->category_group_id = 1;
        $new->mailbox_id = 1;
        $new->save();

        $new = new CategorizedMail;
        $new->category_group_id = 1;
        $new->mailbox_id = 2;
        $new->save();
    }
}
