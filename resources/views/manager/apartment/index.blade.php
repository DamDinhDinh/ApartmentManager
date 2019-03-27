@extends('layouts.app')

@section('content')
    <div class="apartment-control-part">
        <a href="{{route('apartment.create')}}" class="btn btn-primary">Thêm căn hộ mới</a>

    </div>
    <br>
    <div class="apartment-show-part">
        @if (count($apartmentList) > 0)
            <table class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                <tr>
                    <th>Apartment</th>
                    <th>Address</th>
                </tr>
                @foreach ($apartmentList as $apartment)
                    <tr>
                        <td><a href="{{route('apartment.show', ['id' => $apartment->id])}}" >{{$apartment->name}}</a></td>
                        <td>{{$apartment->address}}</td>
                    </tr>
                @endforeach
                {{$apartmentList->links()}}
            <table>
        @else
            <p>None to show.</p>
        @endif
    </div>
@endsection