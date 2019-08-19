<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;


class IndexController extends Controller
{
    public function mainPage( Request $request )
    {
        $vipposts = Post::where( 'isVip', 1 )->orderBy('created_at');
        $newest = Post::where('isClose', null)->orderBy('created_at');

        if( $request->ajax() ){
            if( $request->type == 'vip' ){
                return getPaginatedPosts( $request, $vipposts, 1 );
            }else if( $request->type == 'new' ){
                return getPaginatedPosts( $request, $newest, 1 );                
            }
        }

        return view('index', [
            'vipposts' => view('components/posts', [ 'posts' => $vipposts->paginate(1), 'type' => 'vip' ]),
            'newest' => view('components/posts', [ 'posts' => $newest->paginate(1), 'type' => 'new' ]),
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
        $posts = $category->posts()->where('isClose', null);

        if( $request->ajax() ){
            return getPaginatedPosts( $request, $posts, 1 );
        }

        return view('category', [
            'category' => $category,
            'count' => $posts->count(),
            'posts' => view('components/posts', [ 'posts' => $posts->paginate(1), 'type' => 'category' ]),
        ]);
    }

    public function post( $id, Request $request )
    {
        $post = Post::findOrFail( $id );
        
        views($post)->record();

        $relatedPosts = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $id )
                            ->paginate(10);

        $relatedPosts->forget($id);

        return view('post', [
            'user' => $request->user(),
            'post' => $post,
            'relatedPosts' => view('components/posts', [ 'posts' => $relatedPosts ]),
       
            ]);
    }

    
}
