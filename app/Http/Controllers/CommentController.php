<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            'text'=>'required',
        ]);
        $comment=Comment::create($request->all());
        $comment->post_id=$request['post_id'];
        $comment->user_id=Auth::user()->id;
        $comment->save();

        return redirect('/')->with('status','Ваш комментарий вскоре будет добавлен.');
    }
}
