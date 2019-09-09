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
        $mainCat = ['недвижимость', 'ремонт и строительство', 
                    'ландшафтный дизайн. сад. огород', 'коммерческая недвижимость и бизнес'];

        foreach( $mainCat as $cat ){
            MainCategory::create([
                'name' => $cat,
                'slug' => str_slug($cat)
            ]);
        }

        $childCat = [
            [ 
                'id' => 1 ,
                'categories' => [ 'продажа', 'покупка', 'аренда'],
            ],
            [   
                'id' => 2 ,
                'categories' => ['окна, двери', 'инструменты', 'садовая техника', 'камины, кондиционеры',
                                    'сантехника', 'стройматериалы', 'строительная техника', 'аренда', 'услуги'],
            ],
            [   
                'id' => 3 ,
                'categories' => ['благоустройство', 'растения', 'животные', 'услуги'],
            ],
            [   
                'id' => 4 ,
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
