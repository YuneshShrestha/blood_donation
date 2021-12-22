@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="/offer" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="offer">Offer:</label>
                        <input id="offer" class="form-control" type="text" name="offer">
                    </div>
                    <div class="form-group">
                        <label for="reward">Reward:</label>
                        <input id="reward" class="form-control" type="text" name="reward">
                    </div>
                    <button type="submit" class="btn btn-outline-danger mt-2">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection