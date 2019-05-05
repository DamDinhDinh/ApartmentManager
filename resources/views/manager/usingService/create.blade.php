@extends('adminlte::page')

@section('content')
<div style="padding: 10px">
	
	<div class="form col-md-8">
			<form class="form" method="POST" action="{{route('usingService.store')}}">
					{{csrf_field()}}
					<div class="row form-group">
						<label class="col-md-4" for="apartmentID">Chọn căn hộ: </label>
							<select class="col-md-4" name="apartment" id="selectApartmentInput">
								
							</select>
					</div>
	
					<div class="row form-group">
						<label class="col-md-4" for="serviceID">Chọn dịch vụ: </label>
								<select class="col-md-4" name="service" id="selectServiceInput">
									
								</select>	
					</div>
	
					<div class="row form-group">
						<label class="col-md-4" for="useDate">Ngày bắt đầu:  </label>
						<input class="col-md-4" name="start_date" type="date" value="{{date("Y-m-d", time())}}">
					</div>
	
					<div class="row form-group">
						<label class="col-md-4" data-toggle="useValueTooltip" title="Số lượng sử dụng(với dịch vụ có số lượng không đổi)/Trị số ban đầu (với dịch vụ có số lượng thay đổi)" for="useValue">Số lượng sử dụng/Trị số ban đầu: </label>
							<input class="col-md-4" name="use_value" type="number">
					</div>
	
					<div class="row form-group">
						<label class="col-md-4" for="useDate">Số lượng/Trị số  trên là của tháng:  </label>
						<input class="col-md-4" name="use_date" type="date" value="{{date("Y-m-d", time())}}">
					</div>
	
						<div class="text-center" style="margin-top: 10px">
								<button class="btn btn-primary float-right" type="submit">Thực hiện</button>
						</div>
			</form>	 
	</div> 
	<div class="col-md-4">
			<div class="input-group">
					<input type="text" id="searchApartment" class="form-control" placeholder="Nhập tên căn hộ" value="{{$searchApartment != null ? $searchApartment : ''}}">
							<p id="searchMessageP"></p>
					<span class="input-group-btn">
							<button style="margin-left: 2px" id="searchApartmentBtn" class="btn btn-primary">Tìm</button>
					</span>
			</div>
			<div class="input-group">
					<input type="text" id="searchService" class="form-control" placeholder="Nhập tên dịch vụ:" value="{{$searchService != null ? $searchService : ""}}">
							<p id="searchServiceMessageP"></p>
					<span class="input-group-btn">
							<button style="margin-left: 2px"  id="searchServicetBtn" class="btn btn-primary">Tìm</button>
					</span>
			</div>
	</div>
   
</div>
@endsection  

@section('js')
		<script type="text/javascript">
			$(document).ready(function () {
				$('#searchApartmentBtn').click();
				$('#searchServicetBtn').click();
				$('[data-toggle="useValueTooltip"]').tooltip(); 
			});

			$('#searchApartmentBtn').click(function (){
				loadSearchMessage("", "");
				$('#selectApartmentInput').empty();

				search = $('#searchApartment').val().trim();
				searchApartment(search);
			});

			function searchApartment(search){
				$.ajax({
          url: "{{route('apartment.search')}}",
          type: "get", //send it through get method
          data: { 
            search: search, 
          },
          success: function(response) {
          	console.log(response);
            var data = response.data;
            if(data != 'none'){
							length = data.length;
							if(length > 5){
								loadSelectApartment(data, 5);
							}else{
								loadSelectApartment(data, length);
							}
            }else{
							message = "Không tìm thấy kêt quả";
							type = "text-danger";
							loadSearchMessage(message, type);
            }
          },
          error: function(xhr) {
            console.log(xhr);
          }
        });
			}

			function loadSelectApartment(data, num){
				for(var i = 0; i < num; i++){
					$('#selectApartmentInput').addClass("selectorApartmentElement").append(new Option(data[i].name, data[i].id));
				}
			}

			function loadSearchMessage(message, type){
				$('#searchMessageP').addClass(type).text(message);
			}

			$('#searchServicetBtn').click(function (){
				loadSearchServiceMessage("", "");
				$('#selectServiceInput').empty();

				search = $('#searchService').val().trim();
				searchService(search);
			});

			function searchService(search){
				$.ajax({
          url: "{{route('service.search')}}",
          type: "get", //send it through get method
          data: { 
            search: search, 
          },
          success: function(response) {
          	console.log(response);
            var data = response.data;
            if(data != 'none'){
							loadSelectService(data);
            }else{
							message = "Không tìm thấy kêt quả";
							type = "text-danger";
							loadSearchMessage(message, type);
            }
          },
          error: function(xhr) {
            console.log(xhr);
          }
				});
			}

			function loadSelectService(data){
				length = data.length;
				id = "#selectServiceInput";
				if(length > 5){
					loadSelect(id, data, 5);
				}else{
					loadSelect(id, data, length);
				}
			}

			function loadSelect(id, data, num){
				for(var i = 0; i < num; i++){
					$(id).addClass("selectorServiceElement").append(new Option(data[i].name, data[i].id));
				}
			}

			function loadSearchServiceMessage(message, type){
				$('#searchMessageP').addClass(type).text(message);
			}
		</script>
@endsection