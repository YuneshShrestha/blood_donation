@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
<div class="d-flex justify-content-center mt-3">
    <div class="col-md-6">
        <div class="card px-4 py-2">
            <div class="card-body container">
        @if (Auth::user()->isUser)
          <div>
              @if (session()->has('message'))
                  <p class="text-success">{{ session('message') }}</p>
              @endif
            <form action="/users_details/{{ Auth::id() }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group pb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="blood_group">Blood Group</label>
                        </div>
                        <div class="col-md-8">
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
                    </div>
                </div>
                <div class="form-group pb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="phone">Phone</label>

                        </div>
                        <div class="col-md-8">
                            <input id="phone" class="form-control" type="text" name="phone" value="{{ $user->phone }}">

                        </div>
                    </div>
                </div>
                <div class="form-group pb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="address">Address</label>
                        </div>
                        <div class="col-md-8">
                            <input id="user_address" class="form-control" type="text" name="address" value="{{ $user->address }}">
                        </div>
                    </div>
                    
                </div>
      
                    
                        <div class="form-group pb-2">
                            {{-- <label for="lat">Latitude</label> --}}
                            <input type="hidden" class="form-control" name="lat" id="lat">
                        </div> 
                
                   
                        <div class="form-group pb-2">
                            {{-- <label for="lon">Longitude</label> --}}
                            <input type="hidden" class="form-control" name="lon" id="lon" value="">
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-danger mt-2">Update</button>
                            </div>

                        </div>
    
               
            </form>
            <hr>
            <b>Address Lookup</b>
            <div id="search">
                <input type="text" name="addr" value="" id="addr" size="58" />
                <button type="button" class="btn btn-outline-info" onclick="addr_search();"><i class="fas fa-search"></i></button>
                <div id="results"></div>
            </div>

            <br />

            <div id="map"></div>

          </div>
        @else
        @if (session()->has('message'))
            <p class="text-success">{{ session('message') }}</p>
        @endif
        <form action="/users_details/{{ Auth::id() }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group pb-2">
                <div class="row">
                    <div class="col-md-4">
                        <label for="pan_no">Pan No.</label>
                    </div>
                    <div class="col-md-8">
                         <input type="text" class="form-control" name="pan" value="{{ $user->pan }}">

                    </div>
                    </div>
                </div>
            <div class="form-group pb-2">
                <div class="row">
                    <div class="col-md-4">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="col-md-8">
                         <input id="phone" class="form-control" type="text" name="phone" value="{{ $user->phone }}">
                    </div>
                </div>
            </div>
            <div class="form-group pb-2">
                <div class="row">
                    <div class="col-md-4">
                        <label for="address">Address</label>
                    </div>
                    <div class="col-md-8">
                        <input id="address" class="form-control" type="text" name="address" value="{{ $user->address }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-danger mt-2">Update</button>
                </div>
            </div>
        </form>
        @endif
        </div>
    </div>
</div>
</div>
@endsection