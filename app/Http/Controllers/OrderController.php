<?php

namespace App\Http\Controllers;

use DB;
use App\Dish;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function popularMainDish() {
        $most_main = DB::select('SELECT name FROM order_details INNER JOIN dishes ON order_details.dish_id=dishes.id WHERE dish_type = \'main\' GROUP BY dish_id ORDER BY Count(*) DESC LIMIT 1');
        return $most_main[0]->name;
    }
    public function popularSideDish() {
        $most_main = DB::select('SELECT name FROM order_details INNER JOIN dishes ON order_details.dish_id=dishes.id WHERE dish_type = \'side\' GROUP BY dish_id ORDER BY Count(*) DESC LIMIT 1');
        return $most_main[0]->name;
    }

    public function getDailySale() {

        $oders_by_date = Order::all()->where('order_date', date('Y-m-d'));
        $daily_sale = 0;
        foreach($oders_by_date as $order) {
            $daily_sale =  $daily_sale + $order['grand_total'];
        }
        $most_main = $this->popularMainDish();
        $most_side = $this->popularSideDish();
        
        return view('summery')
        ->with('sale', $daily_sale)
        ->with('most_main', $most_main)
        ->with('most_side',$most_side);
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
        return view('order_success')->with('order_id', $order->id);
    }


    public function success() {
        return view('order_success');
    }
}
