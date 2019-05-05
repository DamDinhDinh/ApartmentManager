@if (session()->has('failures'))
<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <ul>
        @foreach (session()->get('failures') as $failed)
            <li>{{ $failed }}</li>
        @endforeach
    </ul>
</div>
@endif