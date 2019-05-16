<div class="bill-control">
	<div class="row pull-right" style="margin-right: 15px">
		<a href="{{route('bill.edit', $bill->id)}}" class="btn btn-primary">{{ trans('buttonName.edit') }}</a>
		<form style="display: inline-block" method="POST" action="{{route('bill.destroy', $bill->id)}}">
			{{csrf_field()}}
			<button class="btn btn-danger" type="submit" onclick="return confirm('Chắc chắn xóa?')">{{ trans('buttonName.delete') }}</button>
			{{method_field("DELETE")}}
		</form>
	</div>
</div>

@section('billControlJS')
@endsection
