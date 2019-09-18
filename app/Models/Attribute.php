<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarder = [];
    public $timestamps = false;
    
    public function values(){
        return $this->hasMany('App\Models\AttributeValue');
    }
}
