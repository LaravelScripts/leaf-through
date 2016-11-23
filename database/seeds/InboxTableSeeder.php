<?php

use Illuminate\Database\Seeder;
use App\Inbox;

class InboxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $inbox = new Inbox;
        $inbox->message = "Message 1";
        $inbox->url = "http://test1.com";
        $inbox->sender_id = 1;
        $inbox->user_id = 1;
        $inbox->save();

        $inbox = new Inbox;
        $inbox->message = "Message 2";
        $inbox->url = "http://test2.com";
        $inbox->sender_id = 1;
        $inbox->user_id = 1;
        $inbox->save();
    }
}
