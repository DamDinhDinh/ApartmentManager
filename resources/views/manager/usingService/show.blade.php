@extends('layouts.app')

@section('content')
    <div class="show-usingService ">
        <div class="head-show-part">
            <div class="row">
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông dịch vụ đang sử  dụng: </h3>
            </div>
        </div>
        <div class="usingService-info-table">
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                <tr>
                    <th width="30%">ID dịch vụ đang sử dụng: </th>
                    <td width="70%">{{$usingService->id}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Tên dịch vụ: </th>
                    <td width="70%">{{$usingService->service->name}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Phòng sử dụng: </th>
                    <td width="70%">{{$usingService->apartment->name}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Giá tiền: </th>
                    <td width="70%">{{$usingService->service->price}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Phương thức thanh toán: </th>
                    @php
                        if($usingService->service->payment_method == 1){
                            echo "<td width='70%''>Theo tháng</td>";
                        }else if($usingService->service->payment_method == 2){
                            echo "<td width='70%''>Theo ngày</td>";
                        }else{
                            echo "<td></td>";
                        }
                    @endphp
                </tr>
                <tr>
                    <th width="30%">Số lượng sử dụng: </th>
                    @php
                        if($usingService->service->use_method == 1){
                            echo "<td width='70%'>Không thay đổi</td>";
                        }else if($usingService->service->use_method == 2){
                            echo "<td width='70%'>Thay đổi</td>";
                        }else{
                            echo "<td></td>";
                        }
                    @endphp
                </tr>
            
            </table>
        </div>
    </div>
    <div class="usingService-bill-info">
        <div class="head-show-part">
            <div class="row">
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông tin hóa đơn và số  lượng sử dụng: </h3>
            </div>
        </div>
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
              
              @if ($usingService->useDatas != null)
                @php
                    $useDatas = $usingService->useDatas;
                    $useDatas = $useDatas->sortByDesc('use_date');
                @endphp
                @foreach ($useDatas as $useData)
                  <tr>
                    <td><a href="{{route('useData.index', ['usingService' => $usingService->id])}}">{{$useData->id}}</a></td>
                    <td>{{Carbon\Carbon::parse($useData->use_date)->format('m-Y')}}</td>
                    <td>{{$useData->prevMonthValue()}}</td>
                    <td>{{$useData->use_value}}</td>
                    <td>
                      @php
                          if($usingService->service->use_method == 1){
                            echo $useData->use_value;
                          }else if ($usingService->service->use_method == 2){
                            $value = $useData->use_value - $useData->prevMonthValue();
                            echo $value;
                          }

                      @endphp
                    </td>
                    <td>{{$useData->bill != null ? $useData->bill->status : "Chưa có hóa đơn"}}
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