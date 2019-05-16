@extends('adminlte::page')

@section('content')
<div style="padding: 10px">
    @include('manager.part.bill.billControl')
    @include('manager.part.bill.billShow')
</div>
@endsection

@section('js')
    @yield('billControlJS')
    @yield('billShowJS')
@endsection