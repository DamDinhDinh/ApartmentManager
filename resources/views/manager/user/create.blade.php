@extends('layouts.app')

@section('content')

    <form class="form" method="POST" action="{{route('user.store')}}">
        {{csrf_field()}}
        <div class="row">
            <label class="col-md-2"for="userName">Nhập tên </label>
            <input type="text" class="form-control col-md-10" name="name" >
        </div>
        <div class="row">
                <label class="col-md-2"for="userPhoneNumber">Nhập SĐT: </label>
                <input type="tel" class="form-control col-md-10" name="phoneNumber" >
        </div>
        <div class="row">
                <label class="col-md-2"for="userEMail">Nhập email</label>
                <input type="email" class="form-control col-md-10" name="email">
        </div>
        <div class="row">
                <label style="margin: 10px 0px 0px 0px" class="col-md-2" for="userType">Phân loại</label>
                <div class="radio" style="padding: 6px 12px">
                    <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio" name="type" >Administrator</label>
                    <label style="margin: 10px 10px 0px 0px"><input value="2" type="radio" for="typeOptionRadio" name="type" >Manager</label>
                    <label style="margin: 10px 10px 0px 0px"><input value="3" type="radio" for="typeOptionRadio" name="type" checked>User</label>
                </div>
        </div>
        <div class="row">
                <label class="col-md-2"for="apartmentID">ID căn hộ: </label>
                <input type="number" class="form-control col-md-10" name="apartmentID">
        </div>
        <div class="row">
                <label class="col-md-2"for="password">Mật khẩu</label>
                <input type="password" class="form-control col-md-10" name="password" placeholder="">
        </div>
        <div class="row">
                <label class="col-md-2"for="repeatPassword">Nhập lại khẩu</label>
                <input type="password" class="form-control col-md-10" name="repeatPassword" placeholder="">
        </div>
        <div class="text-right" style="margin-top: 10px">
            <button class="btn btn-primary float-right" type="submit">Thêm người dùng</button>
        </div>
        
    </form>

@endsection 