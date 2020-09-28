<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('blog.admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:50',
            'image'=>'nullable|image',
        ]);
        $user=User::create($request->all());
        $user->uploadImage($request->file('image'));
        $user->password=bcrypt($request->get('password'));
        $user->is_admin=0;
        $user->save();
        return redirect()->route('users.index')->with('status','Пользователь успешно добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $user=User::find($id);
        return view('blog.admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $this->validate($request,[
           'name'=>'required',
           'email'=>[
               'required',
               'email',
               \Illuminate\Validation\Rule::unique('users')->ignore($user->id),
           ],
            'password'=>'nullable',
            'image'=>'nullable|image',
        ]);

        $user->update($request->all());
        $user->uploadImage($request->file('image'));
        $user->updatePassword($request->get('password'));
        return redirect()->route('users.index')->with('status','Пользователь успешно добавлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->remove();
        return redirect()->route('users.index')->with('status','Пользователь успешно удален!');
    }
}
