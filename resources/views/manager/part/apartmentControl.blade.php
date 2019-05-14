<div class="apartment-control">
	<div class="row pull-right" style="margin-right: 15px">

		@include('manager.part.addResident')
		@include('manager.part.addUsingService')

		<a href="{{route('apartment.edit', $apartment->id)}}" class="btn btn-primary">Sửa thông tin</a>
		<form style="display: inline-block" method="POST" action="{{route('apartment.destroy', $apartment->id)}}">
			{{csrf_field()}}
			<button class="btn btn-danger" type="submit" onclick="return confirm('Chắc chắn xóa?')">Xóa căn hộ</button>
			{{method_field("DELETE")}}
		</form>
	</div>
</div>

@section('apartmentControlJS')
	@yield('addResidentJS')
	@yield('addUsingServieJS')
@endsection
