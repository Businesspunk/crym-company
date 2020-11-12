<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Promotion extends Model
{
    protected $guarded = [];

    public static function getCostOnePublication( $user )
    {
        if( $user->type_of_account == 2 )
            $cost = 100;
        else{
            $cost = 20;
        }

        return $cost;
    }

    public static function getFullNameOfPromotion( $promotion )
    {
        if( !$promotion->days ){
            $str = $promotion->desc;
        }else{
            $days = num_decline( $promotion->days, 'день', 'дня', 'дней' );
            $str = sprintf('удержание первых мест в результатах поиска на %d дней', $days);
        }
        return $str;
    }

    public static function getPromotions( $type_own, $isRealty = false, $isAdded = false )
    {
        $promotions = Promotion::where('type_own', $type_own)->where('isRealty', $isRealty);
        
        if( !$isAdded ){
            $promotions->where('days', '!=', null);
        }

        $promotions = $promotions->get();

        $promotions = $promotions->sortByDesc(function($item){
            return  - $item->days;
        });

        return $promotions->values();
    }


    public static function calculateCost( $category_id, $promotion_id, $user, $isInUpdate = false )
    {
        $strings = [];

        $cost = 0;
        $category = Category::find( $category_id );
        $promotion = Promotion::find($promotion_id);
        $isFreePublication = false;

        if( !$isInUpdate ){
            if( $user->free_publications == 0){
                $strings[] = "дополнительное размещение объявления";
                $cost += Promotion::getCostOnePublication( $user );
            }else{
                $isFreePublication = true;
            }
        }
        if( $promotion_id ){
            $strings[] = Promotion::getFullNameOfPromotion($promotion);
            $cost += $promotion->cost;
        }

        $description = cyrFLtoUpper( implode ( " и ",  $strings ));

        return [
            'cost' => $cost,
            'desc' => $description,
            'isFreePublication' => $isFreePublication,
            'promotion_id' => $promotion_id
        ];

    }

}
