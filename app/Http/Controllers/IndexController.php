<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function mainPage()
    {
        return view('index');
    }

    public function profile()
    {
        return view('profile');        
    }

    public function settings( Request $request )
    {
        return view('my-settings' , [
            'user' => $request->user()
        ]);
    }

    public function support()
    {
        return view('my-support');
    }

    public function bookmarks()
    {
        return view('my-bookmarks');
    }

    public function messages()
    {
        return view('my-messages');
    }

    public function posts( Request $request )
    {
        return view('my-posts', [
            'user' => $request->user()
        ]);
    }
}
