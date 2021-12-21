@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
  <div class="d-flex justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body container">
                    <form action="users_details/{{ Auth::id() }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="blood_group">Blood Group</label>
                            <select id="my-select" class="form-control" name="blood_group">
                                <option value="A+">A+</option>
                                <option value="B+">B+</option>
                                <option value="AB+">AB+</option>
                                <option value="O+">O+</option>
                                <option value="A-">A-</option>
                                <option value="B-">B-</option>
                                <option value="AB-">AB-</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input id="phone" class="form-control" type="text" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" class="form-control" type="text" name="address">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
    </div>
  </div>
@endsection