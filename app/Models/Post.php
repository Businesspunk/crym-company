<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Post extends Model implements ViewableContract
{
    use Viewable;

    public $fillable = ['title', 'cost', 'user_id', 'category_id', 'description', 'youtube', 'coord_x', 'coord_y', 'promotion_id', 'main_photo', 'isVip', 'isClose', 'city'];

    public function photos()
    {
        return $this->hasMany('App\Models\PostsPhoto');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    protected static function addCity( $city )
    {
        $statement = City::where('name', $city)->count();
        if( $statement == 0 ){
            City::create([
                'name' => $city,
                'slug' => str_slug($city)
            ]);
        }
    }

    protected static function deleteCity( $city )
    {
        $statement = Post::getUnclosed()->where('city', $city)->count();

        if( $statement == 0 ){
            City::where('name', $city )->delete();
        }
    }

    public function deleteOne()
    {   
        $post = $this;

        $city = $post->city;
        $result = [];
        $photos = $post->photos;

        foreach ($photos as $photo) {
            $result[] = $photo['url'];
        }
        $result[] = $post->main_photo;
        Storage::delete( $result );
        $post->delete();
        Post::deleteCity($city);
    }

    public static function addOne( Request $request )
    {
        $data = $request->all();
        $photos = json_decode( $data['images'] ) ?? [];
        $main_photo = getImageName( $data['main_photo'] );

        $data['city'] = getCity( $data['coord_y'], $data['coord_x'] );
        $data['main_photo'] = 'posts/'.$main_photo;
        $data['user_id'] = Auth::id();

        $post = Post::create($data);
        
        Storage::move('temp/'.$main_photo, 'posts/'.$main_photo );
        foreach( $photos as $photo ){
            $img = getImageName( $photo );
            Storage::move('temp/'.$img, 'posts/'.$img );
            PostsPhoto::create([
                'post_id' => $post->id,
                'url' => 'posts/'.$img
            ]);
        }

        $city = $post->city;
        Post::addCity($city);

    }

    public function updateOne( $args )
    {
        $oldCity = $this->city;
        $this->update($args);
        $newCity = $this->city;
        if( $oldCity != $newCity ){
            Post::deleteCity($oldCity);
            Post::addCity($newCity);
        }elseif( isset($args['isClose']) ){
            Post::deleteCity( $oldCity );
        }
    }

    public function editOne( Request $request )
    {
        $post = $this;
        $data = $request->all();
        $data['city'] = getCity( $data['coord_y'], $data['coord_x'] );
        
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

        $this->updateOne($data);

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
    }

    public static function getUnclosed()
    {
        $posts = Post::where('isClose', null)->orderBy('created_at');
        return $posts;
    }

    public static function getVip()
    {
        $posts = Post::getUnclosed()->where( 'isVip', 1 );
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
}
