@extends('adminlte::page')

@section('content')
<div style="padding: 10px">
    <div class="useData-control-part">
        <div style=" display: inline-block" class="row">
            <h3 style="display: inline-block" class=" text-black font-weight-bold">Lịch sử  sử dụng: </h3>
          
        </div>
        <div class="row pull-right">
            <a class="btn btn-primary" href="{{route('useData.create', ['usingService' => Route::input('usingService')])}}" >Thêm chỉ số tháng mới</a>
        </div>
    </div>
    <div class="useData-show-part">
        @if (count($useDataList) > 0)
                <div class="use-info-table">
                    <table style="text-align: center !important" class="table table-striped table-bordered .table-hover thead-dark" id="tableUseData">
                      <thead>
                      <tr>
                        <th>Mã chỉ số: </th>
                        <th>Tháng: </th>
                        <th>Chỉ số tháng trước: </th>
                        <th>Chỉ số tháng này: </th>
                        <th>Giá trị sử dụng </th>
                        <th>Trạng thái hóa đơn: </th>
                        <th>Ngày cập nhật: </th>
                        <th>{{ trans('tableLabel.edit') }}</th>
                        <th>{{ trans('tableLabel.delete') }}</th>
                      </tr>  
                    </thead>
                    <tbody>
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
                            <td><a class="btn btn-primary" href="{{route('useData.edit', ['usingService' => $useData->using_service_id, 'useData' => $useData->id])}}">{{ trans('tableLabel.edit') }}</a></td>
                            <td>
                              <form method="POST" action="{{route('useData.destroy', ['usingService' => $useData->using_service_id, 'useData' => $useData->id])}}">
                                  {{csrf_field()}}
                                  <button class="btn btn-danger"type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa</button>
                                  {{method_field("DELETE")}}
                              </form>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                    @else
                        </tbody>
                        <p>None to show</p>
                    </table>
                    @endif
        
                  </div>
    </div>
  </div>
@endsection

@section('js')
    <script type="text/javascript">
      $(document).ready(function (){
        $("#tableUseData").DataTable({
          "bPaginate": false
        });
      });
    </script>
@endsection