@extends('adminlte::page')

@section('content')
<div style="padding:10px">
    @include('manager.part.notification.listControl')
    @include('manager.part.notification.listNotificationTable')
</div>
@endsection

@section('js')
    @yield('listNotificationTableJS')
    @yield('notificationControlJS')
@endsection