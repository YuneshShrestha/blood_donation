@extends('app')
@section('navbar')
    @include('user.components.navbar')
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary" href="/offer/create">Add Offers</a>
        </div>
        <table class="table table-bordered mt-2">
            <thead>
              <tr>
                <th scope="col">SN</th>
                <th scope="col">Hospital</th>
                <th scope="col">Offer</th>
                <th scope="col">Reward</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              
                    @foreach ($offers as $count=>$offer)
                    <tr>
                        <td>{{ ++$count }}</td>
                        <td>{{ $offer->hospital->name }}</td>
                        <td>{{ $offer->offer }}</td>
                        <td>{{ $offer->reward }}</td>
                        <td>
                            @if ($offer->hospital_id == Auth::user()->id)
                                <div>
                                    <div class="row">
                                       <div class="col-6">
                                           <a class="btn btn-success w-100" href="/offer/{{ $offer->id }}/edit">Edit</a>
                                       </div>
                                        <div class="col-6">
                                            <form method="post" action="/offer/{{ $offer->id }}">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" class="btn btn-danger w-100 ml-2" name="submit" id="" value="Delete">
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection