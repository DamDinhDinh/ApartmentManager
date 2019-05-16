<div class="paid-bill">
    <div class="col-md-6">
        <table style="text-align: center !important" class="table table-striped table-hover thead-dark">
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_id') }}</th>
                <td width="70%">{{$bill->id}}</td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_name') }}</th>
                <td width="70%">{{$bill->name}}</td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.use_data_value') }}</th>
                <td width="70%">{{$bill->useData->use_value}}</td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.use_data_date') }}</th>
                <td width="70%">{{$bill->useData->use_date}}</td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.service_price') }}</th>
                <td width="70%">{{$bill->price}}</td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_discount') }}</th>
                <td width="70%">{{$bill->discount}}</td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_vat') }}</th>
                <td width="70%">{{$bill->vat}}</td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_sum') }}</th>
                <td width="70%">{{$bill->sum}}</td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_status') }}</th>
                <td width="70%">
                    @php
                        if($bill->status == 0){
                            echo trans('tableLabel.bill_not_paid_yet');
                        }else if($bill->status == 1){
                            echo trans('tableLabel.bill_paid');
                        }
                    @endphp
                    </td>
                </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_updated_at') }}</th>
                <td width="70%">{{$bill->updated_at}}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6 ">
        <form class="form" method="POST" action="{{route('bill.paid', ['bill' => $bill])}}">
            {{csrf_field()}}
            <div class="row form-group">
                <label class="col-md-2" for="useValue">Trạng thái: </label>
                <div class="radio" style="padding: 6px 12px">
                    @if ($bill->status == 0)
                    <label style="margin: 10px 10px 0px 0px"><input value="0" type="radio" for="typeOptionRadio"
                            name="status" checked>Chưa thanh toán</label>
                    <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio"
                            name="status">Đã thanh toán</label>
                    @elseif($bill->status == 1)
                    <label style="margin: 10px 10px 0px 0px"><input value="0" type="radio" for="typeOptionRadio"
                            name="status">Chưa thanh toán</label>
                    <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio"
                            name="status" checked>Đã thanh toán</label>
                    @endif
                </div>
            </div>
            <div class="row">
                <label class="col-md-2" for="userName">Tên người thanh toán: </label>
                <input type="text" class="form-control col-md-10" name="user_name" oninput="validity.valid||(value='');"
                    value="{{$bill->user_name}}">
            </div>
            <div class="row form-group">
                <label class="col-md-2" for="useValue">Hình thức thanh toán: </label>
                <div class="radio" style="padding: 6px 12px">
                    @if ($bill->paid_method == 1)
                    <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio"
                            name="paid_method" checked>Tiền mặt</label>
                    <label style="margin: 10px 10px 0px 0px"><input value="2" type="radio" for="typeOptionRadio"
                            name="paid_method">Thẻ tín dụng/Ví điện tử</label>
                    @elseif($bill->paid_method ==2)
                    <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio"
                            name="paid_method">Tiền mặt</label>
                    <label style="margin: 10px 10px 0px 0px"><input value="2" type="radio" for="typeOptionRadio"
                            name="paid_method" checked>Thẻ tín dụng/Ví điện tử</label>
                    @else
                    <label style="margin: 10px 10px 0px 0px"><input value="1" type="radio" for="typeOptionRadio"
                            name="paid_method">Tiền mặt</label>
                    <label style="margin: 10px 10px 0px 0px"><input value="2" type="radio" for="typeOptionRadio"
                            name="paid_method">Thẻ tín dụng/Ví điện tử</label>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-2" class="col-md-2" for="useDate">Ngày thanh toán: </label>
                <input class="form-control col-md-10" name="paid_date" type="date"
                    value="{{Carbon\Carbon::parse($bill->paid_date != null ? $bill->paid_date : time())->format('Y-m-d')}}">
            </div>
            <div class="text-right" style="margin-top: 10px">
                <button class="btn btn-primary float-right" type="submit">Cập nhật thanh toán</button>
            </div>
            @method('PUT')
        </form>
    </div>
</div>