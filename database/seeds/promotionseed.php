<?php

use Illuminate\Database\Seeder;
use App\Models\Promotion;

class promotionseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Без продвижения',
                'block_1' => '-',
                'icon' => '',
                'block_2' => '-',
                'block_3' => '1 раз',
                'cost' => 0
            ],
            [
                'name' => 'VIP',
                'block_1' => '-',
                'icon' => '',
                'block_2' => '+',
                'block_3' => '1 раз',
                'cost' => 139
            ],
            [
                'name' => 'VIP',
                'block_1' => '-',
                'icon' => '',
                'block_2' => '-',
                'block_3' => '2 раза',
                'cost' => 250
            ],
            [
                'name' => 'Все',
                'block_1' => '+',
                'icon' => '',
                'block_2' => '+',
                'block_3' => '8 раз',
                'cost' => 350
            ],
        ];

        foreach ($data as $item) {
            Promotion::create($item);
        }
        
    }
}
