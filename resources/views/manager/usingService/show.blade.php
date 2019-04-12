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
        <div class="usingService-info-table">
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                {{-- @if ($usingService->apartment != null)
                @php
                    $apartment = $usingService->apartment;
                @endphp
                <tr>
                    <th width="30%">ID căn hộ: </th>
                    <td width="70%"><a href="{{route('apartment.show', ['id' => $apartment->id])}}" >{{$apartment->id}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Tên căn hộ: </th>
                    <td width="70%"><a href="{{route('apartment.show', ['id' => $apartment->id])}}" >{{$apartment->name}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Địa chỉ: </th>
                    <td width="70%">{{$apartment->address}}</a></td>
                </tr>
            </table>
            @else --}}
                <tr>
                    <th width="30%">ID căn hộ: </th>
                    <td width="70%">NULL</a></td>
                </tr>
            </table>
            {{-- @endif --}}

        </div>
    </div>
@endsection