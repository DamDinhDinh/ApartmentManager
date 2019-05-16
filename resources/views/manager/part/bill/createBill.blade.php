<div class="row">
        <div class="col-md-6">
 <form method="POST" action="{{route('bill.store')}}">
        {{csrf_field()}}
        <div class="row form-group">
            <label class="col-md-3 form-label" for="userName">ID dịch vụ đang sử  dụng: </label>
            <div class="col-md-9">
                    <input type="text" class="form-control" name="usingService" value="{{$usingService->id}}" readonly>
            </div>
            
        </div>
        <div class="row">
            <label class="col-md-3 form-label" for="userName">ID thông số sử dụng: </label>
            <div class="col-md-9">
                    <input type="text" class="form-control " name="useData" value="{{$useData->id}}" readonly>
                </div>
            </div>
            
        <div class="row form-group">
            <label  class="col-md-3 form-label" for="useDate">Tháng:  </label>
            <div class="col-md-9">
                    <input class="form-control  " name="useDate" type="date" value={{Carbon\Carbon::parse($useData->use_date)->format('Y-m-d')}} readonly>
            </div>
            
        </div>
        <div class="row form-group">
                <label  class="col-md-3 form-label"  for="useDate">Tên hóa đơn:  </label>
                <div class="col-md-9">
                        <input class="form-control col-md-10" name="name" type="text" value="HÓA ĐƠN DỊCH VỤ {{$usingService->service->name}} PHÒNG {{$usingService->apartment->name}} THÁNG {{Carbon\Carbon::parse($useData->use_date)->format('m-Y')}}" >
                </div>
                
            </div>
        <div class="row form-group">
            <label  class="col-md-3 form-label"  for="useValue">Số lượng sử dụng: </label>
            <div class="col-md-9">
                    <input id= "useValueInput" class="form-control " name="useValue" type="number" value="{{$useData->use_value}}" min="0" readonly>
            </div>
            
        </div>
        <div class="row form-group">
            <label   class="col-md-3 form-label"  for="useValue">Giá: </label>
            <div class="col-md-9">
                    <input id= "priceInput" class="form-control   value-input" name="price" type="number" value="{{$usingService->service->price}}" min="0" readonly oninput="validity.valid||(value=0);" readonly>
            </div>
           
        </div>
        <div class="row form-group">
            <label  class="col-md-3 form-label"   class="col-md-3 form-label"   for="useValue">Giảm giá (%): </label>
            <div class="col-md-9">
                    <input  id= "discountInput" class="form-control   value-input" name="discount" type="number" value="0" min="0" max="100" oninput="validity.valid||(value=0);">
            </div>
            
        </div>
        <div class="row form-group">
            <label  class="col-md-3 form-label"  for="useValue">VAT (%): </label>
            <div class="col-md-9">
                    <input id= "vatInput" class="form-control value-input" name="vat" type="number" value="0" min="0" max="100" oninput="validity.valid||(value=0);" >
            </div>
            
        </div>
        @php
            $num = $useData->use_value;
            $price = $usingService->service->price;
            $cost = $num * $price;
        @endphp
        <div class="row form-group">
            <label  class="col-md-3 form-label"  for="useValue">Tổng: </label>
            <div class="col-md-9">
                    <input id= "sumInput" class="form-control   value-input" value="{{$cost}}" name="sum" type="number" readonly>
            </div>
           
        </div>
        </div>

        <div class="col-md-6">
                <div class="row form-group">
                        <label  class="col-md-3 form-label"  for="useValue">Trạng thái: </label>
                        <div class="col-md-9">
                            <div class="col-md-6">
                                    <input value="0" type="radio" for="typeOptionRadio" name="status" checked>Chưa thanh toán</label>
                                </div>
                            <div class="col-md-6">
                                    <input value="1" type="radio" for="typeOptionRadio" name="status" >Đã thanh toán</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 form-label"  class=" "for="userName">Tên người thanh toán: </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control  " name="user_name">
                        </div>
                       
                    </div>
                    <div class="row form-group">
                        <label  class="col-md-3 form-label" class=" " for="useValue">Hình thức thanh toán: </label>
                        <div class="col-md-9">
                            <div class="col-md-6">
                                    <input value="1" type="radio" for="typeOptionRadio" name="paid_method" >Tiền mặt</label>
                            </div>
                            <div class="col-md-6">
                                    <input value="2" type="radio" for="typeOptionRadio" name="paid_method" >Thẻ tín dụng/Ví điện tử</label>
                                </div>
                        </div>
                    </div>
                    <div class="row form-group">
                            <label  class="col-md-3 form-label"class=" " for="useDate">Ngày thanh toán: </label>
                            <div class="col-md-9">
                                    <input class="form-control  " name="paid_date" type="date" value="{{Carbon\Carbon::parse(time())->format('Y-m-d')}}">
                            </div>
                            
                        </div>
                    <div class="text-right" style="margin-top: 10px">
                        <button class="btn btn-primary float-right" type="submit">{{ trans('buttonName.add') }}</button>
                    </div>
                </form>
        </div>
</div>

@section('createBillJS')
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