<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\MailboxContract;

class MailboxController extends Controller
{
    //
    private $userInbox;
    private $mailboxContract;

    public function __construct(MailboxContract $mailboxContract){
    	$this->mailboxContract = $mailboxContract;
    }

    /**
     * Returns the inbox page
     *
     * @param   \Illuminate\Http\Request  $request  The request
     *
     * @return  \Illuminate\View\View
     */
    public function messages(Request $request) : \Illuminate\View\View {

    	$messages = $this->mailboxContract->show();
        
        return view('inbox.messages', compact('messages'));
    }

    public function send(Request $request){

    	$validator = \Validator::make($request->all(), [
            "text" => "required|min:10|max:140",
			"link"   => "required|url",
			"sender" => "required|integer"
		]);

    	if($validator->fails()){
    		return response()->json($validator->errors());
    	}

    	//Check if sender is valid
    	dd($this->mailboxContract->send());
    }
}
