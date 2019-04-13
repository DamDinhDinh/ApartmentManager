@extends('layouts.app')

@section('content')
    <div class="show-service ">
        <div class="head-show-part">
            <div class="row">
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông dịch vụ: </h3>
            </div>
        </div>
        <div class="service-info-table">
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                <tr>
                    <th width="30%">ID dịch vụ: </th>
                    <td width="70%">{{$service->id}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Tên dịch vụ: </th>
                    <td width="70%">{{$service->name}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Giá tiền: </th>
                    <td width="70%">{{$service->price}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Loại: </th>
                    @php
                        if($service->type == 1){
                            echo "<td width='70%''>Mặc định</td>";
                        }else if($service->type == 2){
                            echo "<td width='70%''>Tùy chọn</td>";
                        }else{
                            echo "<td></td>";
                        }
                    @endphp
                </tr>
                <tr>
                    <th width="30%">Phương thức thanh toán: </th>
                    @php
                        if($service->payment_method == 1){
                            echo "<td width='70%''>Theo tháng</td>";
                        }else if($service->payment_method == 2){
                            echo "<td width='70%''>Theo ngày</td>";
                        }else{
                            echo "<td></td>";
                        }
                    @endphp
                </tr>
                <tr>
                    <th width="30%">Số lượng sử dụng: </th>
                    @php
                        if($service->use_method == 1){
                            echo "<td width='70%'>Không thay đổi</td>";
                        }else if($service->use_method == 2){
                            echo "<td width='70%'>Thay đổi</td>";
                        }else{
                            echo "<td></td>";
                        }
                    @endphp
                </tr>
                <tr>
                    <th width="30%">Mô tả: </th>
                    <td width="70%">{{$service->description}}</a></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="apartment-usingservice-info">
        <div class="head-show-part">
            <div class="row">
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông các căn hộ đang sử dụng dịch vụ: </h3>
            </div>
        </div>
        <div class="service-info-table">
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                {{-- @if ($service->apartment != null)
                @php
                    $apartment = $service->apartment;
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