@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Countries</h5>
          <form method="POST" action="{{route('admin.store.country')}}" enctype="multipart/form-data">
          @csrf   
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
            </div>
            @if ($errors->has('name'))
              <div class="alert alert-danger">{{$errors->first('name')}}</div>
            @endif
            <div class="form-outline mb-4 mt-4">
              <input type="file" name="image" id="form2Example1" class="form-control" />
            </div>  
            @if ($errors->has('image'))
            <div class="alert alert-danger">{{$errors->first('image')}}</div>
            @endif
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="continent" id="form2Example1" class="form-control" placeholder="continent" />
            </div> 
            @if ($errors->has('continent'))
              <div class="alert alert-danger">{{$errors->first('continent')}}</div>
            @endif
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="avg_price" id="form2Example1" class="form-control" placeholder="avg_price" />
            </div>
            @if ($errors->has('avg_price'))
              <div class="alert alert-danger">{{$errors->first('avg_price')}}</div>
            @endif
             <div class="form-outline mb-4 mt-4">
              <input type="text" name="population" id="form2Example1" class="form-control" placeholder="population" />
            </div>
            @if ($errors->has('population'))
              <div class="alert alert-danger">{{$errors->first('population')}}</div>
            @endif
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="territory" id="form2Example1" class="form-control" placeholder="territory" />
            </div> 
            @if ($errors->has('territory'))
              <div class="alert alert-danger">{{$errors->first('territory')}}</div>
            @endif
            <div class="form-floating">
              <textarea name="description" class="form-control" placeholder="description" id="floatingTextarea2" style="height: 100px"></textarea>
            </div>
            <br>
            @if ($errors->has('description'))
              <div class="alert alert-danger">{{$errors->first('description')}}</div>
            @endif
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

      
          </form>

        </div>
      </div>
    </div>
  </div>
@endsection