@extends('adminlte::page')

@section('title', 'Dịch vụ')

@section('content_header')
    <div class="row content-header">
    <div class="row pull-right" >
        <a style="margin-right: 15px" class="btn btn-primary" href="{{route('service.create')}}" >Thêm dịch vụ mới</a>
    </div>
</div>
@endsection

@section('content')
    
    <div class="services-show">
            @if (count($services) > 0)
            <table id="table-services" width="100%" style="text-align: center !important" class="display table table-striped table-bordered .table-hover thead-dark">
                <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Tên dịch vụ</th>
                    <th width="15%">Phương thức thanh toán</th>
                    <th width="15%">Số lượng sử dụng</th>
                    <th width="10%">Giá</th>
                    <th width="35%">Mô tả</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>  
                </tr>
                </thead>
                <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td><a href="{{route('service.show', ['id' => $service->id])}}" >{{$service->id}}</a></td>
                        <td><a href="{{route('service.show', ['id' => $service->id])}}" >{{$service->name}}</a></td>
                        @php
                            if($service->payment_method == 1){
                               echo "<td>Theo tháng</td>";
                            }else if($service->payment_method == 2){
                                echo "<td>Theo ngày</td>";
                            }else{
                                echo "<td></td>";
                            }
                        @endphp
                        @php
                            if($service->use_method == 1){
                               echo "<td>Không thay đổi</td>";
                            }else if($service->use_method == 2){
                                echo "<td>Thay đổi</td>";
                            }
                        @endphp
                        <td>{{$service->price}}</td>
                        <td>{{$service->description}}</td>
                        <td><a href="{{route('service.edit', $service->id)}}" class="btn btn-primary">Sửa</a></td>
                        <td>
                            <form method="POST" action="{{route('service.destroy', ['service' => $service->id, 'resident' => $service->id])}}">
                                {{csrf_field()}}
                                <button class="btn btn-danger"type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa</button>
                                {{method_field("DELETE")}}
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tbody>
            <table>
            {{$services->links()}}
        @else
            <br>
            <h3 class="col-md-10 text-primary font-weight-bold">Hiện không có dịch vụ nào</h3>
        @endif
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#table-services').DataTable({
                "bPaginate": false
            });
        });
    </script>
@endsection