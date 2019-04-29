@extends('adminlte::page')

@section('title', 'Danh sách người dùng')

@section('content_header')
    <div class="row content-header">
        {{-- <h3 style="margin: 22px" class="text-black font-weight-bold">Danh sách người dùng: </h3> --}}
        <div class="row pull-right" >
            <a style="margin-right: 15px" class="btn btn-primary" href="{{route('user.create')}}" >Thêm người dùng mới</a>
        </div>
    </div>
@stop

@section('content')
    <div class="users-show">
            @if (count($users) > 0)
            <table id="table-users" width="100%" style="text-align: center !important" class="display table table-striped table-bordered .table-hover thead-dark">
                <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Name</th>
                    <th width="20%">Email</th>
                    <th width="20%">Phone Number</th>
                    <th width="10%">Type</th>
                    <th width="10%">Edit</th>
                    <th width="10%">Delete</th>  
                </tr>
                </thead>
                <tbody>
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
                        
                        <td><a href="{{route('user.edit', $user->id)}}" class="btn btn-primary">Sửa</a></td>
                        <td>
                            <form method="POST" action="{{route('user.destroy', ['user' => $user->id, 'resident' => $user->id])}}">
                                {{csrf_field()}}
                                <button class="btn btn-danger"type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa</button>
                                {{method_field("DELETE")}}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            <table>
            {{$users->links()}}
        @else
            <br>
            <h3 class="col-md-10 text-primary font-weight-bold">Hiện không có cư dân nào</h3>
        @endif
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#table-users').DataTable({
                "bPaginate": false
            });
        });
        
    </script>
@endsection