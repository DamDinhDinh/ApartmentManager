@extends('layouts.app')

@section('content')

<div class="resident-apartment-info">
        <div class="head-show-part">
            <div class="row">
                <h3 style="margin: 22px" class=" text-black font-weight-bold">Thông tin căn hộ: </h3>
            </div>
        </div>
        <div class="apartment -info-table">
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
                    <td>{{$user->phoneNumber}}</td>
                    <td>{{$user->type}}</td>
                    <td><a href="" class="btn btn-warning">Move</a></td>
                    <td>
                        <form method="POST" action="{{route('apartment.removeResident', ['apartment' => $apartment->id, 'resident' => $user->id])}}">
                            {{csrf_field()}}
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
            </div>
        </div>
    </div>
@endsection