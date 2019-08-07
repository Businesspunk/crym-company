<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
    public function ajaxUploadImages( Request $request )
    {
        $val = Validator::make( $request->all(), [
            'photo' => 'mimes:jpeg,png'
        ]);

        if( $val->fails() ){
            return response()->json([ 'error'=> true ]);
        }

        $path = photoSaver( $request->file('photo'), 'temp');

        $response = [
            'block' => view('components/newPhoto', ['src' => getSavedPhoto( $path ) ])->render(),
            'error' => false
        ];

        return response()->json($response);
    }
}
