<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // render register page
    public function create(){
        return view("user.register");
    }

    public function store(Request $request){
        $formValidition = $request->validate([
            "name" => "required|min:4",
            "email" => ["email", 'required', Rule::unique('users', "email")],
            "password" => "required|confirmed|min:6",
        ]);

        // hash the password
        $formValidition['password'] = bcrypt($formValidition['password']);

        // save to db
        $user = User::create($formValidition);

        // login
        auth()->login($user);

        return redirect("/")->with("success", "User created and logged in!");
    }

    public function login(){
        return view("user.login");
    }

    public function authenticate(Request $request){
        $formValidition = $request->validate([
            "email" => ["email", 'required'],
            "password" => "required",
        ]);
        
        if(auth()->attempt($formValidition)){
            return redirect('/')->with("success", "You're logged in!");
        }

        return back()->withErrors(["email" => "Invalid Credentials"])
        ->onlyInput('email');
    }
    public function logout(Request $request){
        auth()->logout();

        // invalid the current session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/")->with("success", "You have been logged out");
    }
}
