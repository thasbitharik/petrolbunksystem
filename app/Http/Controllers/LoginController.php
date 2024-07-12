<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        {
            //validate the details
            $request->validate([
                "email" => "required|email",
                "password" => "required|min:5|max:12"
            ]);
    
    
            $user = User::where('email', '=', $request->input('email'))->first();

            if ($user) {
                //check entered password
                if (Hash::check($request->input('password'), $user->password)) {

                    Auth::login($user);
                    return redirect()->route('product_type.index');
                } else {
                    //invalid user
                    return view('auth.login')->with('fail', 'Invalid email or password!');
                }
            } else {
                // not register this email
                return view('auth.login')->with('fail', 'Invalid email or password!');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        if (!Auth::check()) {
            return view('auth.login');
        }
    }
}
