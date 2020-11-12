<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class postAttributeValue extends Pivot
{
    protected $table = "post_attribute_value";
    public $timestamps = false;
    protected $guarded = [];
    
}
