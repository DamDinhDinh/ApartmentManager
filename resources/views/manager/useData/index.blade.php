@extends('layouts.app')

@section('content')
    <div class="useData-control-part">
        <div class="row">
            <h3 style="margin: 22px" class=" text-black font-weight-bold">Lịch sử  sử dụng: </h3>
            <a style="margin: 22px" class="btn btn-primary" href="{{route('useData.create', ['usingService' => Route::input('usingService')])}}" >Thêm chỉ số tháng mới</a>
        </div>
    </div>
    <div class="useData-show-part">
        @if (count($useDataList) > 0)
                <div class="use-info-table">
                    <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                      <tr>
                        <th>Mã chỉ số: </th>
                        <th>Tháng: </th>
                        <th>Chỉ số tháng trước: </th>
                        <th>Chỉ số tháng này: </th>
                        <th>Giá trị sử dụng </th>
                        <th>Trạng thái hóa đơn: </th>
                        <th>Ngày cập nhật: </th>
                      </tr>  
                        @foreach ($useDataList as $useData)
                          <tr>
                            <td>{{$useData->id}}</td>
                            <td>{{Carbon\Carbon::parse($useData->use_date)->format('m-Y')}}</td>
                            <td>{{$useData->prevMonthValue()}}</td>
                            <td>{{$useData->use_value_curr}}</td>
                            <td>{{$useData->use_value}}</td>
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
                            <td>{{Carbon\Carbon::parse($useData->created_at)->format('d-m-Y')}}</td>
                            
                          </tr>
                        @endforeach
                    @else
                        <p>None to show</p>
                    </table>
                    @endif
        
                  </div>
    </div>
@endsection