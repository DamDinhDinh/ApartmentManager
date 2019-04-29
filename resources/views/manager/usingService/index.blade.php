@extends('adminlte::page')

@section('title', 'Dịch vụ đang được sử dụng')

@section('content_header')
    <div class="row content-header">
        <div class="row pull-right" >
            <a style="margin-right: 15px" class="btn btn-primary" href="{{route('usingService.create')}}" >Thêm dịch vụ cho căn hộ</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="services-show-part">
            @if (count($usingServices) > 0)
            <table id="table-using-services" style="text-align: center !important" class="display table table-striped table-bordered .table-hover thead-dark">
                <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Tên dịch vụ</th>
                    <th width="15%">Căn hộ sử dụng</th>
                    <th width="15%">Phương thức thanh toán</th>
                    <th width="10%">Giá</th>
                    <th width="20%">Ngày bắt đầu</th>
                    <th width="20%">Ngày hết hạn</th>
                    {{-- <th width="5%">Sửa</th> --}}
                    <th width="5%">Hủy</th>  
                </tr>
                </thead>
                @php
                    $length = count($usingServices);
                @endphp
                <tbody>
                 @if ($length > 0)
                 @for ($i = 0; $i < $length; $i++)
                     @php
                         $service = $usingServices[$i]->service;
                     @endphp
                     <tr>
                         <td><a href="{{route('usingService.show', ['id' => $usingServices[$i]->id])}}" >{{$usingServices[$i]->id}}</a></td>
                         <td><a href="{{route('service.show', ['id' => $service->id])}}" >{{$service->name}}</a></td>
                         <td><a href="{{route('apartment.show', $usingServices[$i]->apartment_id)}}">{{$usingServices[$i]->apartment->name}}</a></td>
                         @php
                             if($service->payment_method == 1){
                                echo "<td>Theo tháng</td>";
                             }else if($service->payment_method == 2){
                                 echo "<td>Theo ngày</td>";
                             }else{
                                 echo "<td></td>";
                             }
                         @endphp
                         {{-- @php
                             if($service->use_method == 1){
                                echo "<td>Không thay đổi</td>";
                             }else if($service->use_method == 2){
                                 echo "<td>Thay đổi</td>";
                             }
                         @endphp --}}
                         <td>{{$service->price}}</td>
                         <td>{{date('d/m/Y', strtotime($usingServices[$i]->start_date))}}</td>
                         <td>{{date('d/m/Y', strtotime($usingServices[$i]->expire_date))}}</td>
                         <td>
                             <form method="POST" action="{{route('usingService.destroy', $usingServices[$i]->apartment_id)}}">
                                 {{csrf_field()}}
                                 <input type="hidden" name="apartment" value="{{$usingServices[$i]->apartment_id}}">
                                 <input type="hidden" name="usingService" value="{{$usingServices[$i]->id}}">
                                 <button class="btn btn-danger"type="submit" onclick="return confirm('Chắc chắn xóa?')">Hủy</button>
                                 {{method_field("DELETE")}}
                             </form>
                         </td>
                     </tr>
                 @endfor
                </tbody>
                <table>
                @else
                    <br>
                    <h3 class="col-md-10 text-primary font-weight-bold">Hiện không có dịch vụ nào</h3>
                @endif
            @endif
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#table-using-services').DataTable({
                "bPaginate": false
            });
        });
    </script>
@endsection