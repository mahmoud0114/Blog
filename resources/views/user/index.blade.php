@extends('layouts.app')
@section('content')
<br>

@if(session('success'))
<div class="alert alert-success">
  {{session('success')}}
</div>
@endif
<div class="table-responsive my-4">
  <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Type</th>
        <th>Processes</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 0; ?>
      @foreach ($users as $user)
      <tr>
        <?php $i++; ?>
        <td>{{ $i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->type }}</td>
        <td>
          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $user->id }}">Edit permission</button>

        </td>
      </tr>

      <!-- edit_modal_User permission-->
      <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> Edit User Permission
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <!-- edit_form -->
              <form action="{{route ('user.update',$user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col">
<label for="type" class="mt-3">
  Select User Permission
</label>
<select id="type" class="form-select" aria-label="Default select example" name="type">
  <option value="writer" {{ $user->type == 'writer' ? 'selected' : '' }}>writer</option>
  <option value="user" {{ $user->type == 'user' ? 'selected' : '' }}>user</option>
  <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>Admin</option>
</select>

                  </div>

                </div>
                <br><br>
                <div class="modal-footer">

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                  </button>

                  <button type="submit" class="btn btn-success">submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      @endforeach
    </table>
  </div>
  <br>
  <br>
  @endsection