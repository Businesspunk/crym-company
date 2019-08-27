<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\PostsPhoto;
use App\Models\Promotion;

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
            'block' => view('components/newPhoto', ['src' => getSavedPhoto( $path ), 'deletePath' => $path ])->render(),
            'error' => false,
            'paths' => $path
        ];

        return response()->json($response);
    }

    public function delete( $id, Request $request )
    {
        $post = Post::findOrFail( $id );
        $this->authorize('delete', $post);
        deletePost( $post );
        return redirect()->route('main');
    }
    public function close($id, Request $request)
    {   
        $post = Post::findOrFail( $id );
        $this->authorize('close', $post);

        $post->update([
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

    public function update($id, Request $request)
    {
        $post = Post::findOrFail( $id );
        $this->authorize('edit', $post);

        $data = $request->all();
        $photos = json_decode( $data['images'] );

        $main_photo = getImageName( $data['main_photo'] );
        $old_main_photo = getImageName( $post->main_photo );

        if( $main_photo != $old_main_photo ){
            Storage::delete('posts/'.$old_main_photo);
        }
        if( isExistsPhoto('temp/'.$main_photo) ){
            Storage::move('temp/'.$main_photo, 'posts/'.$main_photo );
        }

        $data['main_photo'] = 'posts/'.$main_photo;
        $data['user_id'] = Auth::id();

        $post->update($data);

        $old_images_name = $post->photos;
        $new_images_name = getPhotoNames($photos);

        foreach($old_images_name as $old_img){
            if( !in_array( getImageName($old_img->url) , $new_images_name) ){
                Storage::delete($old_img->url);
                $old_img->delete();
            }
        }
        
        foreach( $photos as $photo ){
            $img = getImageName( $photo );
            if( isExistsPhoto('temp/'.$img) ){
                Storage::move('temp/'.$img, 'posts/'.$img );
                PostsPhoto::create([
                    'post_id' => $post->id,
                    'url' => 'posts/'.$img
                ]);
            }
            
        }
        
        return redirect()->route('main');
    }

}
