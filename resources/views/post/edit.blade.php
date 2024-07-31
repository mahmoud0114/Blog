@extends('layouts.app')
@section('content')

@if($errors->any())
 @foreach($errors->all() as $error )
  <div class="alert alert-danger">
    {{$error}}
  </div>
 @endforeach
 @endif
<form class="m-2" method="POST" action="{{route ('post.update',['slug'=>$post->slug])}}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="my-3 ">
    <label class="form-label">Title</label>
    <input name="title" type="text" value="{{$post->title}}" class="form-control">
  </div>

  <div class="my-4">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">
      {{$post->description}}
    </textarea>

    @php
    $isExternal = filter_var($post->image_path, FILTER_VALIDATE_URL);
    @endphp

    <img loading="lazy"
    src="{{ $isExternal ? $post->image_path : asset('images/' . $post->image_path) }}"
    class="img-fluid"
    alt="{{ $post->title }}">

    <div class="mb-3">
      <label for="formFile" class="form-label">change photo </label>
      <input name="photo" class="form-control" type="file" accept="image/*" id="formFile">
    </div>

    <div class="container mt-4">
      <button type="submit" class="btn btn-primary">edit</button>
    </div>
  </form>
  @endsection