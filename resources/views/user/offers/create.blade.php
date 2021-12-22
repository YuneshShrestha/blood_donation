@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
    <div class="container px-5">
        <div class="card">
            <div class="card-body">
                @if (session()->has('message'))
                    <p class="text-success">{{ session('message') }}</p>
                @endif
                <form action="/offer" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="offer">Offer:</label>
                            </div>
                            <div class="col-md-8">
                                 <input id="offer" class="form-control" type="text" name="offer" value="{{ old('offer') }}">
                                 @error('offer')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="reward">Reward:</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><img src="{{ asset('/images/coin.png') }}" width="20px" height="20px" alt=""></span>
                                    <input id="reward" class="form-control" placeholder="In Numbers" type="text" name="reward" value="{{ old('reward') }}">
                                </div>
                                @error('reward')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                       
                    </div>
                   <div class="row">
                       <div class="col-md-4"></div>
                       <div class="col-md-8 d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-danger mt-2">Add</button>
                       </div>
                   </div>
                </form>
            </div>
        </div>
    </div>
@endsection