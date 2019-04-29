{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Danh sách căn hộ</h1>
@stop

@section('content')
    <div class="apartment-dataTable">
        <table class="table table-bordered table-striped" id="apartmentDataTable" width="100%">
            <thead>
               <tr>
                  <th>Mã</th>
                  <th>Tên</th>
                  <th>Địa chỉ</th>
                  <th>Số dân</th>
                  <th>Số dịch vụ</th>
                  <th>Sửa</th>
                  <th>Xóa</th>
               </tr>
            </thead>
            <tbody>
            </tbody>
         </table>
    </div>
@stop

@section('css')

@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
    <script type="text/javascript">
        $(document).ready(function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        //load DataTable
        $('#apartmentDataTable').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: "{{route('ajax.apartment.index')}}",
          type: 'GET',
         },
         columns: [
                  {data: 'id', name: 'id'},
                  {data: function(data){
                        url = "{{route('apartment.show', ':apartment')}}";
                        url = url.replace(':apartment', data.id);
                        return "<a href="+url+">"+data.name+"</a>";
                  }, name: 'name' },
                  {data: 'address', name: 'address' },
                  {data: 'users', name: 'users' },
                  {data: 'using_services', name: 'using_services'},
                  {data: function (data){
                        url = "{{route('apartment.edit', ':apartment')}}";
                        url = url.replace(':apartment', data.id);
                        return "<a class='btn btn-primary' href="+url+">Sửa</a>";
                  }, name: 'edit', orderable: false},
                  {data: function (data){
                        return '<button class="btn btn-danger btnDeleteApartment">Xóa</button>';
                  }, name: 'delete', orderable: false},
               ],
        order: [[1, 'asc']]
        });

        //ajax function delete apartment, method POST
        $('#btnDeleteApartment').click(function (){
            alert('dcmm');
        });
        function deleteApartmentFunction(){
            url = "{{route('apartment.destroy', ':apartment')}}";
            url = url.replace(':apartment', data.id);

            alert(data.id + data.name + data.address);

            // $.ajax({
            //     headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     url: url,
            //     type: "post",
            //     data: { 
            //         apartment: apartmentID, 
            //         user: userID
            //     },
            //     success: function(response) {
            //         if(response.success == true){
            //             $('#searchResidentMessageP').removeClass('text-danger').addClass('text-success').text('Thêm vào thành công cư dân: '+userID);
            //         }else if(response.error == true){
            //             if(response.errorType == 1){
            //                 $('#searchResidentMessageP').removeClass('text-success').addClass('text-danger').text('Sai thông tin căn hộ hoặc người dùng');
            //             }else if(response.errorType == 2){
            //                 $('#searchResidentMessageP').removeClass('text-success').addClass('text-danger').text('Người dùng đã thuộc về 1 căn hộ');
            //             }else if(response.errorType == 3){
            //                 $('#searchResidentMessageP').removeClass('text-success').addClass('text-waring').text('Server không thể xử lý');
            //             }
            //         }
            //     },
            //     error: function(xhr) {
            //         console.log(xhr);
            //     }
            // });
        };
    </script>
@endsection