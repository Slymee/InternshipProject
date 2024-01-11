@if (auth()->user()->username)
    {{ auth()->user()->username }}
@else
    not logged in
@endif
