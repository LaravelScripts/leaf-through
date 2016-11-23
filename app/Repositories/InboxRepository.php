<?php
namespace App\Repositories;

use App\Inbox;
use App\Contracts\InboxContract;


class InboxRepository implements InboxContract{
	
	private $userId;

	/**
	* To display all the messages of a particular user. I miss PHPSTORM.
	* Eager Loading senderDetails is causing errors.
	*
	*/
	public function show(): \Illuminate\Database\Eloquent\Collection{
		return Inbox::join('users', 'inboxes.sender_id', '=', 'users.id')->where('inboxes.user_id', \Auth::user()->id)->select('inboxes.url', 'inboxes.message', 'users.name as sender')->get();
	}

	/**
	*
	*/
	public function store($message, $url, $sender): bool{
		
		$inbox = new Inbox;
        $inbox->message = $message;
        $inbox->url = $url;
        $inbox->sender_id = $sender;
        $inbox->user_id = \Auth::user()->id;
        return $inbox->save() == true ? true : false;
	}
}