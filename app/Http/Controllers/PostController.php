<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('post.index', [
            'posts' => $posts,
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',

        ]);


        // Post::create([
        //     'user_id' => auth()->user()->id,
        //     'body' => $request->body,

        // ]);

        $request->user()->posts()->create($request->only('body'));
        
        return back();
    }
}
