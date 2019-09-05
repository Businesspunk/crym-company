<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\MainCategory;
use App\Models\City;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $file = app_path('Helpers/Helper.php');
        
        if (file_exists($file)) {
            require_once($file);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if( Schema::hasTable('cities') ){
            
            $mainCat = MainCategory::with('categories')->get()->sortBy(function($cat){
                return $cat->categories->count() * -1;
            });
            
            View::share('maincategories', $mainCat );
            
            $cookie = getFavorite();
            View::share('favorites', $cookie );

            $cities = City::all();
            View::share('cities', $cities );

        }


    }
}
