@extends('adminlte::page')

@section('content')
<div style="padding:10px">
    @include('manager.part.notification.editNotification')
</div>
   
@endsection

@section('js')
    @yield('editNotificationJS')
@endsection