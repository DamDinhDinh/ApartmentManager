@extends('adminlte::page')

@section('content')
<div style="padding: 10px">
    <div class="row">
        <div class="col-md-6">
 <form method="POST" action="{{route('bill.update', ['bill' => $bill])}}">
        {{csrf_field()}}
        <div class="row form-group">
            <label class="col-md-3 form-label" for="userName">ID hóa đơn: </label>
            <div class="col-md-9 ">
                <input class="form-control"type="text"name="bill" value="{{$bill->id}}" readonly>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 form-label" for="userName">ID dịch vụ đang sử  dụng: </label>
            <div class="col-md-9">
                    <input type="text" class="form-control" name="usingService" value="{{$bill->using_service_id}}" readonly>
            </div>
            
        </div>
        <div class="row">
            <label class="col-md-3 form-label" for="userName">ID thông số sử dụng: </label>
            <div class="col-md-9">
                    <input type="text" class="form-control " name="useData" value="{{$bill->use_data_id}}" readonly>
                </div>
            </div>
            
        <div class="row form-group">
            <label  class="col-md-3 form-label" for="useDate">Tháng:  </label>
            <div class="col-md-9">
                    <input class="form-control  " name="useDate" type="date" value={{Carbon\Carbon::parse($bill->use_date)->format('Y-m-d')}} readonly>
            </div>
            
        </div>
        <div class="row form-group">
                <label  class="col-md-3 form-label"  for="useDate">Tên hóa đơn:  </label>
                <div class="col-md-9">
                        <input class="form-control  " name="name" type="text" value="{{$bill->name}}" readonly>
                </div>
                
            </div>
        <div class="row form-group">
            <label  class="col-md-3 form-label"  for="useValue">Số lượng sử dụng: </label>
            <div class="col-md-9">
                    <input id= "useValueInput" class="form-control " name="useValue" type="number" value="{{$bill->use_value}}" min="0" readonly>
            </div>
            
        </div>
        <div class="row form-group">
            <label   class="col-md-3 form-label"  for="useValue">Giá: </label>
            <div class="col-md-9">
                    <input id= "priceInput" class="form-control   value-input" name="price" type="number" value="{{$bill->price}}" min="0" readonly oninput="validity.valid||(value=0);" readonly>
            </div>
           
        </div>
        <div class="row form-group">
            <label  class="col-md-3 form-label"   class="col-md-3 form-label"   for="useValue">Giảm giá (%): </label>
            <div class="col-md-9">
                    <input  id= "discountInput" class="form-control   value-input" name="discount" type="number" value="{{$bill->discount}}" min="0" max="100" oninput="validity.valid||(value=0);">
            </div>
            
        </div>
        <div class="row form-group">
            <label  class="col-md-3 form-label"  for="useValue">VAT (%): </label>
            <div class="col-md-9">
                    <input id= "vatInput" class="form-control   value-input" name="vat" type="number" value="{{$bill->vat}}" min="0" max="100" oninput="validity.valid||(value=0);" >
            </div>
            
        </div>
        <div class="row form-group">
            <label  class="col-md-3 form-label"  for="useValue">Tổng: </label>
            <div class="col-md-9">
                    <input id= "sumInput" class="form-control   value-input" name="sum" type="number" value="{{$bill->sum}}" readonly>
            </div>
           
        </div>
        </div>

        <div class="col-md-6">
                <div class="row form-group">
                        <label  class="col-md-3 form-label"  for="useValue">Trạng thái: </label>
                        <div class="col-md-9">
                            @if ($bill->status == 0)
                                <div class="col-md-6">
                                        <input value="0" type="radio" for="typeOptionRadio" name="status" checked>Chưa thanh toán</label>
                                </div>
                                <div class="col-md-6">
                                        <input value="1" type="radio" for="typeOptionRadio" name="status" >Đã thanh toán</label>
                                    </div>
                               

                            @elseif($bill->status == 1)
                            <div class="col-md-6">
                                    <input value="0" type="radio" for="typeOptionRadio" name="status" >Chưa thanh toán</label>
                            </div>
                            <div class="col-md-6">
                                    <input value="1" type="radio" for="typeOptionRadio" name="status" checked>Đã thanh toán</label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 form-label"  class=" "for="userName">Tên người thanh toán: </label>
                        <div class="col-md-9">
                            @if ($bill->user_name != null)
                                <input type="text" class="form-control  " name="user_name" oninput="validity.valid||(value='');" value="{{$bill->user_name}}">
                            @else
                                {{ trans('tableLabel.bill_not_paid_yet') }}
                            @endif
                           
                        </div>
                       
                    </div>
                    <div class="row form-group">
                        <label  class="col-md-3 form-label" class=" " for="useValue">Hình thức thanh toán: </label>
                        <div class="col-md-9">
                            @if ($bill->paid_method == 1)
                            <div class="col-md-6">
                                    <input value="1" type="radio" for="typeOptionRadio" name="paid_method" checked>Tiền mặt</label>
                            </div>
                            <div class="col-md-6">
                                    <input value="2" type="radio" for="typeOptionRadio" name="paid_method" >Thẻ tín dụng/Ví điện tử</label>
                                </div>
                                   
                                    
                            @elseif($bill->paid_method ==2)
                            <div class="col-md-6">
                                    <input value="1" type="radio" for="typeOptionRadio" name="paid_method" >Tiền mặt</label>
                            </div>
                            <div class="col-md-6">
                                    <input value="2" type="radio" for="typeOptionRadio" name="paid_method" checked>Thẻ tín dụng/Ví điện tử</label>
                                </div>
                            @else
                            <div class="col-md-6">
                                    <input value="1" type="radio" for="typeOptionRadio" name="paid_method" >Tiền mặt</label>
                            </div>
                            <div class="col-md-6">
                                    <input value="2" type="radio" for="typeOptionRadio" name="paid_method" >Thẻ tín dụng/Ví điện tử</label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                            <label  class="col-md-3 form-label"class=" " for="useDate">Ngày thanh toán: </label>
                            <div class="col-md-9">
                                    <input class="form-control  " name="paid_date" type="date" value="{{Carbon\Carbon::parse($bill->paid_date != null ? $bill->paid_date : time())->format('Y-m-d')}}">
                            </div>
                            
                        </div>
                    <div class="text-right" style="margin-top: 10px">
                        <button class="btn btn-primary float-right" type="submit">Cập nhật hóa đơn</button>
                    </div>
                    @method('PUT')
                </form>
        </div>
    </div>
   
       
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