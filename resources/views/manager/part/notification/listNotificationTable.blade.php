<div class="list-notification-table">
    <div style="display: inline-block" class="row">
		<h3 class=" text-black font-weight-bold">{{ trans('headerLabel.notification_info') }}</h3>
    </div> <!-- end div row -->
    <table id="list-notification-table" class="table table-striped table-bordered .table-hover thead-dark">
        <thead>
                <th width="10%">{{ trans('tableLabel.id') }}</th>
                <th width="40%">{{ trans('tableLabel.notification_title') }}</th>
                <th width="20%">{{ trans('tableLabel.updated_at') }}</th>
                <th width="10%">{{ trans('buttonName.edit') }}</th>
                <th width="10%">{{ trans('buttonName.delete') }}</th>
        </thead>
        <tbody>
            @if (count($notifications) > 0)
                @foreach ($notifications as $notification)
                    <tr>
                        <td><a href="{{route('notification.show', ['id' => $notification->id])}}">{{$notification->id}}</a></td>
                        <td><a href="{{route('notification.show', ['id' => $notification->id])}}">{{$notification->title}}</a></td>
                        <td>{{ CarBon\Carbon::parse($notification->updated_at)->format('H:m d-m-Y')}}</td>
                        <td><a href="{{route('notification.edit', ['id' => $notification->id])}}" class="btn btn-primary">{{ trans('buttonName.edit') }}</a></td>
                        <td>
                            <form method="POST" action="{{route('notification.destroy', $notification->id)}}">
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

@section('listNotificationTableJS')
    <script type="text/javascript">
        $(document).ready(function (){
            $("#list-notification-table").DataTable({
                'bpaginate': false
            });
        });
    </script>
@endsection