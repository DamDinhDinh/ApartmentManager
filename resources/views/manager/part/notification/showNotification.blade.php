<div class="show-notification">
    <div class="row">
        <p class="pull-left font-weight-bold"><small>Người tạo: </small>{{ $notification->user != null ? $notification->user->name : "Unknow"}}</p>
        <p class="pull-right font-weight-bold"><small>Lúc: </small>{{ CarBon\Carbon::parse($notification->updated_at)->format('H:m d-m-Y')}}</p>
    </div>
    <div class="row">
		<h3 class=" text-black font-weight-bold">{{ $notification->title}}</h3>
    </div>
    <div class="row">
        <p class=" text-black font-weight-bold text-justify">{{ $notification->body}}</p>
    </div>
</div>

@section('showNotificationJS')
    
@endsection