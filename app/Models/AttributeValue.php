<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $guarder = [];
    public $timestamps = false;
    protected $table = 'attribute_value';

}
