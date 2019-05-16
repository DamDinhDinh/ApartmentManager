<div style="margin:10px" class="row notification-control">
	<div class="row pull-right" style="margin-right: 15px">
		<a href="{{route('notification.edit', $notification->id)}}" class="btn btn-primary">{{ trans('buttonName.edit') }}</a>
		<form style="display: inline-block" method="POST" action="{{route('notification.destroy', $notification->id)}}">
			{{csrf_field()}}
			<button class="btn btn-danger" type="submit" onclick="return confirm('Chắc chắn xóa?')">{{ trans('buttonName.delete') }}</button>
			{{method_field("DELETE")}}
		</form>
	</div>
</div>

@section('notificationControlJS')
@endsection
