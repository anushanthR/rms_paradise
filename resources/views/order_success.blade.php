@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="row">
        <div class="col" style = "margin-top:50px">
            Order has been placed successfully. Your order no is {{$order_id}}.
        </div>
    </div>
    <a class = "btn btn-primary mt-3" href={{action('HomeController@index')}}>New Order</a>
</div>

@endsection