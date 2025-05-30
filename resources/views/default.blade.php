@extends('layouts.master')

@section('style')

@endsection


@section('header')

@endsection
@section('content')
@php
$roles = [];
@endphp
<!-- Check for Session Success -->
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toast.fire({
            icon: '{{ session('icon') }}',
            title: '{{ session('success') }}'
        });
    });
</script>
@endif

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toast.fire({
            icon: 'error',
            title: '{{ $errors->first() }}'  // Show the first validation error
        });
    });
</script>
@endif

<!-- Main Content -->
<div class="row">
    <section class="col-lg-6 connectedSortable">
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Register Patient</h3>
    </div>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="role_name">Role Name</label>
                <input type="text" id="role_name" name="role_name" class="form-control" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success col-lg-12">Create Role</button>
        </div>
    </form>
</div>

</section>

<!-- Right col: Role List -->
<section class="col-lg-6 connectedSortable">
 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Role List</h3>
  </div>
  <div class="card-body">
      <table class="table table-head-fixed text-nowrap" id="example3">
        <thead>
            <tr>
                <th style="width: 10px">No.</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $data)
                @if ($data->id == 1)
                    @continue
                @endif
                <tr>
                    <td>{{ $loop->iteration - 1 }}</td>
                    <td>{{ $data->role_name }}</td>
                    <td>

           <button type="button" class="btn btn-warning" data-role-id="{{ $data->id }}" data-name="{{ $data->role_name }}" onclick="openEditModal({{ $data->id }})">
    Edit
</button>


                    <button type="button" class="btn btn-info" onclick="openModuleModal({{ $data->id }})" data-name="{{ $data->role_name }}">
                        Manage Modules
                    </button>
                    <form action="{{ route('roles.destroy', $data) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</section>
</div>

@endsection



@section('scripts')

@endsection
