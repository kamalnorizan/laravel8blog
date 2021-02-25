<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user.posts.user','user.comments.user','comments.user')->latest()->paginate(10);
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tajuk' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'published_at' => 'required|date',
        ]);

        $post = new Post;
        $post->title = $request->tajuk;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->published_at = $request->published_at;
        $post->user_id = Auth::user()->id;
        $post->save();

        flash('New Post stored successfully')->success()->important();
        return redirect('/post');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // dd($post);
        if($post->user_id != Auth::user()->id){
            flash('You are not allowed to update other\'s post.')->error()->important();
            return redirect('/post');
        }
        $categories_opt = Category::pluck('title','id');
        return view('posts.edit',compact('post','categories_opt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        $post->title = $request->title;
        $post->content = $request->content;
        $post->publish_at = $request->publish_at;
        $post->category_id = $request->category_id;
        $post->save();

        flash('Post updated successfully')->success()->important();
        return redirect('/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
