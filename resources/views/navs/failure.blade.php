@if (session()->has('failures'))
<div class="alert alert-danger">
    <ul>
        @foreach (session()->get('failures') as $failed)
            <li>{{ $failed }}</li>
        @endforeach
    </ul>
</div>
@endif