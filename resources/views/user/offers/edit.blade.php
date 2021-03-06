@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if (session()->has('message'))
                    <p class="text-success">{{ session('message') }}</p>
                @endif
                <form action="/offer/{{ $offer->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="offer">Offer:</label>
                        <input id="offer" class="form-control" type="text" name="offer" value="{{ $offer->offer }}">
                        @error('offer')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="reward">Reward:</label>
                        <input id="reward" class="form-control" type="text" name="reward" value="{{ $offer->reward }}">
                        @error('reward')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-danger mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection