@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        summary
    </div>
    <div class="row">
        <div class = "col-md-12">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <form action="/submit" method="POST">
                @csrf
                <div class="card-body">
                    <div class = "row">
                        <div class = "col">
                            <div class="form-inline form-group mb-2">
                                <label for="table">Table No &nbsp; &nbsp;</label>
                                <input type="number" class="form-control" id="table_no" name = "table_no">
                            </div>
                        </div>
                    </div>  

                    <div class = "row">
                        <div class = "col-md-6">
                            <div class="card-header">
                                Main dishes
                            </div>                                    
                            <div class="card-body">
                                <table class="table">
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
                                            <input type="number" id ={{"dishQty".$dish->id}} placeholder="Qty." class="form-control form-control-sm" disabled  name="count[]" min = "0" value = "0"  onchange = "getSubTotal({{$dish}});">
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
                        <div class = "col-md-6">
                            <div class="card-header">
                                Side dishes
                            </div>
                            <div class="card-body">                            
                                <table class="table">
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
                                                <input type="number" id ={{"dishQty".$dish->id}} placeholder="Qty." class="form-control form-control-sm" disabled  name="count[]" min = "0" value = "0" onchange = "getSubTotal({{$dish}});">
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
                    <div class="card-body">
                        <div class = "row">
                            <div class = "col">
                                <div class="form-inline form-group mb-2">
                                    <label >Grand Total &nbsp; &nbsp;</label>
                                    <label Id = "grand_total">0</label>                                        
                                </div>
                            </div>
                        </div>  
                    </div>
                <button class = "btn btn-primary" type = "submit">Submit</button>
                </form>
            </div>
        </div>
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
    document.getElementById("grand_total").innerHTML = grandTotal;
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
    if(selected)
    {document.getElementById("dishQty"+id).disabled = false;}
    else
    {document.getElementById("subTotal"+id).innerHTML = 0;
    document.getElementById("dishQty"+id).value = 0;
    document.getElementById("dishQty"+id).disabled = true;
    setGrandTotal();}
}

</script>