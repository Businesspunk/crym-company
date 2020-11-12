<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class Cities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();

        $cities = ['Симферополь', 'Севастополь', 'Алупка', 'Алушта', 'Армянск', 'Бахчисарай', 'Белогорск', 'Гурзуф', 'Джанкой',
        'Евпатория', 'Инкерман', 'Керч', 'Коктебель', 'Красногвардейское', 'Красноперекопск', 'Раздольное', 'Саки', 'Судак',
        'Феодосия', 'Черноморское', 'Щелкино', 'Ялта', 'Старый Крым'];
        
        sort($cities);

        foreach( $cities as $city ){
            City::add($city);
        }
    }
}
