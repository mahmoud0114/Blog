@extends('layouts.app')
@section('content')

<form class="m-2" method="POST" action="{{route ('post.store')}}" enctype="multipart/form-data">
  @csrf
  
  @if($errors->any())
   @foreach($errors->all() as $error )
   <div class="alert alert-danger">
          {{$error}}
   </div>

   @endforeach
  @endif
  
  
  <div class="mt-2 ">
    <label class="form-label">Title</label>
    <input name="title" value="{{old('title')}}" type="text" class="form-control">
  </div>
  
  <div class="my-2">
     <label class="form-label">Description</label>
    <input name="description" value="{{old('description')}}" class="form-control">
  </div>
  
   
<select class="form-select mt-3" aria-label="Default select example" name="cat">
  <option disabled selected>Select Category</option>
   @foreach($category as $c )
  <option value="{{$c->id}}">{{$c->name}}</option>
       @endforeach
</select>


<select multiple class="form-select mt-3" aria-label="Default select example" name="tags[]">
<option disabled selected>Select Tag</option>
   @foreach($tags as $tag )
  <option value="{{$tag->id}}">{{$tag->name}}</option>
       @endforeach
</select>

  
<div class="mb-3">
  <label for="formFile" class="form-label"></label>
  <input name="photo" class="form-control" type="file" accept="image/*" multiple id="formFile">
</div>
  <br>
  
  <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection