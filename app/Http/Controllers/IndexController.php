<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Promotion;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\MainCategory;
use Breadcrumbs;
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
            'vipposts' =>  $vipposts->paginate($postsPerPage1),
            'newest' =>  $newest->paginate($postsPerPage2),
            'breadcrumbs' => Breadcrumbs::render('home')
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
            'user' => $request->user(),
            'breadcrumbs' => Breadcrumbs::render('settings')
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
            'breadcrumbs' => Breadcrumbs::render('bookmarks')
        ]);
    }

    public function myposts( Request $request )
    {
        $user = $request->user();
        
        $activePosts = $user->getActivePosts();
        $closedPosts = $user->getClosedPosts();

        return view('my-posts', [
            'activePosts' => $activePosts,
            'closedPosts' => $closedPosts,
            'breadcrumbs' => Breadcrumbs::render('my-posts')
        ]);
    }

    public function add( Request $request )
    {
        return view('add', [
            'promotions' => Promotion::getPromotions( $request->user()->type_of_account ),
            'breadcrumbs' => Breadcrumbs::render('add_post'),
            'costOne' => Promotion::getCostOnePublication( $request->user() )          
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

        $attributes = $category->maincategory->getAttributes();

        $attributes_links =  $attributes;

        $title = sprintf('%s - %s', $category->maincategory->name, $category->name );

        return view('category', [
            'title' => $title,
            'category' => $category,
            'attributes_links' => $attributes_links,
            'attributes' => $attributes,
            'count' => $posts->count(),
            'posts' => $posts->paginate($postsPerPage),
            'breadcrumbs' => Breadcrumbs::render('category', $category->maincategory, $category),
            'header' => [
                'title' => upFirstLetter( $title ),
                'description' => $category->getDescription()
            ]
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
            'breadcrumbs' => Breadcrumbs::render('post', $post),
            'header' => [
                'title' =>  $post->getMetaTitle(),
                'description' => $post->getMetaDescription()
            ]
        ]);
    }
    
    public function messageToSupport()
    {
        return view('message-to-support', [
            'breadcrumbs' => Breadcrumbs::render('messageToSupport')
        ]);
    }

    public function posts(Request $request)
    {
        $posts = Post::getUnclosed();
        $postsPerPage = 12;
        
        if( $request->ajax() ){
            return Post::getPaginatedPosts( $request, $posts, $postsPerPage );
        }

        $attributes = Attribute::orderBy('order', 'desc')->get();

        return view('category', [
            'title' => "Объявления",
            'count' => $posts->count(),
            'attributes' => $attributes,
            'posts' => $posts->paginate($postsPerPage),
            'breadcrumbs' => Breadcrumbs::render('all_posts')
        ]);
    }

    public function maincategory( $maincategory, Request $request)
    {
        $postsPerPage = 12;

        $maincat = MainCategory::where('slug', $maincategory)->firstOrFail();
        
        $cats_ids = $maincat->categories->pluck('id')->toArray();

        $posts = Post::getUnclosed( Post::whereHas('category', function (Builder $query) use ($cats_ids) {
            $query->whereIn('id', $cats_ids);
        }));

        $postsPerPage = 12;
        
        if( $request->ajax() ){
            return Post::getPaginatedPosts( $request, $posts, $postsPerPage );
        }

        $attributes = $maincat->getAttributes();
        $attributes_links = $attributes;

        
        return view('category', [
            'title' => $maincat->name,
            'count' => $posts->count(),
            'attributes' => $attributes,
            'attributes_links' => $attributes_links,
            'posts' => $posts->paginate($postsPerPage),
            'maincategory' => $maincat,
            'breadcrumbs' => Breadcrumbs::render('maincategory', $maincat),
            'header' => [
                'title' => upFirstLetter( $maincat->name ),
                'description' => $maincat->getDescription()
            ]
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
            'postsPerPage' => $postsPerPage,
            'breadcrumbs' => Breadcrumbs::render('goodOffers')
        ]);
    }

    public function searchCheck( Request $request )
    {
        $category = $request->category;
        $city = $request->city;
        $params = $request->all();

        foreach( $params as $key => $param ){
            if( $param == null || $param == "0" || $key == "_token" || $key == 'category' ){
                unset($params[$key]);
            }
        }
        
        if( $category != '0' && $category ){

            if( count( json_decode($category) ) == 1 ){
                $maincat = json_decode($category)[0];
                $params['maincategory'] = $maincat;
                return redirect()->route( 'maincategory' , $params);
            }else{
                $category = json_decode($category);
                $params['maincategory'] = $category[0];
                $params['slug'] = $category[1];
                return redirect()->route( 'category' , $params);
            }
            
        }
        else{
            return redirect()->route( 'posts' , $params);
        }
    }

    public function categoryByAttribute( $category, $attribute, $value = null, Request $request )
    {
        $postsPerPage = 12;
        $category_slug = $category;
        $value_slug = $value;
        $attribute_slug = $attribute;
        
        
        $posts = Post::whereHas('category', function (Builder $category ) use ($category_slug) {

            $category->where('slug' , $category_slug);

        })->whereHas('attribute_value', function (Builder $attribute_value ) use ($attribute_slug, $value_slug) {

            $attribute_value->whereHas('attribute', function (Builder $attribute ) use ($attribute_slug) {
                $attribute->where('slug', $attribute_slug);
            });

            $attribute_value->where('value_slug' , $value_slug);

        } );

        $posts = Post::getUnclosed( $posts );

        if( $request->ajax() ){
            return Post::getPaginatedPosts( $request, $posts, $postsPerPage );
        }

        $category = Category::where('slug', $category_slug)->firstOrFail();
        $category_name = $category->name;
        $attribute = Attribute::where('slug', $attribute_slug)->firstOrFail();
        $attribute_name = $attribute->name;

        $attribute_value = AttributeValue::whereHas('attribute', function (Builder $attribute ) use ($attribute_slug) {
            $attribute->where('slug', $attribute_slug);
        })->where('value_slug', $value)->firstOrFail();

        $attribute_value_name = $attribute_value->value;

        $title = sprintf( '%s - %s - %s %s', $category->maincategory->name, $category_name, $attribute_value_name, $attribute_name);
        $attributes_links = $category->maincategory->getAttributes();

        return view('category', [
            'title' => $title,
            'category' => $category,
            'attributes_links' => $attributes_links,
            'count' => $posts->count(),
            'posts' => $posts->paginate($postsPerPage),
            'breadcrumbs' => Breadcrumbs::render('categoryByAttribute', $category->maincategory, $category, $attribute_value, $attribute)
        ]);
        
    }

    public function maincategoryByAttribute( $category, $attribute, $value = null, Request $request  ){
        $postsPerPage = 12;
        $category_slug = $category;
        $value_slug = $value;
        $attribute_slug = $attribute;
        
        
        $posts = Post::whereHas('attribute_value', function (Builder $attribute_value ) use ($attribute_slug, $value_slug) {

            $attribute_value->whereHas('attribute', function (Builder $attribute ) use ($attribute_slug) {
                $attribute->where('slug', $attribute_slug);
            });

            $attribute_value->where('value_slug' , $value_slug);

        } );

        $posts = Post::getUnclosed( $posts );

        if( $request->ajax() ){
            return Post::getPaginatedPosts( $request, $posts, $postsPerPage );
        }

        $category = MainCategory::where('slug', $category_slug)->firstOrFail();
        $category_name = $category->name;
        $attribute = Attribute::where('slug', $attribute_slug)->firstOrFail();
        $attribute_name = $attribute->name;

        $attribute_value = AttributeValue::whereHas('attribute', function (Builder $attribute ) use ($attribute_slug) {
            $attribute->where('slug', $attribute_slug);
        })->where('value_slug', $value)->firstOrFail();

        $attribute_value_name = $attribute_value->value;

        $title = sprintf( '%s - %s %s', $category_name, $attribute_value_name, $attribute_name);

        $attributes_links = $category->getAttributes();

        return view('category', [
            'title' => $title,
            'maincategory' => $category,
            'attributes_links' => $attributes_links,
            'count' => $posts->count(),
            'posts' => $posts->paginate($postsPerPage),
            'breadcrumbs' => Breadcrumbs::render('maincategoryByAttribute', $category, $attribute_value, $attribute)
        ]);
    }

    public function agreementUser()
    {
        return view('agreementuser');
    }

    public function privacyPolicy()
    {
        return view('privacypolicy');
    }

    public function oferta()
    {
        return view('oferta');
    }

}
