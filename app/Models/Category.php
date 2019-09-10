<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;

class Category extends Model
{
    protected $guarded = [];   
    public $timestamps = false;

    public function maincategory()
    {
        return $this->belongsTo('App\Models\MainCategory', 'maincategory_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    public function getActivePosts()
    {
        $posts = $this->posts();
        Post::getUnclosed($posts);
        return $posts;
    }

    public function getVip()
    {
        return $this->getActivePosts()->where( 'isVip', 1 );
    }

    public static function getVipCategories()
    {
        $categories = Category::whereHas('posts', function (Builder $query) {
            $query->where('isClose', null)->where('isVip', 1);
        })->get();
        return $categories;
    }
}
