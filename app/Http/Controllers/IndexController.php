<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Promotion;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\MainCategory;
use Illuminate\Database\Eloquent\Builder;



class IndexController extends Controller
{
    public function mainPage( Request $request )
    {
        $vipposts = Post::getVip();
        $newest = Post::getUnclosed();
        $postsPerPage1 = 4;
        $postsPerPage2 = 12;

        if( $request->ajax() ){
            if( $request->type == 'vip' ){
                return Post::getPaginatedPosts( $request, $vipposts, $postsPerPage1 );
            }else if( $request->type == 'new' ){
                return Post::getPaginatedPosts( $request, $newest, $postsPerPage2 );
            }
        }

        return view('index', [
            'vipposts' => view('components/posts', [ 'posts' => $vipposts->paginate($postsPerPage1), 'type' => 'vip' ]),
            'newest' => view('components/posts', [ 'posts' => $newest->paginate($postsPerPage2), 'type' => 'new' ]),
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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('main');
    }
    public function category( $maincategory, $slug, Request $request )
    {   
        $postsPerPage = 12;

        $category = Category::where('slug', $slug)->whereHas('maincategory', function (Builder $query ) use ($maincategory) {
            $query->where('slug' , $maincategory);
        })->firstOrFail();
        $posts = $category->getActivePosts();

        if( $request->ajax() ){
            return Post::getPaginatedPosts( $request, $posts, $postsPerPage );
        }

        return view('category', [
            'category' => $category,
            'count' => $posts->count(),
            'posts' => view('components/posts', [ 'posts' => $posts->paginate($postsPerPage), 'type' => 'category' ]),
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
        $postsPerPage = 12;
        
        if( $request->ajax() ){
            return Post::getPaginatedPosts( $request, $posts, $postsPerPage );
        }
        return view('category', [
            'catalog' => true,
            'count' => $posts->count(),
            'posts' => view('components/posts', [ 'posts' => $posts->paginate($postsPerPage), 'type' => 'catalog' ]),
        ]);
    }
    public function goodOffers( Request $request )
    {
        $postsPerPage = 12;
        $categories = Category::getVipCategories();
        if( $request->ajax() ){
            $category = $request->type;
            $posts = Post::getVipPostsByCategory($category);
            return Post::getPaginatedPosts( $request, $posts, $postsPerPage );
        }
        return view('good-offers', [
            'categories' => $categories,
            'postsPerPage' => $postsPerPage
        ]);
    }

    public function searchCheck( Request $request )
    {
        $category = $request->category;
        $city = $request->city;
        $search = $request->s;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        
        $params = [];
        if( $city != '0' && $city ){
            $params['city'] = $city;
        }
        if( $search ){
            $params['s'] = $search;
        }
        if( $min_price ){
            $params['min_price'] = $min_price;
        }
        if( $max_price ){
            $params['max_price'] = $max_price;
        }

        
        if( $category != '0' && $category  ){
            $category = json_decode($category);
            $params['maincategory'] = $category[0];
            
            $params['slug'] = $category[1];
            return redirect()->route( 'category' , $params);
        }else{
            return redirect()->route( 'posts' , $params);
        }
    }

}
