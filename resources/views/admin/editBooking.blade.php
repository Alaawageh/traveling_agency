@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4 d-inline">Change Booking Status {{$booking->status}}</h5>
            <form method="POST" action="{{route('admin.update.booking',$booking->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-outline mb-4 mt-4">

                    <select name="status" class="form-select  form-control" aria-label="Default select example">
                        <option selected>Choose status</option>
                        <option value="Processing">Processing</option>
                        <option value="Booking">Booking</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

            </form>
        </div>
      </div>
    </div>
</div>
@endsection