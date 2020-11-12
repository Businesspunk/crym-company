<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public static function add($name)
    {
        City::create([
            'name' => lowerFirstLetter( $name ),
            'slug' => str_slug($name)
        ]);
    }
}
