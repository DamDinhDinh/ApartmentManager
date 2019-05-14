@extends('adminlte::page')

@section('content')
<div style="padding: 10px">
    @include('manager.part.apartmentControl')
    @include('manager.part.apartmentTable')
    @include('manager.part.listUserTable')
    @include('manager.part.listServiceTable')
</div>
    
@endsection

@section('js')
   @yield('apartmentControlJS')
@endsection