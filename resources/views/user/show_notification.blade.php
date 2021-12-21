@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
    <div class="container">
        @foreach ($notifications as $notification)
            <div class="gy-4 pb-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">{{ $notification->users->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Sent: {{ $notification->created_at->diffForHumans() }}</h6>
                    <p class="card-text">
                        {{ $notification->message }}
                    </p>
                    @if ($notification->isPending == 0)
                        <a href="/reset_pending/{{ $notification->id }}" class="btn-sm btn-primary card-link">Accept</a>
                    @endif
                    {{-- <a href="#" class="card-link">Another link</a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection