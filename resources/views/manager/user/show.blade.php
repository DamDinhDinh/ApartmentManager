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
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông tin căn hộ: </h3>
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
@endsection