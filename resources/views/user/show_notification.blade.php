@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
    <div class="container">
        @foreach ($notifications as $notification)
            <div class="gy-4 pb-4 mx-5">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-title">{{ $notification->users->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Sent: {{ $notification->created_at->diffForHumans() }}</h6>
                            <p class="card-text text-danger">
                                {{ $notification->message }}
                            </p>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end align-content-center">
                            @if ($notification->isPending == 0)
                                <a href="/reset_pending/{{ $notification->id }}" class="mt-4">
                                    <button class="btn">Accept <i class="fas fa-check-circle text-danger"></i></button>
                                </a>
                            @else
                               
                                    <p class="mt-4">Accepted <i class="fas fa-check-circle text-success"></i></p>
        
                            @endif

                        </div>
                    </div>
                   
                    {{-- <a href="#" class="card-link">Another link</a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection