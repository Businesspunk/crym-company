<?php

use Illuminate\Database\Seeder;
use App\Models\Promotion;

class PromoUpdatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // 'name', 'icon', 'cost', 'type_own', 'cost_realty', 'days', 'desc' 
    public function run()
    {
        $realty = [
            [
                'cost' => 150,
                'type_own' => 2,
                'isRealty' => true,
                'days' => 5,
            ],
            [
                'cost' => 250,
                'type_own' => 2,
                'isRealty' => true,
                'days' => 10,
            ],
            [
                'cost' => 80,
                'type_own' => 2,
                'isRealty' => true,
                'desc' => "Единоразовое продвижение в топ"
            ],
            [
                'cost' => 80,
                'type_own' => 1,
                'isRealty' => true,
                'days' => 5,
            ],
            [
                'cost' => 120,
                'type_own' => 1,
                'isRealty' => true,
                'days' => 10,
            ],
            [
                'cost' => 40,
                'type_own' => 1,
                'isRealty' => true,
                'desc' => "Единоразовое продвижение в топ"
            ],
        ];

        $noRealty = [
            [
                'cost' => 100,
                'type_own' => 2,
                'days' => 5,
            ],
            [
                'cost' => 150,
                'type_own' => 2,
                'days' => 10,
            ],
            [
                'cost' => 40,
                'type_own' => 2,
                'desc' => "Единоразовое продвижение в топ"
            ],
            [
                'cost' => 50,
                'type_own' => 1,
                'days' => 5,
            ],
            [
                'cost' => 80,
                'type_own' => 1,
                'days' => 10,
            ],
            [
                'cost' => 20,
                'type_own' => 1,
                'desc' => "Единоразовое продвижение в топ"
            ],
        ];


        $data = array_merge( $realty, $noRealty );
        
        foreach ($data as $item) {
            Promotion::create( $item );
        }
        
    }
}
