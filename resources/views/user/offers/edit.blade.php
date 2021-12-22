@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="/offer/{{ $offer->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="offer">Offer:</label>
                        <input id="offer" class="form-control" type="text" name="offer" value="{{ $offer->offer }}">
                    </div>
                    <div class="form-group">
                        <label for="reward">Reward:</label>
                        <input id="reward" class="form-control" type="text" name="reward" value="{{ $offer->reward }}">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection