<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('blog.admin.posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::pluck('title','id')->all();
        $tags=Tag::pluck('title','id')->all();
        return view('blog.admin.posts.create',compact('category','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=Post::create($request->all());
        $post->uploadImage($request->file('image'));
        $post->is_featured($request->get('is_featured'));
        $post->status($request->get('status'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        return redirect()->route('posts.index')->with('status','Пост успешно добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $category=Category::pluck('title','id')->all();
        $tags=Tag::pluck('title','id')->all();
        return view('blog.admin.posts.edit',compact('post','category','tags'));
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
        $post=Post::find($id);
        $post->update($request->all());
        $post->uploadImage($request->file('image'));
        $post->is_featured($request->get('is_featured'));
        $post->status($request->get('status'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        return redirect()->route('posts.index')->with('status','Пост успешно изменен!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->remove();
        return redirect()->route('posts.index')->with('status','Пост успешно удален!');

    }
}
