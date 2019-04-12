@extends('layouts.app')

@section('content')

<div class="resident-apartment-info">
        <div class="head-show-part">
            <div class="row">
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông tin căn hộ: </h3>
                <a style="margin: 22px" href="{{route('apartment.edit', $apartment->id)}}" class="btn btn-warning">Sửa thông tin</a>
                <form method="POST" action="{{route('apartment.destroy', $apartment->id)}}">
                    {{csrf_field()}}
                    <button style="margin: 22px" class="btn btn-danger" type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa căn hộ</button>
                    {{method_field("DELETE")}}
                </form>
            </div>
        </div>
        <div class="apartment-info-table">
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                <tr>
                    <th width="30%">ID: </th>
                    <td width="70%">{{$apartment->id}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Name: </th>
                    <td width="70%">{{$apartment->name}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Address: </th>
                    <td width="70%">{{$apartment->address}}</a></td>
                </tr>
            </table>
        </div>
    <div class="show-user ">
        <div class="head-show-part">
            <div class="row">
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông tin người dùng: </h3>
               <!-- Button to Open the Modal -->
                <button  style="margin: 22px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addResidentModal">
                    Thêm cư dân
                </button>
            </div>
        </div>
        <div class="user-info-table">
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Name</th>
                    <th width="20%">Email</th>
                    <th width="20%">Phone Number</th>
                    <th width="10%">Type</th>
                    <th width="10%">Move</th>
                    <th width="10%">Delete</th>  
                </tr>
                @if (count($apartment->users) > 0)
                @php
                    $users = $apartment->users;
                @endphp
                @foreach ($users as $user)
                <tr>
                    <td><a href="{{route('user.show', ['id' => $user->id])}}" >{{$user->id}}</a></td>
                    <td><a href="{{route('user.show', ['id' => $user->id])}}" >{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone_number}}</td>
                    <td>{{$user->type}}</td>
                    <td><a href="" class="btn btn-warning">Move</a></td>
                    <td>
                        <form method="POST" action="{{route('resident.destroy', $apartment->id)}}">
                            {{csrf_field()}}
                            <input type="hidden" name="apartment" value="{{$apartment->id}}">
                            <input type="hidden" name="resident" value="{{$user->id}}">
                            <button class="btn btn-danger"type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa</button>
                            {{method_field("DELETE")}}
                        </form>
                    </td>
                </tr>
                @endforeach 
            </table>
                @else
            </table>
                    <h3 class="col-md-10 text-primary font-weight-bold">Hiện không có cư dân nào</h3>
                @endif
        </div>
    </div>
    <div class="show-service">
        <div class="head-show-part">
            <div class="row">
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông tin dịch vụ: </h3>
                
                <!-- Button to Open the Modal -->
                <button  style="margin: 22px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addServiceModal">
                Thêm dịch vụ
                </button>
            </div> <!-- end div row -->

            
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">Tên dịch vụ</th>
                    <th width="10%">Phương thức thanh toán</th>
                    <th width="10%">Số lượng sử dụng</th>
                    <th width="10%">Giá</th>
                    <th width="20%">Ngày bắt đầu</th>
                    <th width="20%">Ngày hết hạn</th>
                    <th width="5%">Hủy dịch vụ</th>  
                </tr>
                @php
                    $usingServices = $apartment->usingServices;
                    $length = count($usingServices);
                @endphp
                @if ($length > 0)
                @for ($i = 0; $i < $length; $i++)
                    @php
                        $service = $usingServices[$i]->service;
                    @endphp
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
                        <td>{{date('d/m/Y', strtotime($usingServices[$i]->start_date))}}</td>
                        <td>{{date('d/m/Y', strtotime($usingServices[$i]->expire_date))}}</td>
                        <td>
                            <form method="POST" action="{{route('usingService.destroy', $apartment->id)}}">
                                {{csrf_field()}}
                                <input type="hidden" name="apartment" value="{{$apartment->id}}">
                                <input type="hidden" name="usingService" value="{{$usingServices[$i]->id}}">
                                <button class="btn btn-danger"type="submit" onclick="return confirm('Chắc chắn xóa?')">Hủy</button>
                                {{method_field("DELETE")}}
                            </form>
                        </td>
                    </tr>
                @endfor
                </table>
                {{-- {{$services->links()}} --}}
                @else
                </table>
                    <br>
                    <h3 class="col-md-10 text-primary font-weight-bold">Hiện không có dịch vụ nào</h3>
                @endif
        </div> <!-- end div show part -->
    </div> <!-- end div show part -->



    <!-- The Modal -->
    <div class="modal" id="addServiceModal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="searchServiceInput" class="form-control" placeholder="Nhập tên dịch vụ">
                        
                        <p id="searchMessageP"></p>
                        <div class="text-right">
                            <button style="margin-top: 5px" type="submit" id="searchServiceBtn" class="btn btn-primary">Tìm</button>
                        </div>  
                    </div>

                    <table class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">Tên dịch vụ</th>
                                <th width="20%">Phương thức thanh toán</th>
                                <th width="20%">Số lượng sử dụng</th>
                                <th width="10%">Giá</th>
                                <th width="35%">Mô tả</th>
                            </tr>
                        </thead>
                        <tbody id="tableSearchService">
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="addResidentModal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="searchResidentInput" class="form-control" placeholder="Nhập tên dịch vụ">
                        
                        <p id="searchResidentMessageP"></p>
                        <div class="text-right">
                            <button style="margin-top: 5px" type="submit" id="searchResidentBtn" class="btn btn-primary">Tìm</button>
                        </div>  
                    </div>

                    <table class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">Name</th>
                                <th width="20%">Email</th>
                                <th width="20%">Phone Number</th>
                                <th width="10%">Type</th>
                                <th width="10%">Add</th> 
                            </tr>
                        </thead>
                        <tbody id="tableSearchResident">
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $('#searchServiceBtn').click(function (){
            $('#searchMessageP').text('');
            $("#tableSearchService tr").remove();
            var search = $('#searchServiceInput').val().trim();

            $.ajax({
                url: "{{route('service.search')}}",
                type: "get", //send it through get method
                data: { 
                    search: search, 
                },
                success: function(response) {
                    console.log(response);
                    var data = response.data;
                    if(data != 'none'){
                        if(data.length > 5){
                            for(var i = 0; i < 5; i++){
                                $("#tableSearchService").append('<tr><td>'+
                                        data[i].id+
                                        '</td><td>'+
                                        data[i].name+
                                        '</td><td>'+
                                        data[i].payment_method+
                                        '</td><td>'+
                                        data[i].use_method+
                                        '</td><td>'+
                                        data[i].price+
                                        '</td><td>'+
                                        '<button onclick="addServiceFunction('+
                                        data[i].id+
                                        ', {{$apartment->id}})" style="margin: 22px" type="button" class="btn btn-primary">Thêm</button>');
                            }
                        }else{
                            for(var i = 0; i < data.length; i++){
                                $("#tableSearchService").append('<tr><td>'+
                                    data[i].id+
                                    '</td><td>'+
                                    data[i].name+
                                    '</td><td>'+
                                    data[i].payment_method+
                                    '</td><td>'+
                                    data[i].use_method+
                                    '</td><td>'+
                                    data[i].price+
                                    '</td><td>'+
                                    '<button onclick="addServiceFunction('+
                                    data[i].id+
                                    ', {{$apartment->id}})" style="margin: 22px" type="button" class="btn btn-primary btnAddResident">Thêm</button>');
                            }
                        }
                    }else{
                        $('#searchMessageP').addClass('text-danger').text("Không tìm thấy kêt quả");
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        });

        function addServiceFunction(serviceID, apartmentID){
            var url = "/apartment/{apartment}/add/usingService";
            url = url.replace('{apartment}', apartmentID);

            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "post",
                data: { 
                    apartment: apartmentID, 
                    service: serviceID
                },
                success: function(response) {
                    console.log(response);
                    if(response.success == true){
                        $('#searchMessageP').removeClass('text-danger').addClass('text-success').text('Thêm vào thành công dịch vụ: '+serviceID);
                    }else if(response.error == true){
                        if(response.errorType == 1){
                            $('#searchMessageP').removeClass('text-success').addClass('text-danger').text('Sai thông tin căn hộ hoặc dịch vụ');
                        }else if(response.errorType == 2){
                            $('#searchMessageP').removeClass('text-success').addClass('text-waring').text('Dịch vụ hiện đã sử dụng');
                        }else if(response.errorType == 3){
                            $('#searchMessageP').removeClass('text-success').addClass('text-waring').text('Server không thể xử lý');
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }

        $('#searchResidentBtn').click(function (){
            $('#searchResidentMessageP').text('');
            $("#tableSearchResident tr").remove();
            var search = $('#searchResidentInput').val().trim();

            $.ajax({
                url: "{{route('user.search')}}",
                type: "get", //send it through get method
                data: { 
                    search: search, 
                },
                success: function(response) {
                    console.log(response);
                    var data = response.data;
                    if(data != 'none'){
                        if(data.length > 5){
                            for(var i = 0; i < 5; i++){
                                $("#tableSearchResident").append('<tr><td>'+
                                        data[i].id+
                                        '</td><td>'+
                                        data[i].name+
                                        '</td><td>'+
                                        data[i].email+
                                        '</td><td>'+
                                        data[i].phone_number+
                                        '</td><td>'+
                                        data[i].type+
                                        '</td><td>'+
                                        '<button onclick="addResidentFunction('+
                                        data[i].id+
                                        ', {{$apartment->id}})" style="margin: 22px" type="button" class="btn btn-primary">Thêm</button>');
                            }
                        }else{
                            for(var i = 0; i < data.length; i++){
                                $("#tableSearchResident").append('<tr><td>'+
                                        data[i].id+
                                        '</td><td>'+
                                        data[i].name+
                                        '</td><td>'+
                                        data[i].email+
                                        '</td><td>'+
                                        data[i].phone_number+
                                        '</td><td>'+
                                        data[i].type+
                                        '</td><td>'+
                                        '<button onclick="addResidentFunction('+
                                        data[i].id+
                                        ', {{$apartment->id}})" style="margin: 22px" type="button" class="btn btn-primary">Thêm</button>');
                            }
                        }
                    }else{
                        $('#searchResidentMessageP').addClass('text-danger').text("Không tìm thấy kêt quả");
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        });

        function addResidentFunction(userID, apartmentID){
            var url = "/apartment/{apartment}/add/resident";
            url = url.replace('{apartment}', apartmentID);

            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "post",
                data: { 
                    apartment: apartmentID, 
                    user: userID
                },
                success: function(response) {
                    if(response.success == true){
                        $('#searchResidentMessageP').removeClass('text-danger').addClass('text-success').text('Thêm vào thành công cư dân: '+userID);
                    }else if(response.error == true){
                        if(response.errorType == 1){
                            $('#searchResidentMessageP').removeClass('text-success').addClass('text-danger').text('Sai thông tin căn hộ hoặc người dùng');
                        }else if(response.errorType == 2){
                            $('#searchResidentMessageP').removeClass('text-success').addClass('text-danger').text('Người dùng đã thuộc về 1 căn hộ');
                        }else if(response.errorType == 3){
                            $('#searchResidentMessageP').removeClass('text-success').addClass('text-waring').text('Server không thể xử lý');
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }
    </script>
@endsection