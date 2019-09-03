<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'waiter_id', 'table_no', 'no_of_dishes', 'grand_total'
    ];

}
