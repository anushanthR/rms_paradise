@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        summary
    </div>
    <div class="row">
        <div class = "col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>

                <div class="card-body">
                    <div class = "row">
                        <div class = "col">
                            <div class="form-inline form-group mb-2">
                                <label for="table">Table &nbsp; &nbsp;</label>
                                <input type="number" class="form-control" id="table" name = "table">
                            </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-md-6">
                                <div class="card-header">
                                        Main dishes
                                    </div>
                                    <div class="card-body">
                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                    <input type="checkbox" class="custom-control-input" id="customControlInline" value = "dish 1">
                                                    <label class="custom-control-label" for="customControlInline">dish 1</label>
                                                  </div>
                                    </div>
                        </div>
                        <div class = "col-md-6">
                                <div class="card-header">
                                        Side dishes
                                    </div>
                                    <div class="card-body"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
