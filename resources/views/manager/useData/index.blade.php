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
                        <th>Hóa đơn: </th>
                      </tr>  
                        @foreach ($useDataList as $useData)
                          <tr>
                            <td>{{$useData->id}}</td>
                            <td>{{Carbon\Carbon::parse($useData->use_date)->format('m-Y')}}</td>
                            <td>{{$useData->prevMonthValue()}}</td>
                            <td>{{$useData->use_value}}</td>
                            <td>
                              @php
                                  if($useData->usingService->service->use_method == 1){
                                    echo $useData->use_value;
                                  }else if ($useData->usingService->service->use_method == 2){
                                    $value = $useData->use_value - $useData->prevMonthValue();
                                    echo $value;
                                  }
        
                              @endphp
                            </td>
                            <td>{{$useData->bill != null ? $useData->bill->status : "Chưa có hóa đơn"}}
                            <td>{{Carbon\Carbon::parse($useData->created_at)->format('d-m-Y')}}</td>
                            <td><a href="{{route('bill.create', ['usingService' => Route::input('usingService'), 'useData' => $useData->id])}}">Create</a></td>
                          </tr>
                        @endforeach
                    @else
                        <p>None to show</p>
                    </table>
                    @endif
        
                  </div>
    </div>
@endsection