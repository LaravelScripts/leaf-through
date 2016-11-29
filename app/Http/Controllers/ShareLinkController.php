<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contracts\{MailboxContract, UserContract, ArticleContract};
use App\Traits\{JsonResponse, ReadabilityMode};

use App\Mail\InviteUser;

class ShareLinkController extends Controller
{
  use JsonResponse, ReadabilityMode;

  private $mailbox;
  private $user;

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct(MailboxContract $mailbox, UserContract $user)
  {
    //$this->middleware('auth');
    $this->mailbox = $mailbox;
    $this->user = $user;
  }

  public function recipientSuggestion(Request $request){
    return $this->jsonSuccess($this->user->suggestions($request->input('text'))->toArray());
  }

  /**
  * Bug: 'url' => 'required|url' , url part is causing issue
  */
  public function send(Request $request, ArticleContract $article){
    $validator = \Validator::make($request->all(), ['url' => 'required', 'to' => 'required', 'message' => 'sometimes|required|min:10|max:140']);
    if($validator->fails()){
      return $this->jsonError($validator->messages());
    }

    /**
    * 1. Check User exists if not send mail else store
    */
    $existingRecipients = $this->user->byEmails(explode(",",$request->input('to')));
    $recipientList = collect(explode(",",$request->input('to')));
    $inviteRecipients = $recipientList->diff($existingRecipients->pluck('email'));

    //Send Invitation to User
    if($inviteRecipients->count() > 0){
        $inviteRecipients->each(function ($email) use ($request){
            $when = \Carbon\Carbon::now()->addMinutes(10);

            \Mail::to($email)->send(new InviteUser($email, $request->input('message')));//->later($when, new OrderShipped($order));
        });
    }

    //Insert into Article table
    if($existingRecipients->count() > 0){
        //Fetch the copy
        $articleClone = $article->urlMatch($request->input('url'));

        $existingRecipientsId = $existingRecipients->pluck('id');
        $firstInsertId = $article->saveForRecipients($articleClone->toArray(), $existingRecipientsId);

        $mailBoxCollection = collect([]);
        for($i = 0; $i < $existingRecipientsId->count(); $i++){
            $mailBoxCollection->push(['sender_id' => $request->user()->id, 'article_id' => $firstInsertId, 'message' => $request->input('message'),'updated_at' => \Carbon\Carbon::now(), 'created_at' =>  \Carbon\Carbon::now()]);
            $firstInsertId++;
        }

        $this->mailbox->store($mailBoxCollection);

        //Fire the Event to broadcast
        $existingRecipientsId->each(function($id){
            event(new \App\Events\LinkShared($id));
        });

        //Send Notification for email and slack
        //$request->user()->notify(new \App\Notifications\NewUrlShared());
    }

    return $this->jsonSuccess("Article shared successfully.");
  }

  /**
  * False Positive for required|url http://www . Better to use preg_match or php validate function. PHP security is tricky
  */
  public function htmlcontents(Request $request){
    $validator = \Validator::make($request->all(), ['url' => 'required|url']);

    if($validator->fails()){
      return $this->jsonError($validator->messages());
    }

    //echo $readability->getTitle()->textContent;
    //echo $readability->getContent()->textContent;
    return $this->readableFormat($request->input('url'));

  }
}
