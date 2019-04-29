@extends('adminlte::page')

@section('title', 'Danh sách căn hộ')

@section('content_header')
    <div class="row content-header" >
        {{-- <h3 class=" text-black font-weight-bold">Danh sách căn hộ: </h3> --}}
        <div class="row pull-right">
            <a style="margin-right: 15px" class="btn btn-primary" href="{{route('apartment.create')}}" >Thêm căn hộ mới</a>
        </div>
    </div>
@stop


@section('content')
    <div class="apartments-show">
        @if (count($apartmentList) > 0)
            <table id="table-apartments" style="text-align: center !important" width="100%" class="display table table-striped table-bordered .table-hover thead-dark">
                <thead>
                <tr>
					<th width="10%">ID</th>
                    <th width="20%">Apartment</th>
                    <th width="50%">Address</th>
                    <th width="10%">Edit</th>
                    <th width="10%">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($apartmentList as $apartment)
                    <tr>
						<td><a href="{{route('apartment.show', ['id' => $apartment->id])}}" >{{$apartment->id}}</a></td>
                        <td><a href="{{route('apartment.show', ['id' => $apartment->id])}}" >{{$apartment->name}}</a></td>
                        <td>{{$apartment->address}}</td>
                        <td><a href="{{route('apartment.edit', $apartment->id)}}" class="btn btn-primary">Sửa</a></td>
                        <td>
                            <form method="POST" action="{{route('apartment.destroy', $apartment->id)}}">
                                {{csrf_field()}}
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa</button>
                                {{method_field("DELETE")}}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            <table>
            {{$apartmentList->links()}}
        @else
            <p>None to show.</p>
        @endif
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#table-apartments').DataTable({
                "bPaginate": false
            });
        });
        
    </script>
@endsection
