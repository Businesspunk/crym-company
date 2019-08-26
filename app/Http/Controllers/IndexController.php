<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\User;


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

    public function profile( $id, Request $request )
    {
        $user = User::findOrFail($id);
        
        $activePosts = $user->posts()->where('isClose', '=', null)->get();
        $closedPosts = $user->posts()->where('isClose', '!=', null)->get();

        return view('profile', [
            'user' => $user,
            'activePosts' => $activePosts,
            'closedPosts' => $closedPosts
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
        $cookie = [];
        
        if( isset($_COOKIE['favorite']) ){
            $cookie = json_decode($_COOKIE['favorite']);
        }
        $bookmarks = Post::find( $cookie );

        return view('my-bookmarks', [
            'bookmarks' => $bookmarks,
        ]);
    }

    public function messages( Request $request )
    {
        return view('my-messages');
    }

    public function myposts( Request $request )
    {
        $user = $request->user();
        
        $activePosts = $user->posts()->where('isClose', '=', null)->get();
        $closedPosts = $user->posts()->where('isClose', '!=', null)->get();

        return view('my-posts', [
            'activePosts' => $activePosts,
            'closedPosts' => $closedPosts
        ]);
    }

    public function add( Request $request )
    {
        return view('add');
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
            'user' => $post->user,
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

}
