@extends('adminlte::page')

@section('content')
<div style="padding: 10px">
    <form class="form" method="POST" action="{{route('apartment.update', $apartment->id)}}">
        {{csrf_field()}}
        <div class="row">
            <label class="col-md-2"for="apartmentNameLabel">Thay đổi tên phòng </label>
            <input type="text" class="form-control col-md-10" name="name" placeholder="VD: 212" value="{{$apartment->name}}">
        </div>
        <div class="row">
                <label class="col-md-2"for="apartmentAddressLabel">Thay đổi địa chỉ phòng</label>
                <input type="text" class="form-control col-md-10" name="address" placeholder="VD: Nhà B, KTX Ngoại Ngữ" value="{{$apartment->address}}">
        </div>
        <div class="text-right">
            <button class="btn btn-primary float-right" type="submit" id="btnSubmitCreateApartment">Xác nhận thay đổi</button>
        </div>
        {{method_field('PUT')}}
    </form>
</div>
@endsection 