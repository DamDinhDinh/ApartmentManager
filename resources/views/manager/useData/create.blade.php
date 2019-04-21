@extends('layouts.app')

@section('content')

    <form class="form" method="POST" action="{{route('useData.store', ['usingService' => Route::input('usingService')])}}">
        {{csrf_field()}}
        <div class="row">
            <label class="col-md-2"for="userName">ID dịch vụ đang sử  dụng: </label>
            <input type="text" class="form-control col-md-10" name="usingService" value="{{Route::input('usingService')}}" readonly>
        </div>
        <div class="row form-group">
            <label for="useValue">Số lượng sử dụng(với dịch vụ có số lượng không đổi)/Trị số ban đầu (với dịch vụ có số lượng thay đổi): </label>
            <input class="form-control" name="useValue" type="number">
        </div>
        <div class="row form-group">
            <label class="col-md-2" for="useDate">Số lượng/Trị số  trên là của tháng:  </label>
            <input name="useDate" type="date" value="{{date("Y-m-d", time())}}">
        </div>
        <div class="text-right" style="margin-top: 10px">
            <button class="btn btn-primary float-right" type="submit">Thêm người dùng</button>
        </div>
        
    </form>

@endsection 