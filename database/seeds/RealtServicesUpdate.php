<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MainCategory;
use Illuminate\Support\Facades\DB;


class RealtServicesUpdate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["квартиры", "комнаты", "участки", "дома", "коммерческая недвижимости"];

        $new_cat = 'риэлторские услуги продажа';

        MainCategory::where( 'id', 7)->update([
            'name' => $new_cat,
            'slug' => str_slug($new_cat)
        ]);

        
        MainCategory::where('weightSort', '>', 3)->increment('weightSort');

        $new_cat = 'риэлторские услуги аренда';

        
        $id = DB::table('maincategories')->insertGetId([
            'name' => $new_cat,
            'slug' => str_slug($new_cat),
            'weightSort' => 4
        ]);

        $i = 1;
        foreach($categories as $category){
            Category::create([
                'maincategory_id' => $id,
                'icon' => 'no icon',
                'name' => $category,
                'slug' => str_slug($category),
                'weightSort' => $i
            ]);
            $i++;
        }
    }
}
