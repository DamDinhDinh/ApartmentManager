@extends('adminlte::page')

@section('content')
<div style="padding: 10px">
    @include('manager.part.bill.createBill')
</div>
@endsection 

@section('js')  
    @yield('createBillJS')
@endsection