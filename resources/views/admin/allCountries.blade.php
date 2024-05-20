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
            <h5 class="card-title mb-4 d-inline">Countries</h5>
            <a href="{{route('admin.create.country')}}" class="btn btn-primary mb-4 text-center float-right">Create Country</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">population</th>
                    <th scope="col">territory</th>
                    <th scope="col">avg_price</th>
                    <th scope="col">description</th>
                    <th scope="col">continent</th>
                    <th scope="col">delete</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                    <tr>
                        <th scope="row">{{ $country->id }}</th>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->population }}</td>
                        <td>{{ $country->territory }}</td>
                        <td>{{ $country->avg_price }}</td>
                        <td>{{ $country->description }}</td>
                        <td>{{ $country->continent }}</td>
                        <td><a href="{{route('admin.delete.country',$country->id)}}" class="btn btn-danger  text-center ">Delete</a></td>
                    </tr>
                    @endforeach
                
                </tbody>
            </table> 
        </div>
      </div>
    </div>
</div>
@endsection