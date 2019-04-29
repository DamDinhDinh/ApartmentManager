@extends('adminlte::page')

@section('content')
<div style="padding: 10px">
    <form class="form" method="POST" action="{{route('apartment.store')}}">
        {{csrf_field()}}
        <div class="row">
            <label class="col-md-2"for="apartmentNameLabel">Nhập tên phòng</label>
            <input type="text" class="form-control col-md-10" name="name" placeholder="VD: 212">
        </div>
        <div class="row">
                <label class="col-md-2"for="apartmentAddressLabel">Nhập địa chỉ phòng</label>
                <input type="text" class="form-control col-md-10" name="address" placeholder="VD: Nhà B, KTX Ngoại Ngữ">
        </div>
        <div class="text-right" style="margin-top: 10px">
            <button class="btn btn-primary float-right" type="submit" id="btnSubmitCreateApartment">Thêm căn hộ</button>
        </div>
    </form>
</div>
@endsection 