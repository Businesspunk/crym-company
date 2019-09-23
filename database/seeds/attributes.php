<?php

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\MainCategory_Attribute;


class attributes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [ 'комнаты', 'дома, дачи, коттеджи', 'земельный участок', 'гаражи и машиноместа'];

        $attributes_values = [
            [
                1,
                [ '1', '2', '3 и более' ]
            ],
            [
                2,
                [ null ]
            ],
            [
                3,
                [ null ]
            ],
            [
                4,
                [ null ]
            ],

        ];

        $mainCategory_Attributes = [
            [
                'attrib_id' => 1,
                'main_cat_id' => 1
            ],
            [
                'attrib_id' => 2,
                'main_cat_id' => 1
            ],
            [
                'attrib_id' => 3,
                'main_cat_id' => 1
            ],
            [
                'attrib_id' => 4,
                'main_cat_id' => 1
            ],
            
        ];

        foreach ($attributes as $attribute) {
            Attribute::create([
                'name' => $attribute,
                'slug' => str_slug($attribute)."_attribute"
            ]);
        }

        foreach ($attributes_values as $values) {
            
            foreach ($values[1] as $value) {
                if( $value ){
                    AttributeValue::create([
                        'attribute_id' => $values[0],
                        'value_slug' => str_slug($value),
                        'value' => $value
                    ]);
                }else{
                    AttributeValue::create([
                        'attribute_id' => $values[0],
                    ]);
                }
            }
        }

        foreach( $mainCategory_Attributes as $relation ){
            MainCategory_Attribute::create([
                'maincategory_id' => $relation['main_cat_id'],
                'attribute_id' => $relation['attrib_id']
            ]);
        }
    }
}
