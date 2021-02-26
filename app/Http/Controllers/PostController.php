<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Mail;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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

        $user = User::find(20);
        $emailTo = $user->email;
        $name = $user->name;

        Mail::send('posts.mail', compact('post'), function ($message) use ($emailTo, $name) {
            $message->from('john@johndoe.com', 'John Doe');
            $message->sender('john@johndoe.com', 'John Doe');
            $message->to( $emailTo, $name);
            $message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Mail test from Laravel 8 Blog');
            $message->priority(3);
        });


        flash('New Post stored successfully')->success()->important();
        return redirect('/posts');

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
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id==Auth::user()->id){
            $post->delete();
            flash('Post deleted successfully')->error()->important();
        }else{
            flash('You are not allowed to remove this post')->error()->important();
        }

        return back();
    }
}
