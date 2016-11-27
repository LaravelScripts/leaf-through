<?php
namespace App\Repositories;

use App\Contracts\UserContract;
use App\User;
use App\TempUser;

class UserRepository implements UserContract{

  /**
  * Email suggestions when typing.
  */
  public function suggestions(string $text): \Illuminate\Database\Eloquent\Collection{
      return User::where('email', 'like', '%'.$text.'%')->select('email')->get();
  }

  /**
  *
  */
  public function storeTemp($recipient, $link, $message): bool{
    $tempUser = new TempUser;
    $tempUser->from = \Auth::user()->id;
    $tempUser->email = $recipient;
    $tempUser->shared_url = $link;
    $tempUser->message = $message;
    return $tempUser->save();
  }

  /**
  * Return type can be null or \Illuminate\Database\Eloquent\Collection
  */
  public function byEmail($email){
    return User::where('email', $email)->select('id')->first();
  }

  public function deleteTempUser($email){
    TempUser::where('email', $email)->delete();
    return;
  }

  public function create(){}
  public function read(){}
  public function update(){}
  public function delete(){}


}
