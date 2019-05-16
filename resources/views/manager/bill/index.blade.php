@extends('adminlte::page')

@section('content')
<div style="padding:10px">
    @include('manager.part.bill.listBillControl')
    @include('manager.part.bill.listBillTable')
</div>
@endsection

@section('js')
    @yield('listBillControlJS')
    @yield('listBillTableJS')
@endsection