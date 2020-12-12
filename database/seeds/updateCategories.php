<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MainCategory;
use Illuminate\Support\Facades\DB;

class updateCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        foreach( $categories as $category ){
            $category->isOnMainPage = true;
            $category->save();
        }

        MainCategory::where('id', 1)->update(['weightSort' => 1]);


        // commercial objects
        $main_cat_id = 2;
        MainCategory::where('id', $main_cat_id)->update(['weightSort' => 2]);
        $category = Category::findOrFail(19);
        $name = "коммерческая недвижимость продажа";
        $category->update([
            'weightSort' => 1,
            'name' => $name,
            'slug' => str_slug($name)
        ]);

        $name = "коммерческая недвижимость сдам в аренду";
        $category = Category::create([
            'maincategory_id' => $main_cat_id,
            'name' => $name,
            'icon' => 'no icon',
            'slug' => str_slug($name),
            'weightSort' => 2
        ]);

        $name = "коммерческая недвижимость возьму в аренду";
        $category = Category::create([
            'maincategory_id' => $main_cat_id,
            'icon' => 'no icon',
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 3
        ]);

        //

        $category = Category::findOrFail(20);
        $name = "готовый бизнес продажа";
        $category->update([
            'weightSort' => 4,
            'name' => $name,
            'slug' => str_slug($name)
        ]);

        $name = "готовый бизнес аренда";
        $category = Category::create([
            'maincategory_id' => $main_cat_id,
            'icon' => 'no icon',
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 5
        ]);

       
        //

        $category = Category::findOrFail(21);
        $name = "оборудование для бизнеса продажа";
        $category->update([
            'weightSort' => 6,
            'name' => $name,
            'slug' => str_slug($name)
        ]);

        $name = "оборудование для бизнеса аренда";
        $category = Category::create([
            'maincategory_id' => $main_cat_id,
            'icon' => 'no icon',
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 7
        ]);

         
        //
        $name = "риэлторские услуги";
        $data = ['name' => $name, 'weightSort' => 3, 'slug' => str_slug($name) ];
        DB::table('maincategories')->insert($data);
        
        
        
        //repair and development sale
        $main_cat_id = 3;
        $mainCategory = MainCategory::where('id', $main_cat_id);
        $name = "ремонт и строительство продажа";
        $mainCategory->update([
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 4
        ]);
        $mainCategory = $mainCategory->first();
        
        
        $categories = $mainCategory->categories;

        for($i = 0; $i < count( $categories ); $i++ ){
            $categories[$i]->weightSort = $i * 10;
            $categories[$i]->save();
        }

        
        $name = "строительное оборудование, станки";
        $category = Category::create([
            'maincategory_id' => $main_cat_id,
            'icon' => 'no icon',
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 55
        ]);

        Category::where('id', 7)->delete();

        $main_cat_id = 5;
        $name = "ремонт и строительство аренда";
        $mainCategory = MainCategory::where('id', $main_cat_id);
        $mainCategory->update([
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 5
        ]);
        $mainCategory = $mainCategory->first();
        $mainCategory->categories()->delete();

        $names = ['инструменты', 'оборудование', 'строительная техника'];
        for( $i = 0; $i < count($names); $i++ ){
            Category::create([
                'maincategory_id' => $mainCategory->id,
                'icon' => 'no icon',
                'name' => $names[$i],
                'slug' => str_slug($name),
                'weightSort' => $i*10
            ]);
        }
        
        // services

        $main_cat_id = 6;
        $name = "услуги (ремонт, строительство, бытовые, транспортные)";
        $mainCategory = MainCategory::where('id', $main_cat_id);
        $mainCategory->update([
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 6
        ]);

        $category = Category::findOrFail(25);
        $name = "ремонт, строительство - услуги юридических и компаний";
        $category->update([
            'weightSort' => 1,
            'name' => $name,
            'slug' => str_slug($name)
        ]);

        $name = "ремонт, строительство - услуги частных лиц и бригад";
        Category::create([
            'maincategory_id' => $main_cat_id,
            'icon' => 'no icon',
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 2
        ]);

        $category = Category::findOrFail(26);
        $category->update([
            'weightSort' => 3
        ]);

        $name = "бытовые услуги";
        Category::create([
            'maincategory_id' => $main_cat_id,
            'icon' => 'no icon',
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 4
        ]);
        
        $name = "транспортные перевозки";
        $category = Category::findOrFail(27);
        $category->update([
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 5
        ]);

        $name = "автоспецтехника";
        Category::create([
            'maincategory_id' => $main_cat_id,
            'icon' => 'no icon',
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 6
        ]);

        $category = Category::findOrFail(28);
        $category->update([
            'weightSort' => 7
        ]);

        //garden and design

        $main_cat_id = 4;
        $name = "cад, огород, растения, животные, ландшафтный дизайн";
        $mainCategory = MainCategory::where('id', $main_cat_id);
        $mainCategory->update([
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 7
        ]);

        $category = Category::findOrFail(15);
        $category->update([
            'weightSort' => 1
        ]);

        $category = Category::findOrFail(18);
        $category->update([
            'weightSort' => 2
        ]);

        $category = Category::findOrFail(16);
        $category->update([
            'weightSort' => 3
        ]);

        $category = Category::findOrFail(17);
        $category->update([
            'weightSort' => 4
        ]);

        $name = "садовая техника и оборудование";
        Category::create([
            'maincategory_id' => $main_cat_id,
            'icon' => 'no icon',
            'name' => $name,
            'slug' => str_slug($name),
            'weightSort' => 5
        ]);
    }
}
