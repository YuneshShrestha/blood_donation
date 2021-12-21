@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
<div class="d-flex justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body container">
        @if (Auth::user()->isUser)
          <div>
            <form action="/users_details/{{ Auth::id() }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="blood_group">Blood Group</label>
                    <select id="my-select" class="form-control" name="blood_group">
                        <option value="A+" {{ $user->blood_group=="A+" ? 'selected' : ''}}>A+</option>
                        <option value="B+" {{ $user->blood_group=="B+" ? 'selected' : ''}}>B+</option>
                        <option value="AB+" {{ $user->blood_group=="AB+" ? 'selected' : ''}}>AB+</option>
                        <option value="O+" {{ $user->blood_group=="O+" ? 'selected' : ''}}>O+</option>
                        <option value="A-" {{ $user->blood_group=="A-" ? 'selected' : ''}}>A-</option>
                        <option value="B-" {{ $user->blood_group=="B-" ? 'selected' : ''}}>B-</option>
                        <option value="AB-" {{ $user->blood_group=="AB-" ? 'selected' : ''}}>AB-</option>
                        <option value="O-" {{ $user->blood_group=="O-" ? 'selected' : ''}}>O-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" class="form-control" type="text" name="phone" value="{{ $user->phone }}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input id="user_address" class="form-control" type="text" name="address" value="{{ $user->address }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lat">Latitude</label>
                            <input type="text" class="form-control" name="lat" id="lat">
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lon">Longitude</label>
                            <input type="text" class="form-control" name="lon" id="lon" value="">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Save/Update</button>
            </form>
            <hr>
            <b>Address Lookup</b>
            <div id="search">
                <input type="text" name="addr" value="" id="addr" size="58" />
                <button type="button" class="btn btn-primary" onclick="addr_search();">Search</button>
                <div id="results"></div>
            </div>

            <br />

            <div id="map"></div>

          </div>
        @else
        <form action="/users_details/{{ Auth::id() }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="blood_group">Pan No.</label>
               <input type="text" class="form-control" name="pan" value="{{ $user->pan }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input id="phone" class="form-control" type="text" name="phone" value="{{ $user->phone }}">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input id="address" class="form-control" type="text" name="address" value="{{ $user->address }}">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update/Create</button>
        </form>
        @endif
        </div>
    </div>
</div>
</div>
@endsection