@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
            @if(session()->has('delete'))
            
                <div class="alert alert-danger">
                    {{session()->get('delete')}}
                </div>
            @endif
          <h5 class="card-title mb-4 d-inline">Bookings</h5>
        
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">phone_number</th>
                <th scope="col">num_of_geusts</th>
                <th scope="col">checkin_date</th>
                <th scope="col">destination</th>
                <th scope="col">price</th>
                <th scope="col">status</th>
                <th scope="col">edit</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <th scope="row">{{ $booking->id }}</th>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->phone_number }}</td>
                    <td>{{ $booking->num_guests }}</td>
                    <td>{{ $booking->check_in_date }}</td>
                    <td>{{ $booking->destination }}</td>
                    <td>{{ $booking->price }}</td>
                    <td>{{ $booking->status }}</td>
                    <td><a href="{{route('admin.edit.booking',$booking->id)}}" class="btn btn-warning  text-center ">change status</a></td>

                     <td><a href="{{route('admin.delete.booking',$booking->id)}}" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                @endforeach
              
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>
@endsection