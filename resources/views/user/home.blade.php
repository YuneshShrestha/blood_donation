@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
    @if (!(Auth::user()->isUser))
        @if (!isset(Auth::user()->pan))
            <div class="container">
              <p class="text-danger">Please fill the data in details tab</p>
            </div>            
        @else
           <div class="container">
            <div class="d-flex justify-content-end">
                <a class="btn btn-danger my-3" href="/show_map">View Data In Map</a>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Name</th>
                    <th scope="col">Blood Group</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Message</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $count=>$user)
                    <tr>
                        <th scope="row">{{ ++$count }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->blood_group }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td><a class="btn btn-primary" href="/send_notification/{{ $user->id }}">Message</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
           </div>
        @endif
        @else
          @if (!isset(Auth::user()->blood_group) || !isset(Auth::user()->phone) || !isset(Auth::user()->address) || !isset(Auth::user()->lat) || !isset(Auth::user()->lon))
           <div class="container">
            <p class="text-danger">Please fill the data in details tab</p>
           </div>
          @else
            <div class="container">
              <div class="row">
                
                <div class="col-md-8 mr-2">
                  <h3>Offer List</h3>
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Offer Title:</h5>
                      <p class="card-text">By:</p>
                      <p class="card-text">Required Points:</p>
                      <button class="btn btn-primary">Collect</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 order-md-last order-first">
                  <h3>Score:</h3>
                  <p class="header">{{ $notification_count*10 }}</p>
                </div>
              </div>
            </div>
          @endif  

    @endif
@endsection