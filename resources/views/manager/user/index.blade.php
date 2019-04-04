@extends('layouts.app')

@section('content')
    <div class="users-control-part">
        <div class="row" >
            <h3 style="margin: 22px" class="text-black font-weight-bold">Danh sách người dùng: </h3>
            <a  style="margin: 22px" class="btn btn-primary" href="{{route('user.create')}}" >Thêm người dùng mới</a>
        </div>
    </div>
    <div class="users-show-part">
            @if (count($users) > 0)
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Name</th>
                    <th width="20%">Email</th>
                    <th width="20%">Phone Number</th>
                    <th width="10%">Type</th>
                    <th width="10%">Edit</th>
                    <th width="10%">Delete</th>  
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td><a href="{{route('user.show', ['id' => $user->id])}}" >{{$user->id}}</a></td>
                        <td><a href="{{route('user.show', ['id' => $user->id])}}" >{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        @php
                            if($user-> type == 3){
                               echo "<td>User</td>";
                            }else if($user->type == 2){
                                echo "<td>Manager</td>";
                            }else{
                                echo "<td>Administrator</td>";
                            }
                        @endphp
                        
                        <td><a href="{{route('user.edit', $user->id)}}" class="btn btn-warning">Sửa</a></td>
                        <td>
                            <form method="POST" action="{{route('user.destroy', ['user' => $user->id, 'resident' => $user->id])}}">
                                {{csrf_field()}}
                                <button class="btn btn-danger"type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa</button>
                                {{method_field("DELETE")}}
                            </form>
                        </td>
                    </tr>
                @endforeach
            <table>
            {{$users->links()}}
        @else
            <br>
            <h3 class="col-md-10 text-primary font-weight-bold">Hiện không có cư dân nào</h3>
        @endif
    </div>
@endsection