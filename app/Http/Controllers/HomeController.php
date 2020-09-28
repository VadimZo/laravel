<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts=Post::paginate(2);
        return view('blog.pages.index',compact('posts'));
    }
    public function show($slug)
    {
        $post=Post::where('slug',$slug)->firstOrFail();
        return view('blog.pages.post',['post'=>$post]);
    }
    public function categories($slug)
    {
        $posts=Category::where('slug',$slug)->firstOrFail()->posts()->paginate(2);

        return view('blog.pages.list',compact('posts'));
    }
    public function tags($slug)
    {
        $posts=Tag::where('slug',$slug)->firstOrFail()->posts()->paginate(2);

        return view('blog.pages.list',compact('posts'));
    }
    public function login()
    {
        return view('blog.pages.login');
    }
    public function register()
    {
        return view('blog.pages.register');
    }
}
