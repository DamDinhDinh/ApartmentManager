<div class="edit-useData">
    <form class="form" method="POST" action="{{route('useData.update', ['usingService' => $useData->using_service_id, 'useData' => $useData->id])}}">
        {{csrf_field()}}
        <div class="row form-group">
            <label for="userName">ID dịch vụ đang sử  dụng: </label>
            <input type="text" class="form-control col-md-10" name="usingService" value="{{$useData->using_service_id}}" readonly>
        </div>
        <div class="row form-group">
            <label for="useValue">{{ trans('tableLabel.use_data_value') }}</label>
            <input class="form-control" name="useValue" type="number" value="{{$useData->use_value}}">
        </div>
        <div class="row form-group">
            <label for="useDate">{{ trans('tableLabel.use_data_date') }}</label>
            <input name="useDate" type="date" value="{{$useData->use_date}}">
        </div>
        <div class="text-right" style="margin-top: 10px">
            <button class="btn btn-primary float-right" type="submit">{{ trans('labelForm.submit') }}</button>
        </div>
        @method('PUT')
    </form>
</div>