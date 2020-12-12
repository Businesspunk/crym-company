<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\User;

class NewUpdate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["квартиры", "комнаты", "участки", "дома", "коммерческая недвижимости"];

        $i = 1;
        foreach($categories as $category){
            Category::create([
                'maincategory_id' => 7,
                'icon' => 'no icon',
                'name' => $category,
                'slug' => str_slug($category),
                'weightSort' => $i
            ]);
            $i++;
        }

        $user = User::find(2);
        $user->free_publications = 9999;
        $user->save(); 
    }
}
