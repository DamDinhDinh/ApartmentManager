@if (session()->has('messages'))
<div class="alert alert-success dismissable">
    <ul>
        @foreach (session()->get('messages') as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif