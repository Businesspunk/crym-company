<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Models\Promotion;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;
use App\Models\postAttributeValue;

class Post extends Model implements ViewableContract
{
    use Viewable;
    use SearchableTrait;
    
    protected $searchable = [
        'columns' => [
            'posts.title' => 20,
            'posts.description' => 10,
        ],
    ];

    public $fillable = ['title', 'cost', 'user_id', 'category_id', 'description', 'youtube', 'coord_x', 'coord_y', 'isClose', 'city_id', 'phone_number', 'follovers'];

    public function photos()
    {
        return $this->hasMany('App\Models\PostsPhoto');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function city()
    {
        return $this->hasOne('App\Models\City');
    }

    public function attribute_value()
    {
        return $this->belongsToMany('App\Models\AttributeValue', 'post_attribute_value', 'post_id', 'attribute_value_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function isHaveValue( $attribute, $value ){
        $attribute_values = $this->attribute_value ?? [];

        foreach( $attribute_values as $attribute_value ){
            if( $attribute_value->attribute->slug == $attribute 
                && $attribute_value->value_slug == $value ){
                    return true;
            }
        }

        return false;
    }

    public function isRealty()
    {
        if( $this->category->maincategory->id == 1 ){
            return true;
        }
        return false;
    }

    protected static function addAttributes($id, $request)
    {
        $attributes = Attribute::all();
        foreach( $attributes as $attribute ){
            $slug = $attribute->slug;
            if( $request->$slug ){
                $request_value = $request->$slug;
                if( $request_value == 'null' ){
                    $request_value = null;
                }
                $value = $attribute->values()->where('value_slug', $request_value)->first();
                if( $value ){
                    $value = $value->id;
                    postAttributeValue::create([
                        'post_id' => $id,
                        'attribute_value_id' => $value
                    ]);
                }
            }
        }

    }

    protected static function removeAttributes($id)
    {
        postAttributeValue::where([
            'post_id' => $id,
        ])->delete();
    }

    public function deleteOne()
    {   
        $post = $this;
        Post::removeAttributes( $post->id );
        $city = $post->city;
        
        foreach( $post->photos as $photo){
            $photo->deletePhoto();
        }

        $post->delete();
        Post::deleteCity($city);
    }

    public static function addOne( Request $request )
    {
        $user = $request->user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['phone_number'] = $request->phone_number;
        $data['city_id'] = $data['city_id'] == 0 ? null : $data['city_id'];

        $photos = json_decode( $data['images'] ) ?? [];

        if( $data['youtube'] ){
            $data['youtube'] = getYoutubeId($data['youtube']);
        }

        $post = Post::create($data);

        $now = Carbon::now();
        $post->promotionUnder = $now->toDateTimeString();
        
        if( $data['main_photo'] ){
            $main_photo = json_decode($data['main_photo'])->id;
            PhotoTemp::findOrFail( $main_photo )->moveToPosts($post->id, true);
        }

        Post::addAttributes( $post->id ,$request);

        if( $user->can('vipPosting', $post ) ){
            $post->isVip = 1;
        }
        
        foreach( $photos as $photo ){
            PhotoTemp::findOrFail( $photo->id )->moveToPosts($post->id);
        }

        $promoInfo = Promotion::calculateCost( $request->category_id, $request->promotion_id, $user );
        
        if( $promoInfo['isFreePublication'] ){
            $user->free_publications--;
            $user->save();
            $post->isPaid = true;
        }

        $post->save();
        
        $promoInfo['post_id'] = $post->id;

        return $promoInfo;
    }

    public function editOne( Request $request )
    {
        $post = $this;

        Post::removeAttributes($post->id);
        Post::addAttributes( $post->id, $request );

        $data = $request->all();
        $data['city_id'] = $data['city_id'] == 0 ? null : $data['city_id'];
        
        if( $data['youtube'] ){
            $data['youtube'] = getYoutubeId($data['youtube']);
        }

        $main_photo = $data['main_photo'] == null ? null : json_decode( $data['main_photo'], true );
        $old_main_photo = $post->getMainPhoto() == null ? null : json_decode($post->getMainPhoto()->getPhotoJson(), true);

        if( $old_main_photo != $main_photo )
        {
            if( !is_null( $old_main_photo) ){
                PostsPhoto::findOrFail( $old_main_photo['id'] )->deletePhoto();
            }

            if( !is_null( $main_photo ) ){
                PhotoTemp::findOrFail( $main_photo['id'] )->moveToPosts($post->id, true);
            }
        }

        $data['user_id'] = $request->user()->id;

        $this->update($data);

        $old_photos = json_decode( $post->getAdditionalPhotosJson(), true) ?? [];
        $new_photos = json_decode( $data['images'], true ) ?? [];

        foreach($old_photos as $old_photo){

            $willBeDeleted = true;
            foreach( $new_photos as $new_photo ){
                if( $old_photo == $new_photo ){
                    $willBeDeleted = false;
                }
            }

            if( $willBeDeleted ){
                PostsPhoto::findOrFail( $old_photo['id'] )->deletePhoto();
            }
        }
        
        foreach( $new_photos as $new_photo ){
            if( $new_photo['type'] == "temp" ){
                PhotoTemp::findOrFail( $new_photo['id'] )->moveToPosts($post->id);
            }
        }

        $promoInfo = Promotion::calculateCost( $request->category_id, $request->promotion_id, $request->user(), true );
        $promoInfo['post_id'] = $post->id;

        return $promoInfo;
    }

    public static function getUnclosed( $query = null )
    {
        if( $query ){
            $posts = $query->where('isClose', null);
        }else{
            $posts = Post::where('isClose', null);
        }

        $posts->where('isPaid', true);

        if( isset(request()->city) ){
            $posts->where('city_id', request()->city);
        }

        if( isset(request()->s) ){
            $posts->search( request()->s, null, true );
        }
        if( isset(request()->min_price) ){
            $posts->where( 'cost', '>=', request()->min_price );
        }
        if( isset(request()->max_price) ){
            $posts->where( 'cost', '<=', request()->max_price );
        }

        $counter = 0;
        
        foreach( request()->all() as $key => $param ){
            if ( strpos($key, '_attribute') !== false ) {
                $where_func = $counter > 0 ? 'orWhere' : 'where';
                if( is_array($param) ){
                    $posts->$where_func( function (Builder $query) use ($param, $key) {
                        $query->whereHas( 'attribute_value', function (Builder $query) use ($param, $key) {
                            $i = 0;
                            foreach( $param as $elem ){
                                $where_func_2 = $i > 0 ? 'orWhere' : 'where';
                                $query->$where_func_2( function( Builder $query ) use ($param, $key, $elem){
                                    $query->whereHas( 'attribute', function (Builder $query) use ($param, $key) {
                                        $query->where('slug', $key);
                                    } )->where('value_slug', $elem );
                                });
                                
                                $i++;
                            }
                            
                        });
                    });

                }elseif( $param == "null" ){
                    $posts->$where_func( function (Builder $query) use ($param, $key) {
                        $query->whereHas( 'attribute_value', function (Builder $query) use ($param, $key) {
                            $query->whereHas( 'attribute', function (Builder $query) use ($param, $key) {
                                $query->where('slug', $key);
                            } )->where('value_slug', null );
                        });
                    } );
                }
                $counter++;
            }
        }
        
        return $posts->orderBy('promotionUnder', 'DESC')->orderBy('created_at', 'DESC');
    }

    public static function getVip()
    {
        $posts = Post::getUnclosed()->where( 'isVip', 1 );
        return $posts;
    }
    public static function getVipPostsByCategory($slug)
    {
        $posts = Post::getVip()->whereHas('category', function (Builder $query ) use ($slug) {
            $query->where('slug', $slug);
        });

        return $posts;
    }

    public static function getPaginatedPosts( $request, $posts, $postsPerPage = 10 )
    {   
        $page = $request->page;
        
        $posts = $posts->paginate($postsPerPage, ['*'], 'page', $page);

        return response()
                ->json( 
                    ['content' => view('components/posts-ajax', compact('posts') )->render(), 
                    'hasMorePages' => $posts->hasMorePages(),
                    ] 
                );
    }

    public function getRelatedPosts()
    {
        $post = $this;
        $posts = Post::where('category_id', $post->category_id)
                        ->where('id', '!=', $post->id )
                        ->paginate(10);

        $posts->forget( $post->id );
        return $posts;
    }

    public function promote( $promotion_id )
    {
        $promote = Promotion::findOrFail( $promotion_id );
        $this->isPaid = true;
        $now = Carbon::now();

        if( $promote->desc ){
            $this->promotionUnder = $now->toDateTimeString(); 
        }else if( $days = (int) $promote->days ){
            $date = $now->addDays($days);
            $this->promotionUnder = $date->toDateTimeString();
        }

        $this->save();
    }

    public function getMetaDescription()
    {
        return $this->description;
    }
    public function getMetaTitle()
    {
        return $this->title;
    }

    public function getMainPhoto()
    {
        $query = $this->photos()->where('is_main', true);
        $model = $query->count() ? $query->first() : null;
        
        return $model;
    }

    public function getMainPhotoUrl()
    {
        $query = $this->photos()->where('is_main', true);
        $url = $query->count() ? $query->first()->url : null;

        return $url;
    }

    public function getMainLagerPhotoUrl()
    {
        $query = $this->photos()->where('is_main', true);
        $url = $query->count() ? $query->first()->getLagerPhotoUrl() : null;
        return $url;
    }

    public function getAdditionalPhotos()
    {
        return $this->photos()->where('is_main', false)->get();
    }

    public function getAdditionalPhotosJson()
    {
        $photos = $this->getAdditionalPhotos();
        $data = [];

        foreach( $photos as $photo )
        {
            $data[] = [
                "id" => $photo->id,
                "type" => "posts"
            ];
        }

        return json_encode($data);
    }

    public function getPhone()
    {
        if( $this->phone_number ){
            return $this->phone_number;
        }else if( $this->user->profile->number ){
            return $this->user->profile->number;
        }

        return 0;
    }
}
