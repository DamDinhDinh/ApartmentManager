@extends('adminlte::page')

@section('content_header')
<div class="row">
        <div class="row pull-right" style="margin-right: 15px">
            <a href="{{route('apartment.edit', $apartment->id)}}" class="btn btn-primary">Sửa thông tin</a>
            <form style="display: inline-block"  method="POST" action="{{route('apartment.destroy', $apartment->id)}}">
                {{csrf_field()}}
                <button class="btn btn-danger" type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa căn hộ</button>
                {{method_field("DELETE")}}
            </form>
        </div>
</div>
@endsection

@section('content')
<div class="resident-apartment-info">
<div style="padding: 10px">
    <div class="row">
        <div class="apartment-info-table ">
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
        <div class="row ">
            <div class="show-user ">
                <div style="display: inline-block" class="row">
                    <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông tin người dùng: </h3>
                </div>
                    <!-- Button to Open the Modal -->
                    <button  style="margin: 22px" type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addResidentModal">
                        Thêm cư dân
                    </button>

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
                        <td><a href="" class="btn btn-primary">Move</a></td>
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
    </div>
    <div class="show-service">
        <div class="head-show-part">
            <div style="display: inline-block" class="row">
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông tin dịch vụ: </h3>
            </div> <!-- end div row -->
            <!-- Button to Open the Modal -->
            <button  style="margin: 22px" type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addServiceModal">
                Thêm dịch vụ
            </button>
        </div> <!-- end div head -->

            
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

                    <table class="table table-bordered table-hover" id="tableSearchService">
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
                        <tbody id="tableSearchServiceBody">
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

                    <table class="table table-bordered table-hover" id="tableSearchResident">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">Name</th>
                                <th width="20%">Email</th>
                                <th width="20%">Phone Number</th>
                                <th width="10%">Apartment</th>
                                <th width="10%">Add</th> 
                            </tr>
                        </thead>
                        <tbody id="tableSearchResidentBody">
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
    {{-- end modal --}}

        <!-- The Modal -->
    <div class="modal" id="createUsingService">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thông tin dịch vụ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                        <div class="form col-md-8">
                                <form class="form" method="POST" action="{{route('usingService.store')}}">
                                        {{csrf_field()}}
                                        <div class="row form-group">
                                            <label id="createUsingServiceApartID" class="col-md-4" for="apartmentID">Căn hộ: </label>
                                                <input class="col-md-4" id="idApartmentName" name="apartment_name" type="text" readonly>
                                                <input class="col-md-4" id="idApartmentID" name="apartment" type="number" hidden >
                                        </div>
                        
                                        <div class="row form-group">
                                            <label class="col-md-4" for="serviceID">Dịch vụ: </label>
                                                <input class="col-md-4" id="idServiceName" name="service_name" type="text"  readonly>
                                                <input class="col-md-4" id="idServiceID" name="service" type="number" hidden>	
                                        </div>
                        
                                        <div class="row form-group">
                                            <label class="col-md-4" for="useDate">Ngày bắt đầu:  </label>
                                            <input class="col-md-4" name="start_date" type="date" value="{{date("Y-m-d", time())}}">
                                        </div>
                        
                                        <div class="row form-group">
                                            <label class="col-md-4" data-toggle="useValueTooltip" title="Số lượng sử dụng(với dịch vụ có số lượng không đổi)/Trị số ban đầu (với dịch vụ có số lượng thay đổi)" for="useValue">Số lượng sử dụng/Trị số ban đầu: </label>
                                                <input class="col-md-4" name="use_value" type="number">
                                        </div>
                        
                                        <div class="row form-group">
                                            <label class="col-md-4" for="useDate">Số lượng/Trị số  trên là của tháng:  </label>
                                            <input class="col-md-4" name="use_date" type="date" value="{{date("Y-m-d", time())}}">
                                        </div>
                        
                                            <div class="text-center" style="margin-top: 10px">
                                                    <button class="btn btn-primary float-right" type="submit">Thực hiện</button>
                                            </div>
                                </form>	 
                        </div> 
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    {{-- end modal --}}
    </div>
    
@endsection

@section('js')
    <script type="text/javascript">

        $('#searchServiceBtn').click(function (){
            $('#searchMessageP').text('');
            $("#tableSearchServiceBody tr").remove();
            var search = $('#searchServiceInput').val().trim();

            $.ajax({
                url: "{{route('service.search')}}",
                type: "get", //send it through get method
                data: { 
                    search: search, 
                },
                success: function(response) {
                    // console.log(response);
                    var data = response.data;
                    if(data != 'none'){
                        if(data.length > 5){
                            for(var i = 0; i < 5; i++){
                                $("#tableSearchServiceBody").append('<tr><td>'+
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
                                var url = "{{ route('usingService.create', ['searchApartment' => $apartment->name, 'searchService' => 'searchService'] )}}";
                                url = url.replace('searchService', data[i].name);

                                window.service = Array.from(data);

                                $("#tableSearchServiceBody").append("<tr><td>"+
                                    data[i].id+
                                    "</td><td>"+
                                    data[i].name+
                                    "</td><td>"+
                                    data[i].payment_method+
                                    "</td><td>"+
                                    data[i].use_method+
                                    "</td><td>"+
                                    data[i].price+
                                    "</td><td>"+
                                    "<button class='btn btn-primary' type='button' data-toggle='modal' data-target='#createUsingService' onclick='createUsingService(window.service["+i+"])'>Thêm</button>"+
                                    "</td></tr>");
                                    // '<a href="'+url+'"class="btn btn-primary">Thêm</a>');
                                    // '<button onclick="addServiceFunction('+
                                    // data[i].id+
                                    // ', {{$apartment->id}})" style="margin: 22px" type="button" class="btn btn-primary btnAddResident">Thêm</button>');
                            }
                        }

                        $('#tableSearchService').DataTable({
                            "bPaginate": false
                        });
                    }else{
                        $('#searchMessageP').addClass('text-danger').text("Không tìm thấy kêt quả");
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        });

        $('#searchResidentBtn').click(function (){
            $('#searchResidentMessageP').text('');
            $("#tableSearchResidentBody tr").remove();
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
                                $("#tableSearchResidentBody").append('<tr><td>'+
                                        data[i].id+
                                        '</td><td>'+
                                        data[i].name+
                                        '</td><td>'+
                                        data[i].email+
                                        '</td><td>'+
                                        data[i].phone_number+
                                        '</td><td>'+
                                        data[i].apartment_name+
                                        '</td><td>'+
                                        '<button onclick="addResidentFunction('+
                                        data[i].id+
                                        ', {{$apartment->id}})" style="margin: 22px" type="button" class="btn btn-primary">Thêm</button>');
                            }
                        }else{
                            for(var i = 0; i < data.length; i++){
                                $("#tableSearchResidentBody").append('<tr><td>'+
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

                        $('#tableSearchResident').DataTable({
                            "bPaginate": false
                        });
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
                url: url,
                type: "post",
                data: { 
                    "_token": "{{ csrf_token() }}",
                    apartment: apartmentID, 
                    user: userID
                },
                success: function(response) {
                    // console.log(response);
                    if(response.success == true){
                        $('#searchResidentMessageP').removeClass('text-danger').addClass('text-success').text('Thêm vào thành công cư dân: '+userID);
                    }else if(response.failed == true){
                        if(response.failed_type == 1){
                            $('#searchResidentMessageP').removeClass('text-success').addClass('text-danger').text('Sai thông tin căn hộ hoặc người dùng');
                        }else if(response.failed_type == 2){
                            $('#searchResidentMessageP').removeClass('text-success').addClass('text-danger').text('Người dùng đã thuộc về 1 căn hộ');
                        }else if(response.failed_type == 3){
                            $('#searchResidentMessageP').removeClass('text-success').addClass('text-waring').text('Server không thể xử lý');
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }


        function createUsingService(data){
            console.log(data);

            document.getElementById("idApartmentName").value = {{$apartment->name}};
            document.getElementById("idServiceName").value = data.name;
            document.getElementById("idServiceID").value = data.id;
            document.getElementById("idApartmentID").value = {{$apartment->id}};
        }
    </script>
@endsection