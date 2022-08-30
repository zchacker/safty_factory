<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthLogin;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{

    // this link for setup auth system based on user role
    // https://learn2torials.com/a/laravel8-authentication-based-on-roles
    // http://thewebfosters.com/display-user-devices-application-currently-logged-option-logout-laravel/
    public function login(Request $request)
    {

        //print bcrypt("123");
        //print Hash::make('123');
        
        if($request->isMethod('post'))
        {
            if(AuthLogin::attempt(['email' => $request->email, 'password' => $request->password] , true))
            {
                if(AuthLogin::user()->role == 'user')
                {                    
                    return redirect()->intended(route('client.home'));
                }
                else{                    
                    return redirect()->intended(route('engineer.home'));
                }

            }else{
                //print "not valid";
                //var_dump($request->all());
                
                return back()->withInput($request->aemail);
            }
        }

        return view('login');
    }



}