@extends('layouts.app')

@section('content')

    <form class="form" method="POST" action="{{route('service.store')}}">
        {{csrf_field()}}
        <div class="row">
            <label class="col-md-2"for="serviceName">Nhập tên dịch vụ: </label>
            <input type="text" class="form-control col-md-10" name="name" >
        </div>
        <div class="row">
            <label class="col-md-2"for="servicePrice">Giá tiền: </label>
            <input type="number" class="form-control col-md-10" name="price" >
				</div>
				
				<div class="row">
          <label style="margin: 10px 0px 0px 0px" class="col-md-2" for="serviceType">Loại dịch vụ: </label>
          <div class="radio" style="padding: 6px 12px">
            <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio" name="type" >Mặc định</label>
            <label style="margin: 10px 10px 0px 0px"><input value="2" type="radio" for="typeOptionRadio" name="type" >Tùy chọn</label>
          </div>
        </div>

        <div class="row">
          <label style="margin: 10px 0px 0px 0px" class="col-md-2" for="serviceType">Phương thức thanh toán: </label>
          <div class="radio" style="padding: 6px 12px">
            <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio" name="payment_method" >Theo tháng</label>
            <label style="margin: 10px 10px 0px 0px"><input value="2" type="radio" for="typeOptionRadio" name="payment_method" >Theo ngày</label>
            {{-- <label style="margin: 10px 10px 0px 0px"><input value="3" type="radio" for="typeOptionRadio" name="type" checked>service</label> --}}
          </div>
        </div>
        <div class="row">
            <label style="margin: 10px 0px 0px 0px" class="col-md-2" for="serviceType">Số lượng sử dụng: </label>
            <div class="radio" style="padding: 6px 12px">
                <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio" name="use_method" >Không thay đổi</label>
                <label style="margin: 10px 10px 0px 0px"><input value="2" type="radio" for="typeOptionRadio" name="use_method" >Thay đổi</label>
            </div>
        </div>
        <div class="form-group from-control">
            <div class="row">
                <label class="col-md-2 control-label"for="serviceDescription">Mô tả: </label>
                <textarea class="col-md-10 form-control" rows="5" name="description"></textarea>
            </div>
        </div>
        <div class="text-right" style="margin-top: 10px">
            <button class="btn btn-primary float-right" type="submit" >Thêm dịch vụ</button>
        </div>
        

        
    </form>

@endsection 