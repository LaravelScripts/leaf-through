<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Traits\JsonResponse;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use JsonResponse;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
    * Manually added function
    */
    public function showRegistrationForm(){
        return view('auth.register');
    }

    /**
    * TODO: attach message in login redirect
    */
    public function register(Request $request){

        $this->validate($request, ['name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed']);


        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->confirmation_hash = str_random(50); //Have to change
        $user->confirmation_sent_at = \Carbon\Carbon::now();
        $user->save();

        // Find a way to handle error if any
        if($user->wasRecentlyCreated){
            //Send confirmation email and redirect to login page
            $mail = \Mail::to($user->email)->send(new \App\Mail\ConfirmationEmail($user));
            return redirect('/login');
        }else{
            return back()->withErrors('Something went wrong');
        }
    }

    /**
    * To confirm user email
    */
    public function confirm(Request $request, $code){

        $validator = Validator::make($request->all(), [
            "email"=> "required|email",
            "code"=> "required|min:20"
        ]);

        $email = "me@sarav.co";

        //abort_if($validator->fails(), 404, $validator->errors()); // remove and replace the line with proper message

        $exists = User::where('email', $email)
                        ->where('confirmation_hash', $code)
                        //->whereRaw('unix_timestamp(confirmation_sent_at) <= now()') //Only 30 mins validity. Use appropiate code logic.
                        ->exists();

        if($exists){
            $status= User::where('email', $email)->where('confirmation_hash', $code)->update(["is_confirmed"=>1]);
            $status == 1 ? dd('Account activated') : dd('Something went wrong');

        }else{
            dd('Invalid account.');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendConfirmation(Request $request): \Illuminate\Http\JsonResponse{
        $validator = Validator::make($request->all(), ["email"=> "required|email"]);
        if($validator->fails()){
            return $this->jsonError(collect($validator->errors())->values());
        }

        $user = User::where('email', $request->input('email'))->first();
        if(is_null($user)){
            return $this->jsonError("Invalid User.");
        }

        //update the confirmation hash and send it
        $randomCode = str_random(50);

        $updateUser = User::find($user->id);
        $updateUser->confirmation_hash = $randomCode;
        $updateUser->save();

        \Mail::to($user->email)->send(new \App\Mail\ConfirmationEmail($updateUser));
        return $this->jsonSuccess("Confirmation code sent successfully.");
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
