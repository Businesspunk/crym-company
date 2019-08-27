<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Post extends Model implements ViewableContract
{
    use Viewable;

    public $fillable = ['title', 'cost', 'user_id', 'category_id', 'description', 'youtube', 'coord_x', 'coord_y', 'promotion_id', 'main_photo', 'isVip', 'isClose'];

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
}
