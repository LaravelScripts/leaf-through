<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contracts\{MailboxContract, UserContract};
use App\Traits\{JsonResponse, ReadabilityMode};

use App\Mail\InviteUser;

class ShareLink extends Controller
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
  * Bug: 'link' => 'required|url' , url part is causing issue
  */
  public function send(Request $request){
    $validator = \Validator::make($request->all(), ['link' => 'required', 'to' => 'required|email', 'message' => 'sometimes|required|min:10|max:140']);
    if($validator->fails()){
      return $this->jsonError($validator->messages());
    }

    /**
    * 1. Check User exists if not send mail else store
    */
    $recipient = $this->user->byEmail($request->input('to'));
    if(is_null($recipient)){
      /**
      * Store in temporary table and then send mail
      */

      $when = \Carbon\Carbon::now()->addMinutes(10);

      \Mail::to($request->input('to'))->send(new InviteUser($request->input('link'), $request->input('message')));//->later($when, new OrderShipped($order));

      return $this->user->storeTemp($request->input('to'), $request->input('link'), $request->input('message')) == true ? $this->jsonSuccess('Link shared') : $this->jsonError('Unable to share link');
    }else{
        $mailbox = $this->mailbox->store($recipient->id, $request->input('link'), $request->input('message'));
        //Store link Contents

        //Fire the Event to broadcast
        event(new \App\Events\LinkShared($mailbox));

        //Send Notification for email and slack
        $request->user()->notify(new \App\Notifications\NewUrlShared());
        return 0;
    }
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
    return $this->readableFormat($request->input('url'))->getContent()->textContent;

  }
}
