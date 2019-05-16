<div class="list-bill-table">
    <div style="display: inline-block" class="row">
		<h3 class=" text-black font-weight-bold">{{ trans('headerLabel.bill_info') }}</h3>
    </div> <!-- end div row -->
    <table id="list-bill-table" class="table table-striped table-bordered .table-hover thead-dark">
        <thead>
                <th width="10%">{{ trans('tableLabel.id') }}</th>
                <th width="40%">{{ trans('tableLabel.bill_name') }}</th>
                <th width="20%">{{ trans('tableLabel.bill_status') }}</th>
                <th width="10%">{{ trans('buttonName.edit') }}</th>
                <th width="10%">{{ trans('buttonName.delete') }}</th>
        </thead>
        <tbody>
            @if (count($bills) > 0)
                @foreach ($bills as $bill)
                    <tr>
                        <td><a href="{{route('bill.show', ['id' => $bill->id])}}">{{$bill->id}}</a></td>
                        <td><a href="{{route('bill.show', ['id' => $bill->id])}}">{{$bill->name}}</a></td>
                        <td>
                            @php
                                if($bill->status == 0){
                                  echo "<a href=" . route('bill.payment', ['bill' => $bill->id]) .">Chưa thanh toán</a></td>";
                                }else{
                                  if($bill->status == 1){
                                      $url = route('bill.show', ['bill' => $bill->id]);
                                      $label = trans('tableLabel.bill_paid');
                                    
                                      echo "<a href='$url'>$label</a>";
                                  }
                                }
                            @endphp
                        </td>
                        <td><a href="{{route('bill.edit', ['id' => $bill->id])}}" class="btn btn-primary">{{ trans('buttonName.edit') }}</a></td>
                        <td>
                            <form method="POST" action="{{route('bill.destroy', $bill->id)}}">
                                {{csrf_field()}}
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Chắc chắn xóa?')">{{ trans('buttonName.delete') }}</button>
                                {{method_field("DELETE")}}
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

@section('listBillTableJS')
    <script type="text/javascript">
        $(document).ready(function (){
            $("#list-bill-table").DataTable({
                'bpaginate': false
            });
        });
    </script>
@endsection