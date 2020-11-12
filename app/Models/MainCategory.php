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

    public function attributes(){
        return $this->belongsToMany('App\Models\Attribute', 'maincategory_attributes', 'maincategory_id', 'attribute_id');
    }

    public function getAttributes()
    {
        return $this->attributes()->orderBy('order', 'desc')->get();
    }

    public function getDescription()
    {
        $result = "";
        $result .= upFirstLetter( $this->name ) . ": ";

        $categoryNames = [];
        foreach( $this->categories as $cat ){
            $categoryNames[] = upFirstLetter( $cat->name );
        }

        $result .= implode(", ", $categoryNames);
        $result .= " в Крыму";

        return $result;
    }

}
