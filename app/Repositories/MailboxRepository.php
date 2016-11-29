<?php
namespace App\Repositories;

use App\Mailbox;
use App\Contracts\MailboxContract;


class MailboxRepository implements MailboxContract{

	private $userId;

	/**
	* To display all the messages of a particular user. I miss PHPSTORM.
	*/
	public function show(): \Illuminate\Database\Eloquent\Collection{

		return Mailbox::join('users', 'mailbox.sender_id', '=', 'users.id')
                        ->join('articles', 'mailbox.article_id', '=', 'articles.id')
                        ->where('articles.user_id', \Auth::user()->id)
                        ->select('articles.url', 'mailbox.message', 'users.name as sender')
                        ->get();
	}

	/**
	*
	*/
	public function store(\Illuminate\Support\Collection  $mailBoxCollection){
		Mailbox::insert( $mailBoxCollection->toArray());
        return;
	}

  public function migrateFromTempUser(int $user, \Illuminate\Database\Eloquent\Collection $tempUserDatas){
    $toInsertCollection = collect([]);
    $tempUserDatas->each(function($item) use ($toInsertCollection, $user){
      $toInsertCollection->push(['user_id'=> $user, 'sender_id' => $item->from, 'url' => $item->shared_url, 'message' => $item->message, 'created_at' => \Carbon\Carbon::now()]);
    });

    Mailbox::insert($toInsertCollection->toArray());
    return;
  }

	public function test(){
		return Mailbox::find(1);
	}



  public function create(){}
  public function read(){}
  public function update(){}
  public function delete(){}
}
