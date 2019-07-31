<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];   
    public $timestamps = false;

    public function maincategory()
    {
        return $this->belongsTo('App\Models\MainCategory');
    }
}
