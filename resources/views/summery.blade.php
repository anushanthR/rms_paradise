@extends('layouts.app')

@section('content')

<div class="container">
    <div class = "row">
        <div class = "col-md-6 offset-3">
            <div class= "card">
                <div class = "card-body">
                    <div class = "row">
                        <div class="col-md-6">
                            <div class="row"><div class="label col">Total Sales of the day </div></div>
                            <div class="row"><div class="label col">Most Popular Main Dish </div></div>
                            <div class="row"><div class="label col">Most Popular Side Dish </div></div>
                        </div>
                        <div class="col-md-6">
                            <div class="row"><span class="value"> {{"Rs. ". number_format($sale,2,'.',',')}}</span></div>
                            <div class="row"><span class="value">{{$most_main}} </span></div>
                            <div class="row"><span class="value">{{$most_side}} </span></div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col text-right mt-3">
                            <a onclick="" class = "btn btn-primary" href={{action('HomeController@index')}}>Home</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection