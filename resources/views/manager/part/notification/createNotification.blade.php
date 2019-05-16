<div class="create-notification">
    <form method="POST" action="{{route('notification.store')}}">
        {{csrf_field()}}
        <div class="row form-group">
            <label class="form-label" for="title">{{ trans('tableLabel.notification_title') }}</label>
            <div>
                <input class="form-control" type="text" name="title">
            </div>
        </div>
        <div class="row form-group">
            <label class="form-label" for="body">{{ trans('tableLabel.notification_body') }}</label>
            <div>
                <textarea class="form-control" name="body" rows="10"></textarea>
            </div>
        </div>
        <div class="row form-group pull-right">
            <button class="btn btn-primary" type="submit">{{ trans('buttonName.add') }}</button>
        </div>
    </form>
</div>

@section('createNotificationJS')
    
@endsection