<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class DishesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dishes = Dish::all();
        return view('home')->with('dishes', $dishes);
    }

    public function store(Request $request)
    {
        $all_dishes = Dish::all();
        $user = auth()->user();
        $counts = request('count');
        $dishes = request('dish');
        $table = request("table_no");
        $grand_total = 0;        
        
        if ($counts && $dishes) {
            for ($i = 0; $i < count($dishes); $i++) {
                foreach($all_dishes as $dish){
                    if($dish->id == $dishes[$i]){
                        $sub_total = $dish->price * $counts[$i];
                        $grand_total = $grand_total + $sub_total;
                    }
                }
            }
        }
        
        $order = Order::create([
            'waiter_id'=> $user->id,
            'table_no'=> $table,
            'no_of_dishes'=> count($dishes),
            'grand_total'=> $grand_total,
        ]); 

        if ($counts && $dishes) {
            for ($i = 0; $i < count($dishes); $i++) {
                foreach($all_dishes as $dish){
                    if($dish->id == $dishes[$i]){
                        $sub_total = $dish->price * $counts[$i];
                        OrderDetail::create([
                            'order_id' => $order->id,
                            'dish_id' => $dish->id,
                            'quantity' => $counts[$i],
                            'sub_total' => $sub_total
                        ]);
                    }
                }
            }
        }
        return view('home')->with('dishes', $all_dishes);
    }
}
