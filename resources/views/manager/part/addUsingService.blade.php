<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addServiceModal">
	Thêm dịch vụ
</button>

<!-- The Modal -->
<div class="modal" id="addServiceModal">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Thêm dịch vụ</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div class="form-group">
					<input type="text" id="searchServiceInput" class="form-control" placeholder="Nhập tên dịch vụ">

					<p id="searchMessageP"></p>
					<div class="text-right">
						<button style="margin-top: 5px" type="submit" id="searchServiceBtn" class="btn btn-primary">Tìm</button>
					</div>
				</div>

				<table class="table table-bordered table-hover" id="tableSearchService">
					<thead>
						<tr>
							<th width="5%">ID</th>
							<th width="20%">Tên dịch vụ</th>
							<th width="20%">Phương thức thanh toán</th>
							<th width="20%">Số lượng sử dụng</th>
							<th width="10%">Giá</th>
							<th width="35%">Mô tả</th>
						</tr>
					</thead>
					<tbody id="tableSearchServiceBody">
						<tr>
						</tr>
					</tbody>
				</table>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
{{-- end modal --}}

<!-- The Modal -->
<div class="modal" id="createUsingService">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Thông tin dịch vụ</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div class="form col-md-8">
					<form class="form" method="POST" action="{{route('usingService.store')}}">
						{{csrf_field()}}
						<div class="row form-group">
							<label id="createUsingServiceApartID" class="col-md-4"
								for="apartmentID">{{ trans('labelForm.apartment') }}</label>
							<input class="col-md-4" id="idApartmentName" name="apartment_name" type="text" readonly>
							<input class="col-md-4" id="idApartmentID" name="apartment" type="number" hidden>
						</div>

						<div class="row form-group">
							<label class="col-md-4" for="serviceID">{{trans('labelForm.service')}} </label>
							<input class="col-md-4" id="idServiceName" name="service_name" type="text" readonly>
							<input class="col-md-4" id="idServiceID" name="service" type="number" hidden>
						</div>

						<div class="row form-group">
							<label class="col-md-4" for="useDate">{{trans('labelForm.start_date')}} </label>
							<input class="col-md-4" name="start_date" type="date" value="{{date("Y-m-d", time())}}">
						</div>

						<div class="row form-group">
							<label class="col-md-4" data-toggle="useValueTooltip"
								title="Số lượng sử dụng(với dịch vụ có số lượng không đổi)/Trị số ban đầu (với dịch vụ có số lượng thay đổi)"
								for="useValue">{{trans('labelForm.use_value')}} </label>
							<input class="col-md-4" name="use_value" type="number">
						</div>

						<div class="row form-group">
							<label class="col-md-4" for="useDate">{{trans('labelForm.use_date')}}</label>
							<input class="col-md-4" name="use_date" type="date" value="{{date("Y-m-d", time())}}">
						</div>

						<div class="text-center" style="margin-top: 10px">
							<button class="btn btn-primary float-right" type="submit">{{trans("buttonName.submit")}}</button>
						</div>
					</form>
				</div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
{{-- end modal --}}

@section('addUsingServieJS')
<script type="text/javascript">
	$(document).ready(function (){
		console.log("adsf");
			$("#searchServiceBtn").click(function (){
			console.log("ditmemay");
		});
	});
	

	$('#searchServiceBtn').click(function (){
			$('#searchMessageP').text('');
			$("#tableSearchServiceBody tr").remove();
			var search = $('#searchServiceInput').val().trim();

			$.ajax({
					url: "{{route('service.search')}}",
					type: "get", //send it through get method
					data: { 
							search: search, 
					},
					success: function(response) {
							// console.log(response);
							var data = response.data;
							if(data != 'none'){
									if(data.length > 5){
											for(var i = 0; i < 5; i++){
													$("#tableSearchServiceBody").append('<tr><td>'+
																	data[i].id+
																	'</td><td>'+
																	data[i].name+
																	'</td><td>'+
																	data[i].payment_method+
																	'</td><td>'+
																	data[i].use_method+
																	'</td><td>'+
																	data[i].price+
																	'</td><td>'+
																	'<button onclick="addServiceFunction('+
																	data[i].id+
																	', {{$apartment->id}})" style="margin: 22px" type="button" class="btn btn-primary">{{trans("buttonName.add")}}</button>');
											}
									}else{
											for(var i = 0; i < data.length; i++){
													var url = "{{ route('usingService.create', ['searchApartment' => $apartment->name, 'searchService' => 'searchService'] )}}";
													url = url.replace('searchService', data[i].name);

													window.service = Array.from(data);

													$("#tableSearchServiceBody").append("<tr><td>"+
															data[i].id+
															"</td><td>"+
															data[i].name+
															"</td><td>"+
															data[i].payment_method+
															"</td><td>"+
															data[i].use_method+
															"</td><td>"+
															data[i].price+
															"</td><td>"+
															"<button class='btn btn-primary' type='button' data-toggle='modal' data-target='#createUsingService' onclick='createUsingService(window.service["+i+"])'>{{trans('buttonName.add')}}</button>"+
															"</td></tr>");
															// '<a href="'+url+'"class="btn btn-primary">Thêm</a>');
															// '<button onclick="addServiceFunction('+
															// data[i].id+
															// ', {{$apartment->id}})" style="margin: 22px" type="button" class="btn btn-primary btnAddResident">Thêm</button>');
											}
									}

									$('#tableSearchService').DataTable({
											"bPaginate": false
									});
							}else{
									$('#searchMessageP').addClass('text-danger').text("Không tìm thấy kêt quả");
							}
					},
					error: function(xhr) {
							console.log(xhr);
					}
			});
	});


	function createUsingService(data){
			console.log(data);

			document.getElementById("idApartmentName").value = '{{$apartment->name}}';
			document.getElementById("idServiceName").value = data.name;
			document.getElementById("idServiceID").value = data.id;
			document.getElementById("idApartmentID").value = {{$apartment->id}};
	}

</script>
@endsection