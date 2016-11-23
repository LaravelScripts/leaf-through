<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\InboxContract;

class InboxController extends Controller
{
    //
    private $userInbox;
    private $inboxContract;

    public function __construct(InboxContract $inboxContract){
    	$this->inboxContract = $inboxContract;
    }

    public function messages(Request $request){
    	dd($this->inboxContract->show());
    }

    public function send(Request $request){
    	
    	$validator = \Validator::make($request->all(), [ "text"=>"required|min:10|max:140", 
    														"link"=>"required|url", 
    														"sender"=>"required|integer"
    													]);

    	if($validator->fails()){
    		return response()->json($validator->errors());
    	}

    	//Check if sender is valid
    	
    	dd($this->inboxContract->send());
    }
}
