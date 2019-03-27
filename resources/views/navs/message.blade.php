@if (session()->has('messages'))
<div class="alert alert-success">
    <ul>
        @foreach (session()->get('messages') as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif