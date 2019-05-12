@extends('adminlte::page')

@section('content_header')
<div style="padding: 10px">
    <div style="display: inline-block" class="head-show-part">
            <h3 class=" text-black font-weight-bold">Thông dịch vụ: </h3>
    </div>
    <div class="row pull-right">
        <a href="{{route('service.edit', $service->id)}}" class="btn btn-primary">Sửa</a>
    </div>
</div>
@endsection

@section('content')
<div style="padding: 10px">
    <div class="show-service ">
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
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Danh sách các căn hộ đang sử dụng dịch vụ: </h3>
            </div>
        </div>
        <div class="apartment-info-table">
                <table id="table-apartments" style="text-align: center !important" width="100%" class=" table table-striped table-bordered .table-hover thead-dark">
                        <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="20%">Apartment</th>
                            <th width="50%">Address</th>
                            <th width="10%">Edit</th>
                            <th width="10%">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($service->usingServices != null)
                            @php
                                $usingServices = $service->usingServices;
                            @endphp
                            @foreach ($usingServices as $usingService)
                            @if ($usingService->apartment != null)
                                    @php
                                        $apartment = $usingService->apartment;
                                    @endphp
                                    <tr>
                                            <td><a href="{{route('apartment.show', ['id' => $apartment->id])}}" >{{$apartment->id}}</a></td>
                                            <td><a href="{{route('apartment.show', ['id' => $apartment->id])}}" >{{$apartment->name}}</a></td>
                                            <td>{{$apartment->address}}</td>
                                            {{-- <td><button class="btn btn-primary btn-modal" type="button" data-toggle="modal" data-target="#addResidentModal" onclick="editModal({{json_encode($apartment)}})">Sửa</button></td> --}}
                                            <td><a href="{{route('apartment.edit', $apartment->id)}}" class="btn btn-primary">Sửa</a></td>
                                            <td>
                                                <form method="POST" action="{{route('apartment.destroy', $apartment->id)}}">
                                                    {{csrf_field()}}
                                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa</button>
                                                    {{method_field("DELETE")}}
                                                </form>
                                            </td>
                                        </tr>
                                @endif
                            @endforeach
                        </tbody>
                        </table>
                        {{-- {{$usingServices->links()}}   --}}
                            @else
                            </tbody>
                            </table>
                                <p>None to show.</p>
                            @endif

                
        </div>
    </div>
</div>
@endsection