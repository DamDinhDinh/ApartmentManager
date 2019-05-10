@extends('adminlte::page')

@section('content_header')
<div style="padding: 10px">
    <div class="head-show-part">
        <div style="display: inline-block" class="row">
            <h3 class=" text-black font-weight-bold">Thông dịch vụ đang sử  dụng: </h3>
        </div>
        <div class="row pull-right">
            <form method="POST" action="{{route('usingService.destroy', $usingService->apartment_id)}}">
                {{csrf_field()}}
                <input type="hidden" name="apartment" value="{{$usingService->apartment_id}}">
                <input type="hidden" name="usingService" value="{{$usingService->id}}">
                <button class="btn btn-danger"type="submit" onclick="return confirm('Chắc chắn xóa?')">Hủy</button>
                {{method_field("DELETE")}}
            </form>
        </div>
    </div>
</div>
@endsection

@section('content')
<div style="padding: 10px">
    <div class="show-usingService ">
        
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
            <div style="display: inline-block" class="row">
                <h3  class=" text-black font-weight-bold">Thông tin hóa đơn và số  lượng sử dụng: </h3>
            </div>
            <div style="margin-top: 15px" class="pull-right">
                <a class="btn btn-primary" href="{{route('useData.index', ['usingService' => $usingService->id])}}" >Xem lịch sử sử dụng</a>
                <a class="btn btn-primary" href="{{route('useData.create', ['usingService' => $usingService->id])}}" >Thêm chỉ số tháng mới</a>
            </div>
        </div>
        <div class="use-info-table">
            <table style="text-align: center !important" class="table table-striped table-bordered .table-hover thead-dark" id="tableDataUse">
              <thead>
                <tr>
                <th>Mã chỉ số: </th>
                <th>Tháng: </th>
                <th>Chỉ số tháng trước: </th>
                <th>Chỉ số tháng này: </th>
                <th>Giá trị sử dụng </th>
                <th>Trạng thái hóa đơn: </th>
                <th>Ngày cập nhật: </th>
              </tr>  
              </thead>
              <tbody>
              @if ($usingService->useDatas != null)
                @php
                    $useDatas = $usingService->useDatas;
                    $useDatas = $useDatas->sortByDesc('use_date');
                @endphp
                @foreach ($useDatas as $useData)
                  <tr>
                    <td><a href="{{route('useData.show', ['usingService' => $usingService->id, 'id' => $useData->id])}}">{{$useData->id}}</a></td>
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
            $('#tableDataUse').DataTable({
                "bPaginate":false
            });
        });
    </script>
@endsection