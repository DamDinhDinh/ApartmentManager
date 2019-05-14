<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addResidentModal">
	Thêm cư dân
</button>

<!-- The Modal -->
<div class="modal" id="addResidentModal">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Thêm cư dân</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div class="form-group">
					<input type="text" id="searchResidentInput" class="form-control" placeholder="Nhập tên cư dân">

					<p id="searchResidentMessageP"></p>
					<div class="text-right">
						<button style="margin-top: 5px" type="submit" id="searchResidentBtn" class="btn btn-primary">Tìm</button>
					</div>
				</div>

				<table class="table table-bordered table-hover" id="tableSearchResident">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="20%">Name</th>
							<th width="20%">Email</th>
							<th width="20%">Phone Number</th>
							<th width="10%">Apartment</th>
							<th width="10%">Add</th>
						</tr>
					</thead>
					<tbody id="tableSearchResidentBody">
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

@section('addResidentJS')
<script type="text/javascript">
	$('#searchResidentBtn').click(function () {
		$('#searchResidentMessageP').text('');
		$("#tableSearchResidentBody tr").remove();
		var search = $('#searchResidentInput').val().trim();

		$.ajax({
			url: "{{route('user.search')}}",
			type: "get", //send it through get method
			data: {
				search: search,
			},
			success: function (response) {
				console.log(response);
				var data = response.data;
				if (data != 'none') {
					if (data.length > 5) {
						for (var i = 0; i < 5; i++) {
							$("#tableSearchResidentBody").append('<tr><td>' +
								data[i].id +
								'</td><td>' +
								data[i].name +
								'</td><td>' +
								data[i].email +
								'</td><td>' +
								data[i].phone_number +
								'</td><td>' +
								data[i].apartment_name +
								'</td><td>' +
								'<button onclick="addResidentFunction(' +
								data[i].id +
								', {{$apartment->id}})" style="margin: 22px" type="button" class="btn btn-primary">{{trans("buttonName.add")}}</button>');
						}
					} else {
						for (var i = 0; i < data.length; i++) {
							$("#tableSearchResidentBody").append('<tr><td>' +
								data[i].id +
								'</td><td>' +
								data[i].name +
								'</td><td>' +
								data[i].email +
								'</td><td>' +
								data[i].phone_number +
								'</td><td>' +
								data[i].type +
								'</td><td>' +
								'<button onclick="addResidentFunction(' +
								data[i].id +
								', {{$apartment->id}})" style="margin: 22px" type="button" class="btn btn-primary">{{trans("buttonName.add")}}</button>');
						}
					}

					$('#tableSearchResident').DataTable({
						"bPaginate": false
					});
				} else {
					$('#searchResidentMessageP').addClass('text-danger').text('{{trans("messages.not_found")}}');
				}
			},
			error: function (xhr) {
				console.log(xhr);
			}
		});
	});

	function addResidentFunction(userID, apartmentID) {
		var url = "/apartment/{apartment}/add/resident";
		url = url.replace('{apartment}', apartmentID);

		$.ajax({
			url: url,
			type: "post",
			data: {
				"_token": "{{ csrf_token() }}",
				apartment: apartmentID,
				user: userID
			},
			success: function (response) {
				// console.log(response);
				if (response.success == true) {
					$('#searchResidentMessageP').removeClass('text-danger').addClass('text-success').text('{{trans("messages.create_success")}}');
				} else if (response.failed == true) {
					if (response.failed_type == 1) {
						$('#searchResidentMessageP').removeClass('text-success').addClass('text-danger').text('{{trans("messages.not_exist")}}');
					} else if (response.failed_type == 2) {
						$('#searchResidentMessageP').removeClass('text-success').addClass('text-danger').text('{{trans("messages.already_is_resident")}}');
					} else if (response.failed_type == 3) {
						$('#searchResidentMessageP').removeClass('text-success').addClass('text-waring').text('{{trans("messages.cant_excute")}}');
					}
				}
			},
			error: function (xhr) {
				console.log(xhr);
			}
		});
	}
</script>
@endsection