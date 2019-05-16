<div class="edit-notification">
    <form method="POST" action="{{route('notification.update', $notification->id)}}">
        {{csrf_field()}}
        <div class="row form-group">
            <label class="form-label" for="title">{{ trans('tableLabel.notification_title') }}</label>
            <div>
                <input class="form-control" type="text" name="title" value="{{$notification->title}}">
            </div>
        </div>
        <div class="row form-group">
            <label class="form-label" for="body">{{ trans('tableLabel.notification_body') }}</label>
            <div>
                <textarea class="form-control" name="body" rows="10" >{{$notification->body}}</textarea>
            </div>
        </div>
        <div class="row form-group pull-right">
            <button class="btn btn-primary" type="submit">{{ trans('buttonName.edit') }}</button>
        </div>
        @method('PUT')
    </form>
</div>

@section('editNotificationJS')
    
@endsection