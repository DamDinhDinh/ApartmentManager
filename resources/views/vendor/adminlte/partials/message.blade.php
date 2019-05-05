@if (session()->has('messages'))
<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <ul>
        @foreach (session()->get('messages') as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif