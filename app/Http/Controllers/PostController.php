<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Promotion;
use App\Helpers\Images\PhotoManager;
use App\Http\Requests\addAndEditPost;

class PostController extends Controller
{
    public function post( addAndEditPost $request )
    {   
        Post::addOne($request);
        return redirect()->route('main');
    }

    public function ajaxUploadImages( Request $request )
    {
        $val = Validator::make( $request->all(), [
            'photo' => 'image'
        ]);

        if( $val->fails() ){
            $messages = $val->messages()->get('*');
            $result = [];
            foreach( $messages as $message ){
                foreach( $message as $error ){
                    $result[] = $error;
                }
            }
            return response()->json([ 'error'=> true, 'messages' => $result ]);
        }

        $path = PhotoManager::savePhoto( $request->file('photo'), 'temp' );

        $response = [
            'block' => view('components/newPhoto', ['src' => getSavedPhoto( $path ), 'deletePath' => $path ])->render(),
            'error' => false,
            'paths' => $path
        ];

        return response()->json($response);
    }

    public function delete( $id )
    {
        $post = Post::findOrFail( $id );
        $this->authorize('delete', $post);
        $post->deleteOne();
        
        return redirect()->route('main');
    }
    public function close( $id )
    {   
        $post = Post::findOrFail( $id );
        $this->authorize('close', $post);

        $post->updateOne([
            'isClose' => 1
        ]);
        return redirect()->route('main');
    }

    public function edit($id, Request $request)
    {
        $post = Post::findOrFail( $id );
        $this->authorize('edit', $post);

        return view('edit', [
            'post' => $post,
            'promotions' => Promotion::all()
        ]);

    }

    public function update($id, addAndEditPost $request)
    {
        $post = Post::findOrFail( $id );
        $this->authorize('edit', $post);
        $post->editOne( $request );
        return redirect()->route('main');
    }

}
