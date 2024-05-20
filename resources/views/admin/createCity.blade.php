@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Cities</h5>
         <form method="POST" action="{{route('admin.store.city')}}" enctype="multipart/form-data">
            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
            </div>
            @if ($errors->has('name'))
              <div class="alert alert-danger">{{$errors->first('name')}}</div>
            @endif
            <div class="form-outline mb-4 mt-4">
              <input type="file" name="image" id="form2Example1" class="form-control"  />
            </div>
            @if ($errors->has('image'))
              <div class="alert alert-danger">{{$errors->first('image')}}</div>
            @endif
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="num_days" id="form2Example1" class="form-control" placeholder="num_days" />
            </div>
            @if ($errors->has('num_days'))
              <div class="alert alert-danger">{{$errors->first('num_days')}}</div>
            @endif
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
            </div>
            @if ($errors->has('price'))
              <div class="alert alert-danger">{{$errors->first('price')}}</div>
            @endif
            <div class="form-outline mb-4 mt-4">

              <select name="country_id" class="form-select  form-control" aria-label="Default select example">
                <option selected>Choose Country</option>
                @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
              </select>
            </div>
            @if ($errors->has('country_id'))
                <div class="alert alert-danger">{{$errors->first('country_id')}}</div>
            @endif
            <label>Select Address From Google Maps</label>
            <input id="lat" type="hidden" name="latitude">
            <input id="lng" type="hidden" name="longitude">
            <div id="map" style="height: 300px"></div>
            <br>
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

      
          </form>

        </div>
      </div>
    </div>
  </div>

  <script src="{{asset('front/map.js')}}"></script>
@endsection