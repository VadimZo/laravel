<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
        ]);
        $request['password'] = bcrypt($request['password']);
        User::create($request->all());
        return redirect('/')->with('status','Вы успешно зарегистрированы!');
    }
    public function loginForm(Request $request)
    {
        $this->validate($request,[
           'email'=>'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt([
           'email'=>$request['email'],
           'password'=>$request['password'],
        ]))
        {
            return redirect('/');
        }
        return redirect()->back()->with('status','Неправильный логин или пароль!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
