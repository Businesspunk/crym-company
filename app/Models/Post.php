<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable = ['title', 'cost', 'user_id', 'category_id', 'description', 'youtube', 'coord_x', 'coord_y', 'typeOfPromote', 'main_photo', 'isVip'];

    public function photos()
    {
        return $this->hasMany('App\Models\PostsPhoto');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
