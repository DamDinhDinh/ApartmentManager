<div class="list-user-table">
    <div style="display: inline-block" class="row">
        <h3 name="table-name" class=" text-black font-weight-bold">{{ trans('headerLabel.user_info') }}</h3>
    </div>
    {{-- end div row --}}
            <table width="100%" style="text-align: center !important" class="col-md-10 table table-striped table-bordered .table-hover thead-dark">
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Name</th>
                    <th width="20%">Email</th>
                    <th width="20%">Phone Number</th>
                    <th width="10%">Type</th>
                    <th width="10%">Move</th>
                    <th width="10%">Delete</th>  
                </tr>
                @if (count($apartment->users) > 0)
                @php
                    $users = $apartment->users;
                @endphp
                @foreach ($users as $user)
                <tr>
                    <td width="10%"><a href="{{route('user.show', ['id' => $user->id])}}" >{{$user->id}}</a></td>
                    <td width="20%"><a href="{{route('user.show', ['id' => $user->id])}}" >{{$user->name}}</a></td>
                    <td width="20%">{{$user->email}}</td>
                    <td width="20%">{{$user->phone_number}}</td>
                    <td width="10%">{{$user->type}}</td>
                    <td width="10%"><a href="" class="btn btn-primary">Di chuyển</a></td>
                    <td width="10%">
                        <form method="POST" action="{{route('resident.destroy', $apartment->id)}}">
                            {{csrf_field()}}
                            <input type="hidden" name="apartment" value="{{$apartment->id}}">
                            <input type="hidden" name="resident" value="{{$user->id}}">
                            <button class="btn btn-danger"type="submit" onclick="return confirm('Loại bỏ người dùng khỏi căn hộ?')">Loại bỏ</button>
                            {{method_field("DELETE")}}
                        </form>
                    </td>
                </tr>
                @endforeach 
            </table>
                @else
            </table>
                    <h3 class="col-md-10 text-primary font-weight-bold">Hiện không có cư dân nào</h3>
                @endif
</div>
{{-- end div show --}}