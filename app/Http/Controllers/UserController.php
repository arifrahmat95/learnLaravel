<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //show register/create form
    public function create(){
        return view('users.register');
    }

    //create new user
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => 'required|min:3',
            // 'email' => ['required', 'email', Rule::unique('users', 'email')],
            'email' => 'required|email|unique:users,email',
            //confirmed tu boleh guna bila letak _confirmation. 
            //contoh password_confirmation dekat submit form
            'password' => 'required|confirmed|min:6'

        ]);

        //hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // create user
        $user = User::create($formFields);

        //login
        auth()->login($user);

        return redirect('/')->with('message', 'User registered & log in');
    }

    //logout user
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logout');
    }

    //show login form
    public function login(){
        return view('users.login');
    }

    //user login
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => 'invalid credential'])->onlyInput('email');
    }
}
