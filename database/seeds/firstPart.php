<?php

use Illuminate\Database\Seeder;
use App\Models\MainCategory;
use App\Models\Category;

class firstPart extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mainCat = ['недвижимость', 'коммерческая недвижимость и бизнес', 'ремонт и строительство', 'ландшафтный дизайн. сад. огород' ];

        foreach( $mainCat as $cat ){
            MainCategory::create([
                'name' => $cat,
                'slug' => str_slug($cat)
            ]);
        }

        $childCat = [
            [ 
                'id' => 1 ,
                'categories' => [ 'продажа', 'покупка', 'сдам в аренду', 'возьму в аредну'],
            ],
            [   
                'id' => 3 ,
                'categories' => ['окна, двери', 'инструменты', 'садовая техника', 'камины, кондиционеры',
                                    'сантехника', 'стройматериалы', 'строительная техника', 'сдам в аренду', 'возьму в аредну', 'услуги'],
            ],
            [   
                'id' => 4 ,
                'categories' => ['благоустройство', 'растения', 'животные', 'услуги'],
            ],
            [   
                'id' => 2 ,
                'categories' =>['коммерческая недвижимость', 'готовый бизнес', 'оборудование для бизнеса'],
            ],
        ];

        foreach( $childCat as $cat ){

            $mainId = $cat['id'];
            foreach( $cat['categories'] as $c ){
                Category::create([
                    'name' => $c,
                    'maincategory_id' => $mainId,
                    'slug' => str_slug($c)
                ]);
            }

        }
    }
}
