@extends('layouts.app')

@section('content')
    <div class="show-apartment">
        <div class="row">
            <h3 class="col-md-2 text-black font-weight-bold">Name: </h3>
            <h3 class="col-md-10 text-primary font-weight-bold">{{$apartment->name}}</h3>
        </div>
        <div class="row">
            <h3 class="col-md-2 text-black font-weight-bold">Address: </h3>
            <h3 class="col-md-10 text-primary font-weight-bold">{{$apartment->address}}</h3>
        </div>   
    </div>
@endsection