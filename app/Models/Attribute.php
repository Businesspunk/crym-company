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

    public function getPairsNameAttribAndValue()
    {
        $name = $this->name;
        $values =  $this->values;
        $result = [];

        foreach( $values as $value ){
            if( $value->value_slug != null ){
                $result[] = [ 
                    'name' =>  $value->value . ' - ' . $name,
                    'value' =>  $value->value_slug
                ];
            }else{
                $result[] = [ 
                    'name' => $name,
                    'value' =>  $value->value_slug
                ];
            }
            
        }

        return $result;
    }
}
