<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
    * Below functions are manually added
    */
    public function showLoginForm(){
        return view('auth.login');
    }


    /**
    * @TODO: check if remember me is working. code: Auth::login(user, true);
    */
    public function login(Request $request){

        $this->validate($request, ['email'=>'required|email', 'password'=>'required']);

        $user = \App\User::where('email', $request->input('email'))->first();
        
        if(is_null($user)){
            return back()->withInput()->withErrors(['failed'=>'User Email/ Credentials do not match']);
        }

        if (!\Hash::check($request->input('password'), $user->password)) {
            return back()->withInput()->withErrors(['failed'=>'User Email/ Credentials do not match']);
        }

        if($user->is_confirmed != 1){
            return back()->withInput()->withErrors(['failed'=>'Account not activated.']);
        }

        $request->has('remember') == true ? \Auth::login($user, true) : \Auth::login($user);

        return redirect()->intended('inbox');

         if (\Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'is_confirmed' => 1])) {
            // Authentication passed...
            return redirect()->intended('inbox');
        }else{
            return back()->withInput()->withErrors(['failed'=>'User Email/ Credentials do not match']);
        }
    }

}
