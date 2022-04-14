<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    
    
    public function username()
    {
        return 'name';   
    }
    
    protected function credentials(Request $request)
    {
        $username = $request->input($this->username());
        $password = $request->input('password');
        //usernameがemail形式か判定
        if(filter_var($username,FILTER_VALIDATE_EMAIL)){
            //email形式の場合、key=emailに値を渡す
            return ['email' => $username,'password' =>$password];
        }else{
            //email形式でない場合key=nameに値を渡す
            return[$this->username() => $username,'password' => $password];
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function loggedOut(Request $request)
    {
        return redirect(route('login'));
    }
     

}