<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;


class IndexController extends Controller
{
    public function mainPage( Request $request )
    {
        return view('index' , [
            'user' => $request->user()
        ]);
    }

    public function profile( Request $request )
    {
        return view('profile', [
            'user' => $request->user()
        ]);        
    }

    public function settings( Request $request )
    {
        return view('my-settings', [
            'user' => $request->user()
        ]);
    }

    public function support( Request $request )
    {
        return view('my-support', [
            'user' => $request->user()
        ]);
    }

    public function bookmarks( Request $request )
    {
        return view('my-bookmarks', [
            'user' => $request->user()
        ]);
    }

    public function messages( Request $request )
    {
        return view('my-messages', [
            'user' => $request->user()
        ]);
    }

    public function posts( Request $request )
    {
        return view('my-posts', [
            'user' => $request->user()
        ]);
    }

    public function add( Request $request )
    {
        return view('add', [
            'user' => $request->user()
        ]);
    }

    public function category( $slug, Request $request )
    {   
        $category = Category::where(['slug' => $slug])->firstOrFail();

        return view('category', [
            'user' => $request->user(),
            'category' => $category,
        ]);
    }

    public function post( $id, Request $request )
    {
        $post = Post::findOrFail( $id );

        return view('post', [
            'user' => $request->user(),
            'post' => $post,
        ]);
    }
}
