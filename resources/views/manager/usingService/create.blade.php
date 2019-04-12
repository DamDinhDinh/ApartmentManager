@extends('layouts.app')

@section('content')
	<div class="form-group">
			<input type="text" id="searchApartment" class="form-control" placeholder="Nhập tên căn hộ">
					<p id="searchMessageP"></p>
					<div class="text-right">
							<button style="margin-top: 5px" type="submit" id="searchApartmentBtn" class="btn btn-primary">Tìm</button>
					</div>
	</div>
	<div class="form-group">
			<input type="text" id="searchService" class="form-control" placeholder="Nhập tên dịch vụ:">
					<p id="searchServiceMessageP"></p>
					<div class="text-right">
							<button style="margin-top: 5px" type="submit" id="searchServicetBtn" class="btn btn-primary">Tìm</button>
					</div>
	</div>
    <form class="form" method="POST" action="{{route('usingService.store1')}}">
        {{csrf_field()}}
        <div class="row">
        <label class="col-md-2" for="apartmentID">Chọn căn hộ: </label>
            <select class="form-control" name="apartment" id="selectApartmentInput">
              
            </select>
				</div>

				<label class="col-md-2" for="serviceID">Chọn dịch vụ: </label>
            <select class="form-control" name="service" id="selectServiceInput">
              
            </select>
        </div>
        <div class="text-right" style="margin-top: 10px">
            <button class="btn btn-primary float-right" type="submit">Thực hiện</button>
        </div>
    </form>	

@endsection  

@section('footer')
		<script type="text/javascript">
			$(document).ready(function () {
				searchApartment("");
				searchService("");
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
					$('#selectApartmentInput').append(new Option(data[i].name, data[i].id));
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
							length = data.length;
							if(length > 5){
								loadSelectService(data, 5);
							}else{
								loadSelectService(data, length);
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

			function loadSelectService(data, num){
				for(var i = 0; i < num; i++){
					$('#selectServiceInput').append(new Option(data[i].name, data[i].id));
				}
			}

			function loadSearchServiceMessage(message, type){
				$('#searchMessageP').addClass(type).text(message);
			}

			
		</script>
@endsection