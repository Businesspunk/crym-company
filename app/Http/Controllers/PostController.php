<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\PostsPhoto;

class PostController extends Controller
{
    public function post( Request $request )
    {   
        $data = $request->all();
        $photos = json_decode( $data['images'] );

        $main_photo = getImageName( $data['main_photo'] );
        Storage::move('temp/'.$main_photo, 'posts/'.$main_photo );

        $data['main_photo'] = 'posts/'.$main_photo;
        $data['user_id'] = Auth::id();

        $post = Post::create($data);

        foreach( $photos as $photo ){
            $img = getImageName( $photo );
            Storage::move('temp/'.$img, 'posts/'.$img );
            PostsPhoto::create([
                'post_id' => $post->id,
                'url' => 'posts/'.$img
            ]);
        }
        
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
            'error' => false,
            'paths' => $path
        ];

        return response()->json($response);
    }
}
