@extends('layouts.app')
@section('content')
<form class="m-2" method="POST" action="{{route ('post.update',['slug'=>$post->slug])}}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  
  <div class="my-3 ">
    <label class="form-label">Title</label>
    <input name="title"  type="text" value="{{$post->title}}" class="form-control">
  </div>
  
  <div class="my-4">
    <label class="form-label">Description</label>
    <input name="description" value="{{$post->description}}" type="text" class="form-control">
    
    <img src="/images/{{$post->image_path}}" class="rounded m-4" alt="Cinque Terre" width="304" height="236"> 
    
  <div class="mb-3">
  <label for="formFile" class="form-label">change photo </label>
  <input name="photo" class="form-control" type="file" accept="image/*"  id="formFile">
</div>
  
 <div class="container mt-4">
  <button type="submit" class="btn btn-primary">edit</button>
  </div>
</form>
@endsection