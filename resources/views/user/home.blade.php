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
            <p>Good To go</p> 
          @endif  

    @endif
@endsection