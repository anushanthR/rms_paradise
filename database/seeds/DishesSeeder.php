<?php

use App\Dish;
use Illuminate\Database\Seeder;

class DishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = array(
            array('name'=> 'rice', 'description'=>'test', 'price'=> 100.00, 'dish_type'=>'main' ),
            array('name'=> 'rotty', 'description'=>'test', 'price'=> 20.00, 'dish_type'=>'main' ),
            array('name'=> 'Noodles', 'description'=>'test', 'price'=> 150.00, 'dish_type'=>'main' ),
            array('name'=> 'wadai', 'description'=>'test', 'price'=> 45.00, 'dish_type'=>'side' ),
            array('name'=> 'Dhal curry', 'description'=>'test', 'price'=> 75.00, 'dish_type'=>'side' ),
            array('name'=> 'Fish curry', 'description'=>'test', 'price'=> 120.00, 'dish_type'=>'side' ),
    );
    foreach($dishes as $dish)
        Dish::insert([
            'name'=> $dish["name"],
            'description'=> $dish["description"],
            'price'=> $dish["price"],
            'dish_type'=>$dish["dish_type"]
        ]);
    }
}
