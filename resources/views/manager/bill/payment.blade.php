@extends('adminlte::page')

@section('content')
<div style="padding: 10px">
    <form class="form" method="POST" action="{{route('bill.paid', ['usingService' => Route::input('usingService'), 'useData' => Route::input('useData'), 'bill' => $bill])}}">
        {{csrf_field()}}
        <div class="row">
            <label class="col-md-2" for="userName">ID hóa đơn: </label>
            <input type="text" class="form-control col-md-10" name="bill" value="{{Route::input('bill')}}" readonly>
        </div>
        <div class="row">
            <label class="col-md-2" for="userName">ID dịch vụ đang sử  dụng: </label>
            <input type="text" class="form-control col-md-10" name="usingService" value="{{Route::input('usingService')}}" readonly>
        </div>
        <div class="row">
            <label class="col-md-2"for="userName">ID số lượng sử dụng: </label>
            <input type="text" class="form-control col-md-10" name="useData" value="{{Route::input('useData')}}" readonly>
        </div>
        <div class="row form-group">
            <label class="col-md-2" for="useDate">Tháng:  </label>
            <input class="form-control col-md-10" name="useDate" type="date" value={{Carbon\Carbon::parse($useData->use_date)->format('Y-m-d')}} readonly>
        </div>
        <div class="row form-group">
                <label class="col-md-2" for="useDate">Tên hóa đơn:  </label>
                <input class="form-control col-md-10" name="name" type="text" value="HÓA ĐƠN DỊCH VỤ {{$usingService->service->name}} PHÒNG {{$usingService->apartment->name}} THÁNG {{Carbon\Carbon::parse($useData->use_date)->format('m-Y')}}" readonly>
            </div>
        <div class="row form-group">
            <label class="col-md-2" for="useValue">Số lượng sử dụng: </label>
            <input id= "useValueInput" class="form-control col-md-10 value-input" name="useValue" type="number" value="{{$useData->use_value}}" min="0" readonly>
        </div>
        <div class="row form-group">
            <label  class="col-md-2" for="useValue">Giá: </label>
            <input id= "priceInput" class="form-control col-md-10 value-input" name="price" type="number" value="{{$usingService->service->price}}" min="0" readonly oninput="validity.valid||(value=0);" readonly>
        </div>
        <div class="row form-group">
            <label  class="col-md-2" for="useValue">Giảm giá (%): </label>
            <input  id= "discountInput" class="form-control col-md-10 value-input" name="discount" type="number" value="0" min="0" max="100" oninput="validity.valid||(value=0);" readonly>
        </div>
        <div class="row form-group">
            <label  class="col-md-2" for="useValue">VAT (%): </label>
            <input id= "vatInput" class="form-control col-md-10 value-input" name="vat" type="number" value="0" min="0" max="100" oninput="validity.valid||(value=0);" readonly>
        </div>
        @php
            $num = $useData->use_value;
            $price = $usingService->service->price;
            $cost = $num * $price;
        @endphp
        <div class="row form-group">
            <label  class="col-md-2" for="useValue">Tổng: </label>
            <input id= "sumInput" class="form-control col-md-10 value-input" name="sum" type="number" value="{{$cost}}" readonly>
        </div>
        <div class="row form-group">
            <label  class="col-md-2" for="useValue">Trạng thái: </label>
            <div class="radio" style="padding: 6px 12px">
                <label style="margin: 10px 10px 0px 0px"><input value="0" type="radio" for="typeOptionRadio" name="status" checked>Chưa thanh toán</label>
                <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio" name="status" >Đã thanh toán</label>
            </div>
        </div>
        <div class="row">
            <label class="col-md-2"for="userName">Tên người thanh toán: </label>
            <input type="text" class="form-control col-md-10" name="user_name" oninput="validity.valid||(value='');">
        </div>
        <div class="row form-group">
            <label class="col-md-2" for="useValue">Hình thức thanh toán: </label>
            <div class="radio" style="padding: 6px 12px">
                <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio" name="paid_method" >Tiền mặt</label>
                <label style="margin: 10px 10px 0px 0px"><input value="2" type="radio" for="typeOptionRadio" name="paid_method" >Thẻ tín dụng/Ví điện tử</label>
            </div>
        </div>
        <div class="row form-group">
                <label class="col-md-2" class="col-md-2" for="useDate">Ngày thanh toán: </label>
                <input class="form-control col-md-10" name="paid_date" type="date" value="{{date("Y-m-d", time())}}">
            </div>
        <div class="text-right" style="margin-top: 10px">
            <button class="btn btn-primary float-right" type="submit">Cập nhật thanh toán</button>
        </div>
        @method('PUT')
    </form>
</div>
@endsection 

@section('js')
    <script type="text/javascript">
        $(".value-input").change( function (){
            useValue = $("#useValueInput").val();
            price = $("#priceInput").val();
            discount = $("#discountInput").val();
            vat = $("#vatInput").val();

            sum = useValue * price;
            sum -= sum * discount/100;
            sum += sum * vat/100;

            $('#sumInput').val(sum);
        });
    </script>
@endsection