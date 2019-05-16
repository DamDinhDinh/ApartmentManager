@extends('adminlte::page')

@section('content')
<div style="padding:10px">
    @include('manager.part.notification.notificationControl')
    @include('manager.part.notification.showNotification')
</div> 
    
@endsection

@section('js')
    @yield('showNotificationJS')
    @yield('notificationControlJS')
@endsection