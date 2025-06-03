@extends('layouts.master')

@section('header')
Attendant Management
@endsection

@section('content')

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toast.fire({
            icon: 'success',
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
            title: '{{ $errors->first() }}'
        });
    });
</script>
@endif

<div class="row">
    <!-- Left col: Create Attendant -->
    <section class="col-lg-5 connectedSortable">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Attendant</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('attendant.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="position">Position</label>


                        <select id="position" name="position" class="form-control" required>
                            
                            <option selected>select position</option>
                            <option value="Physician">Physician</option>
                            <option value="Nurse">Nurse</option>
                            <option value="Midwife">Midwife</option>
                            <option value="Hilot">Hilot</option>

                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label> <span class="text-red">* (brgy|city) format</span>
                        <input type="text" id="address" name="address" class="form-control">
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success col-lg-12">Create Attendant</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Right col: Attendant List -->
    <section class="col-lg-7 connectedSortable">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Attendant List</h3>
            </div>
            <div class="card-body">
                <table class="table table-head-fixed text-nowrap" id="example3">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendants as $attendant)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $attendant->name }}</td>
                            <td>{{ $attendant->position }}</td>
                            <td>{{ $attendant->address }}</td>
                            <td>
                                <button type="button"
                                        class="btn btn-warning"
                                        data-id="{{ $attendant->id }}"
                                        data-name="{{ $attendant->name }}"
                                        data-position="{{ $attendant->position }}"
                                        data-address="{{ $attendant->address }}"
                                        onclick="openEditModal(this)">
                                    Edit
                                </button>

                                <form action="{{ route('attendant.destroy', $attendant) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this attendant?')">Delete</button>
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

<!-- Edit Modal -->
<div class="modal fade" id="editAttendantModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="editAttendantForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h4 class="modal-title">Edit Attendant</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                   
                        <select id="edit_position" name="position" class="form-control" required>
                            
                            <option selected>select position</option>
                            <option value="Physician">Physician</option>
                            <option value="Nurse">Nurse</option>
                            <option value="Midwife">Midwife</option>
                            <option value="Hilot">Hilot</option>

                        </select>









                    </div>
                    <div class="form-group">
                        <label>Address</label><span class="text-red">* (brgy|city) format</span>
                        <input type="text" id="edit_address" name="address" class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(button) {
        let id = $(button).data('id');
        let name = $(button).data('name');
        let position = $(button).data('position');
        let address = $(button).data('address');

        $('#edit_name').val(name);
        $('#edit_position').val(position);
        $('#edit_address').val(address);
        $('#editAttendantForm').attr('action', '/attendant/' + id);

        $('#editAttendantModal').modal('show');
    }
</script>

@endsection
