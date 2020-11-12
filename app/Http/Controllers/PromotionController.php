<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Category;

class PromotionController extends Controller
{
    public function getPromoTemplate( Request $request )
    {
        $category_id= $request->category_id;
        $isAdded = $request->isAdded;
        $category = Category::find($category_id);

        $isRealty = false;
        if( $category->maincategory->id == 1 ){
            $isRealty = true;
        }

        $promotions = Promotion::getPromotions( $request->user()->type_of_account, $isRealty, $isAdded );

        return view('components.promotion', [
            'promotions' => $promotions
        ]);
    }
}
