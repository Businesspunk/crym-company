<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Promotion;
use App\Helpers\Images\PhotoManager;
use App\Http\Requests\addAndEditPost;
use Breadcrumbs;

class PostController extends Controller
{
    public function post( addAndEditPost $request )
    {
        $result = Post::addOne($request);

        if( $result['cost'] )
        {            
            return redirect()->route('payForPomotion', $result );
        }

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
            'promotions' => Promotion::getPromotions( $request->user()->type_of_account, $post->isRealty(), true ),
            'breadcrumbs' => Breadcrumbs::render('edit_post', $post)
        ]);

    }

    public function update($id, addAndEditPost $request)
    {
        $post = Post::findOrFail( $id );
        $this->authorize('edit', $post);
        $result = $post->editOne( $request );

        if( $result['cost'] ){            
            return redirect()->route('payForPomotion', $result );
        }
        
        return redirect()->route('main');
    }

    public function addFollowing(Request $request)
    {
        $id = $request->input('id');
        $isAdded = $request->input('isAdded');

        $post = Post::findOrFail($id);
        
        if( $isAdded ){
            $post->follovers--;
        }else{
            $post->follovers++;
        }
        
        $post->save();
    }
}
