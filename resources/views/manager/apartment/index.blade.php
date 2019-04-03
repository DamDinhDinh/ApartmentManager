@extends('layouts.app')

@section('content')
    <div class="apartment-control-part">
        <div class="row">
            <h3 style="margin: 22px" class=" text-black font-weight-bold">Danh sách căn hộ: </h3>
            <a style="margin: 22px" class="btn btn-primary" href="{{route('apartment.create')}}" >Thêm căn hộ mới</a>
        </div>
    </div>
    <div class="apartment-show-part">
        @if (count($apartmentList) > 0)
            <table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                <tr>
					<th width="10%">ID</th>
                    <th width="20%">Apartment</th>
                    <th width="50%">Address</th>
                    <th width="10%">Edit</th>
                    <th width="10%">Delete</th>
                </tr>
                @foreach ($apartmentList as $apartment)
                    <tr>
						<td><a href="{{route('apartment.show', ['id' => $apartment->id])}}" >{{$apartment->id}}</a></td>
                        <td><a href="{{route('apartment.show', ['id' => $apartment->id])}}" >{{$apartment->name}}</a></td>
                        <td>{{$apartment->address}}</td>
                        <td><a href="{{route('apartment.edit', $apartment->id)}}" class="btn btn-warning">Sửa</a></td>
                        <td>
                            <form method="POST" action="{{route('apartment.destroy', $apartment->id)}}">
                                {{csrf_field()}}
                                <button class="btn btn-danger"type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa</button>
                                {{method_field("DELETE")}}
                            </form>
                        </td>
                    </tr>
                @endforeach
            <table>
            {{$apartmentList->links()}}
        @else
            <p>None to show.</p>
        @endif
    </div>
@endsection