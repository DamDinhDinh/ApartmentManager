@extends('adminlte::page')

@section('content_header')
    
@endsection

@section('content')
<div style="padding: 10px">
    <div class="col-md-6 useDataa-info-table">
        <table style="text-align: center !important" class="table table-striped table-bordered .table-hover thead-dark">
            <tr>
                <th width="30%">Mã chỉ số: </th>
                <td width="70%">{{$useData->id}}</a></td>
            </tr>
            <tr>
                <th width="30%">Tháng: </th>
                <td width="70%">{{Carbon\Carbon::parse($useData->use_date)->format('m-Y')}}</a></td>
            </tr>
            <tr>
                <th width="30%">Chỉ số tháng trước: </th>
                <td width="70%">{{$useData->prevMonthValue()}}</a></td>
            </tr>
            <tr>
                <th width="30%">Chỉ số tháng này:</th>
                <td width="70%">{{$useData->use_value_curr}}</a></td>
            </tr>
            <tr>
                <th width="30%">Giá trị sử dụng  </th>
                <td width="70%">{{$useData->use_value}}</a></td>
            </tr>
            <tr>
                <th width="30%">Trạng thái hóa đơn </th>

                @php
                if($useData->bill == null){
                  echo "<td><a href=" . route('bill.create', ['usingService' => Route::input('usingService'), 'useData' => $useData->id]) .">Tạo hóa đơn</a></td>";
                }else{
                  if($useData->bill->status == 0){
                    echo "<td><a href=" . route('bill.payment', ['usingService' => Route::input('usingService'), 'useData' => $useData->id, 'bill' => $useData->bill->id]) .">Thanh toán</a></td>";
                  }else{
                    echo "<td>Đã thanh toán</td>";
                  }
                }
            @endphp
            </tr>
            <tr>
                <th width="30%">Ngày cập nhật: </th>
                <td width="70%">{{Carbon\Carbon::parse($useData->created_at)->format('d-m-Y')}}</a></td>
            </tr>
        </table>
    </div>
</div>
@endsection

@section('js')
    
@endsection