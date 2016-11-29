<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    //
    protected $table = "mailbox";

    public function senderDetails(){
    	return $this->belongsTo('App\User','sender_id');
    }

    public function articles(){
        return $this->belongsTo('App\Article', 'article_id');
    }
}
