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
        $inbox->article_id = 1;
        $inbox->sender_id = 2;
        $inbox->save();

        $inbox = new Mailbox;
        $inbox->message = "Message 2";
        $inbox->article_id = 2;
        $inbox->sender_id = 2;
        $inbox->save();

        $inbox = new Mailbox;
        $inbox->message = "Message 3";
        $inbox->article_id = 3;
        $inbox->sender_id = 1;
        $inbox->save();
    }
}
