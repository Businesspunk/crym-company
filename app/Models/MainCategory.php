<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $guarded = [];
    protected $table = "maincategories";
    public $timestamps = false;

    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'maincategory_id');
    }    

}
