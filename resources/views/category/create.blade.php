@extends('layouts.app')
@section('content')


@if($errors->any())
 <div class="alert alert-danger">
   @foreach($errors->all() as $error)
     {{$error}}
   @endforeach
 </div>
@endif

<h3 style="text-align:center;margin-top:14px;">
  Create Category
</h3>

<form class="m-2" method="POST" action="{{route ('category.store')}}">
  @csrf
  
  <div class="m-4 ">
    <label class="form-label">Name</label>
    <input name="name" type="text" class="form-control">
  
  <button type="submit" class="btn btn-primary mt-3">Create</button>
    </div>
</form>
@endsection