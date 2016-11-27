<?php

use Illuminate\Database\Seeder;
use App\Mailbox;

class MailboxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $inbox = new Mailbox;
        $inbox->message = "Message 1";
        $inbox->url = "http://test1.com";
        $inbox->recipient_id = 1;
        $inbox->user_id = 1;
        $inbox->save();

        $inbox = new Mailbox;
        $inbox->message = "Message 2";
        $inbox->url = "http://test2.com";
        $inbox->recipient_id = 1;
        $inbox->user_id = 1;
        $inbox->save();
    }
}
