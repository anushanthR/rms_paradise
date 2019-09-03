@extends('layouts.app')

@section('content')
<div class="container">    
    <form action="/submit" method="POST">
    @csrf 
        <div class = "row">       
            <div class = "col">
                <div class="form-inline form-group mb-2">
                    <label for="table">Table No &nbsp; &nbsp;</label>
                    <input type="number" class="form-control" id="table_no" name = "table_no" required min = '1'>
                </div>
            </div> 
        </div>           
        <div class="row">
            <div class = "col-md-6">
                <div class="card">
                    <div class="card-header">
                    Main Dishes
                    </div>                
                    <div class="card-body">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Dish</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Sub total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($dishes as $dish)
                                @if($dish->dish_type =='main')
                                <tr>                                
                                    <td scope="row"> 
                                        <input type="checkbox"  id={{"dish".$dish->id}} name = "dish[]" value = {{$dish->id}} onchange = "enableCount({{$dish}})">                                                            
                                        {{$dish->name}}                                                                    
                                    </td>
                                    <td>
                                        {{'Rs ' .$dish->price}}
                                    </td>
                                    <td>
                                        <input type="number" id ={{"dishQty".$dish->id}} placeholder="Qty." class="form-control form-control-sm" disabled  name="count[]" min = "0"  onchange = "getSubTotal({{$dish}});" required>
                                    </td>
                                    <td>
                                        <label class="" id = {{"subTotal".$dish->id}} name = "subTotal">0</label>
                                    </td>
                                </tr>
                                @endIf                                            
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class = "col-md-6">                      
                <div class = "card">
                    <div class="card-header">
                        Side dishes
                    </div>
                    <div class="card-body">                            
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Dish</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Sub total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dishes as $dish)
                                @if($dish->dish_type =='side')
                                <tr>                                
                                    <td scope="row"> 
                                        <input type="checkbox" class="" id={{"dish".$dish->id}} name = "dish[]" value = {{$dish->id}} onchange = "enableCount({{$dish}})">                                                            
                                        {{$dish->name}}                                                                    
                                    </td>
                                    <td>
                                        {{'Rs ' .$dish->price}}
                                    </td>
                                    <td>
                                        <input type="number" id ={{"dishQty".$dish->id}} placeholder="Qty." class="form-control form-control-sm" disabled  name="count[]" min = "0" onchange = "getSubTotal({{$dish}});" required>
                                    </td>
                                    <td>
                                        <label class="" id = {{"subTotal".$dish->id}} name = "subTotal" >0</label>
                                    </td>
                                </tr>
                                @endIf                                            
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>                               
        </div>
        <div class = "row">
            <div class="col mt-3">
                <label>Grand Total : &nbsp; &nbsp;</label>
                <label id = "grand_total">0.00</label>
            </div>       
            <div class = "col text-right mt-3">
                <button class = "btn btn-primary" type = "submit">Submit</button>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection

<script>
function setGrandTotal(){
    var subTotals = document.getElementsByName("subTotal");
    var grandTotal = 0;
    subTotals.forEach(element => {
        grandTotal = grandTotal + parseInt(element.innerText);
    });
    document.getElementById("grand_total").innerHTML = 'Rs. '+grandTotal;
}

function getSubTotal(dish){
    var id = dish.id;    
    count = document.getElementById("dishQty"+id).value;
    subTotal = dish.price*count;
    document.getElementById("subTotal"+id).innerHTML = subTotal;
    document.getElementById("subTotal"+id).value = subTotal;
    setGrandTotal();
    
}

function enableCount(dish){
    var id = dish.id;
    selected = document.getElementById("dish"+id).checked;
    if(selected) {
        document.getElementById("dishQty"+id).disabled = false;
        document.getElementById("dishQty"+id).value = 1;
        getSubTotal(dish);
    }
    else {
        document.getElementById("subTotal"+id).innerHTML = 0;
        document.getElementById("dishQty"+id).value = 0;
        document.getElementById("dishQty"+id).disabled = true;
        setGrandTotal();}
    }
</script>