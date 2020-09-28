<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments=Comment::all();
        return view('blog.admin.comments.index',compact('comments'));
    }
    public function toggle($id)
    {
        $comment=Comment::find($id);
        $comment->toggle_status();

        return redirect()->back();
    }


}
