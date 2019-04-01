@extends('layouts.app')

@section('content')
    <div class="show-apartment">
        <div class="row">
            <h3 class="col-md-2 text-black font-weight-bold">Name: </h3>
            <h3 class="col-md-10 text-primary font-weight-bold">{{$apartment->name}}</h3>
        </div>

        <div class="row">
            <h3 class="col-md-2 text-black font-weight-bold">Address: </h3>
            <h3 class="col-md-10 text-primary font-weight-bold">{{$apartment->address}}</h3>
            <br>
            <br>
        </div>

        <div class="row resident-control-btn-group">  
        </div>
        
        
            <div class="row">
                <h3 class="col-md-2 text-black font-weight-bold">Resident</h3>
                
           
            
            
            @if (count($apartment->users) > 0)
            </div>
                @php
                    $users = $apartment->users;
                @endphp
                
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
                <table>
            @else
                <h3 class="col-md-10 text-primary font-weight-bold">None to show</h3>
            </div>
            @endif
        
    </div>
@endsection