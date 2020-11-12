<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostsPhoto extends Model
{
    protected $table = 'postsPhotos';
    public $timestamps = false;
    public $guarded = []; 
}
