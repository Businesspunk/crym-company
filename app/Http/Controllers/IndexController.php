<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Promotion;
use App\User;
use Illuminate\Support\Facades\Storage;



class IndexController extends Controller
{
    public function mainPage( Request $request )
    {
        $vipposts = Post::getVip();
        $newest = Post::getUnclosed();
        
        if( $request->ajax() ){
            if( $request->type == 'vip' ){
                return Post::getPaginatedPosts( $request, $vipposts );
            }else if( $request->type == 'new' ){
                return Post::getPaginatedPosts( $request, $newest );
            }
        }

        return view('index', [
            'vipposts' => view('components/posts', [ 'posts' => $vipposts->paginate(10), 'type' => 'vip' ]),
            'newest' => view('components/posts', [ 'posts' => $newest->paginate(10), 'type' => 'new' ]),
        ]);
    }

    public function profile( $id, Request $request )
    {
        $user = User::findOrFail($id);
        
        $activePosts = $user->getActivePosts();
        $closedPosts = $user->getClosedPosts();

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
        $cookie = getFavorite();
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
        
        $activePosts = $user->getActivePosts();
        $closedPosts = $user->getClosedPosts();

        return view('my-posts', [
            'activePosts' => $activePosts,
            'closedPosts' => $closedPosts
        ]);
    }

    public function add( Request $request )
    {
        return view('add', [
            'promotions' => Promotion::all()            
        ]);
    }

    public function category( $slug, Request $request )
    {   
        $category = Category::where(['slug' => $slug])->firstOrFail();
        $posts = $category->getActivePosts();

        if( $request->ajax() ){
            return Post::getPaginatedPosts( $request, $posts, 1 );
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
        $relatedPosts = $post->getRelatedPosts();
        
        return view('post', [
            'user' => $post->user,
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }
    
    public function messageToSupport()
    {
        return view('message-to-support');
    }

    public function posts(Request $request)
    {
        $posts = Post::getUnclosed();
        
        if( $request->ajax() ){
            return Post::getPaginatedPosts( $request, $posts, 1 );
        }
        return view('category', [
            'catalog' => true,
            'count' => $posts->count(),
            'posts' => view('components/posts', [ 'posts' => $posts->paginate(1), 'type' => 'catalog' ]),
        ]);
    }

}
