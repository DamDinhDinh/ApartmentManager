@extends('adminlte::page')

@section('content')
<div style="padding:10px">
    @include('manager.part.notification.createNotification')
</div>
   
@endsection

@section('js')
    @yield('craeteNotificationJS')
@endsection