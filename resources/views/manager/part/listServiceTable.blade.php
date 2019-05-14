<div class="list-service-table">
	<div style="display: inline-block" class="row">
		<h3 class=" text-black font-weight-bold">{{ trans('headerLabel.service_info') }}</h3>
	</div> <!-- end div row -->

	<table style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
		<tr>
			<th width="5%">ID</th>
			<th width="20%">Tên dịch vụ</th>
			<th width="10%">Phương thức thanh toán</th>
			<th width="10%">Số lượng sử dụng</th>
			<th width="10%">Giá</th>
			<th width="20%">Ngày bắt đầu</th>
			<th width="20%">Ngày hết hạn</th>
			<th width="5%">Hủy dịch vụ</th>
		</tr>
		@php
			$usingServices = $apartment->usingServices;
			$length = count($usingServices);
		@endphp
		@if ($length > 0)
			@for ($i = 0; $i < $length; $i++) 
				@php 
					$service=$usingServices[$i]->service;
				@endphp
				<tr>
					<td><a href="{{route('service.show', ['id' => $service->id])}}">{{$service->id}}</a></td>
					<td><a href="{{route('service.show', ['id' => $service->id])}}">{{$service->name}}</a></td>
					@php
						if($service->payment_method == 1){
							echo "<td>Theo tháng</td>";
						}else if($service->payment_method == 2){
							echo "<td>Theo ngày</td>";
						}else{
							echo "<td></td>";
						}
					@endphp
					@php
						if($service->use_method == 1){
							echo "<td>Không thay đổi</td>";
						}else if($service->use_method == 2){
							echo "<td>Thay đổi</td>";
						}
					@endphp
					<td>{{$service->price}}</td>
					<td>{{date('d/m/Y', strtotime($usingServices[$i]->start_date))}}</td>
					<td>{{date('d/m/Y', strtotime($usingServices[$i]->expire_date))}}</td>
					<td>
						<form method="POST" action="{{route('usingService.destroy', $apartment->id)}}">
							{{csrf_field()}}
							<input type="hidden" name="apartment" value="{{$apartment->id}}">
							<input type="hidden" name="usingService" value="{{$usingServices[$i]->id}}">
							<button class="btn btn-danger" type="submit" onclick="return confirm('Chắc chắn xóa?')">Hủy</button>
							{{method_field("DELETE")}}
						</form>
					</td>
				</tr>
			@endfor
	</table>
	{{-- {{$services->links()}} --}}
	@else
	</table>
	<h3 class="col-md-10 text-primary font-weight-bold">Hiện không có dịch vụ nào</h3>
	@endif
</div>