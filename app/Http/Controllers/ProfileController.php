<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        return view('blog.pages.profile',compact('user'));
    }
    public function store(Request $request)
    {
        $user=Auth::user();
        $this->validate($request,[
           'name'=>'required',
           'email'=>[
               'required',
               'email',
               Rule::unique('users')->ignore($user->id)
           ],
           'password'=>'nullable',
        ]);
        $request['password']=$user->updatePassword($request['password']);
        $user->update($request->all());
        $user->uploadImage($request->file('image'));
        return redirect()->back()->with('status','Данные успешно обновлены!');
    }
}
