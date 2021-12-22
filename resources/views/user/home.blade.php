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
            <table class="table table-bordered mt-2">
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
                  @foreach ($offers as $offer)
                    <div class="card mb-2">
                      <div class="card-body">
                        <h5 class="card-title">Offer Title: {{ $offer->offer }}</h5>
                        <p class="card-text text-muted">By: {{ $offer->hospital->name }}</p>
                        <p class="card-text">Required Points: {{ $offer->reward }}</p>
                        <button class="btn btn-primary">Collect</button>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div class="col-md-4 order-md-last order-first">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex justify-content-center">
                          <div>
                            <div class="d-flex justify-content-center">
                              <img src="{{ asset('images/achievement.png') }}" class="img-fluid w-25 text-center" alt="">
                            </div>
                            <div class="d-flex justify-content-center">
                              <h3>Achievement</h3>
                            </div>
                            <div class="d-flex justify-content-center">
                              <p class="text-muted">Your Points</p>
                            </div>
                            <div class="d-flex justify-content-center">
                              <i class="header fs-4">{{ $notification_count*10 }}</i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          @endif  

    @endif
@endsection