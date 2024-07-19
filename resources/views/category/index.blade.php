@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="alert alert-success">
  {{session('success')}}
</div>
@endif

<br>
<h3 style="text-align:center">
  All Categories
</h3>
<br>
<a href="{{route('category.create')}}" class="btn btn-success mb-3">
  Create Category
</a>
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Process</th>
    </tr>
  </thead>
  <tbody>
    @foreach($categories as $category)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$category->name}}</td>
      <td> 
        <form action="{{route('category.destroy', $category->id)}}" method="post" class="d-inline">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger">
            Delete
          </button>
        </form>
        <a href="{{route('category.edit', $category->id)}}" class="btn btn-warning d-inline" data-toggle="modal" data-target="#exampleModal{{$category->id}}">
          Edit
        </a>
      </td>
    </tr>

    <!--Edit Modal -->
    <div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$category->id}}" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel{{$category->id}}">Edit Catrgory</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{route('category.update', $category->id)}}">
              @csrf
              @method('PUT')
              <div class="m-4">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control" value="{{$category->name}}">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save changes</button>
          </div>
            </form>
        </div>
      </div>
    </div>
    @endforeach
  </tbody>
</table>

@endsection