<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
