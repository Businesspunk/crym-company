<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function post( Request $request )
    {   
        $args = $request->all();
        $args['user_id'] = Auth::id();

        Post::create($args);
        
        return redirect()->back();
    }
}
