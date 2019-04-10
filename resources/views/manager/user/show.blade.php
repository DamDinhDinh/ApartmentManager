@extends('layouts.app')

@section('content')
    <div class="show-user ">
        <div class="head-show-part">
            <div class="row">
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông tin tài khoản: </h3>
            </div>
        </div>
        <div class="user-info-table">
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                <tr>
                    <th width="30%">ID người dùng: </th>
                    <td width="70%">{{$user->id}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Tên người dùng: </th>
                    <td width="70%">{{$user->name}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Email: </th>
                    <td width="70%">{{$user->email}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Số điện thoại: </th>
                    <td width="70%">{{$user->phone_number}}</a></td>
                </tr>
                <tr>
                    <th width="30%">Loại tài khoản: </th>

                    @php
                    if($user->type == 3){
                       echo '<td width="70%">Người dùng</td>';
                    }else if($user->type == 2){
                        echo '<td width="70%">Quản lý</td>';
                    }else{
                        echo "<td width='70%'>Administrator</td>";
                    }
                @endphp
                </tr>
            </table>
        </div>
    </div>
    <div class="resident-apartment-info">
        <div class="head-show-part">
            <div class="row">
                <h3 id="h31" style="margin: 22px" class=" text-black font-weight-bold">Thông tin căn hộ: </h3>
                <button style="margin: 22px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addToApartmentModal">Thêm vào căn hộ</button>
            </div>
        </div>
        <div class="user-info-table">
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                @if ($user->apartment != null)
                @php
                    $apartment = $user->apartment;
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
            @else
                <tr>
                    <th width="30%">ID căn hộ: </th>
                    <td width="70%">NULL</a></td>
                </tr>
            </table>
            @endif
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal" id="addToApartmentModal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm vào căn hộ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="searchApartment" class="form-control" placeholder="Nhập tên">
                        {{-- <div class="row"> --}}
                            <p id="searchMessageP"></p>
                            <div class="text-right">
                                <button style="margin-top: 5px" type="submit" id="searchApartmentBtn" class="btn btn-primary">Tìm</button>
                            </div>
                        {{-- </div> --}}
                        
                    </div>
                    
                    <table class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">Name</th>
                                <th width="60%">Address</th>
                                <th width="10%">Add to</th>
                            </tr>
                        </thead>
                        <tbody id="tableSearchApartment">
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
        $('#searchApartmentBtn').click(function (){
            $('#searchMessageP').text('');
            $("#tableSearchApartment tr").remove();
            var search = $('#searchApartment').val().trim();
            $.ajax({
                url: "{{route('apartment.search')}}",
                type: "get", //send it through get method
                data: { 
                    search: search, 
                },
                success: function(response) {
                    console.log(response);
                    var data = response.data;
                    if(data != 'none'){
                        $("#tableSearchApartment tb").fadeOut(300, function() { $(this).remove(); })
                        if(data.length > 5){
                            for(var i = 0; i < 5; i++){
                                var url = "/apartment/{apartment}/add/resident";
                                url = url.replace('{apartment}', data[i].id);
                                // $("#tableSearchApartment").append('<tr><td>'+
                                //     data[i].id+
                                //     '</td><td>'+    
                                //         data[i].name+
                                //         '</td><td>'+
                                //             data[i].address+
                                //             '</td><td><form method="POST" action="'+url+'"> {{csrf_field()}}<input name="apartment" value="'+data[i].id+'"><input name="user" value="{{$user->id}}"><button type="submit" class="btn btn-primary">Add</button></form></a></td></tr>');

                                $("#tableSearchApartment").append('<tr><td>'+
                                        data[i].id+
                                        '</td><td>'+
                                        data[i].name+
                                        '</td><td>'+
                                        data[i].address+
                                        '</td><td>'+
                                        '<button onclick="addResidentFunction('+data[i].id+', {{$user->id}})" style="margin: 22px" type="button" class="btn btn-primary btnAddResident">Thêm</button>');

                            }
                        }else{
                            for(var i = 0; i < data.length; i++){
                                console.log(data[i].name);
                                $("#tableSearchApartment").append('<tr><td>'+
                                        data[i].id+
                                        '</td><td>'+
                                        data[i].name+
                                        '</td><td>'+
                                        data[i].address+
                                        '</td><td>'+
                                        '<button onclick="addResidentFunction('+data[i].id+', {{$user->id}})" style="margin: 22px" type="button" class="btn btn-primary btnAddResident">Thêm</button>');
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

        function addResidentFunction(apartmentID, userID){
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
                        $('#searchMessageP').removeClass('text-danger').addClass('text-success').text('Thêm vào thành công căn hộ ID: '+apartmentID);
                    }else if(response.error == true){
                        if(response.errorType == 1){
                            $('#searchMessageP').removeClass('text-success').addClass('text-danger').text('Sai thông tin căn hộ hoặc người dùng');
                        }else if(response.errorType == 2){
                            $('#searchMessageP').removeClass('text-success').addClass('text-danger').text('Người dùng đã thuộc về 1 căn hộ');
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
    </script>
@endsection