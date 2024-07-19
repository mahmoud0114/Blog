@extends('layouts.app')
@section('content')

@if($errors->any())
  <div class="alert alert-danger">
     <ul>
       @foreach($errors->all() as $error)
        <li>
          {{$error}}
        </li>
       @endforeach
     </ul>
 </div>
@endif


<h3 style="text-align:center;margin-top:14px;">
  Create Tag
</h3>

<form class="m-2" method="POST" action="{{route ('tags.store')}}" enctype="multipart/form-data">
  @csrf
  
  <div class="m-4 ">
    <label class="form-label">Name</label>
    <input name="name" type="text" class="form-control">
  
  <button type="submit" class="btn btn-primary mt-3">Create</button>
    </div>
</form>
@endsection