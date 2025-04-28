@extends('layouts.master')

@section('style')

@endsection


@section('header')
<strong>Name:</strong> {{ $profile_clinic->full_name }}
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
    <div class="card card-success card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Patient Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Husband Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Child</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Form Generate</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <!-- Patient Profile Tab -->
                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Birth Date:</strong> {{ $profile_clinic->formatted_birth_date }} ({{ $profile_clinic->age }} years old)</li>
                        <li class="list-group-item"><strong>Place of Birth:</strong> {{ $profile_clinic->full_place_of_birth }}</li>
                        <li class="list-group-item"><strong>Residence:</strong> {{ $profile_clinic->full_residence }}</li>
                        <li class="list-group-item"><strong>Phone:</strong> {{ $profile_clinic->phone }}</li>
                        <li class="list-group-item"><strong>Occupation:</strong> {{ $profile_clinic->occupation }}</li>
                        <li class="list-group-item"><strong>Religion:</strong> {{ $profile_clinic->religion }}</li>
                        <li class="list-group-item"><strong>Citizenship:</strong> {{ $profile_clinic->citizenship }}</li>
                    </ul>
                </div>

                <!-- Husband Profile Tab -->
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    @if ($profile_clinic->husband)
                        <h5>

<strong>Name:</strong> {{ $profile_clinic->husband->full_name }}



                        </h5>


   <ul class="list-group">
                        <li class="list-group-item"><strong>Birth Date:</strong> {{ $profile_clinic->husband->formatted_birth_date }} ({{ $profile_clinic->husband->age }} years old)</li>
                        <li class="list-group-item"><strong>Place of Birth:</strong> {{ $profile_clinic->husband->full_place_of_birth }}</li>
                        <li class="list-group-item"><strong>Residence:</strong> {{ $profile_clinic->husband->full_residence }}</li>
                        <li class="list-group-item"><strong>Phone:</strong> {{ $profile_clinic->husband->phone }}</li>
                        <li class="list-group-item"><strong>Occupation:</strong> {{ $profile_clinic->husband->occupation }}</li>
                        <li class="list-group-item"><strong>Religion:</strong> {{ $profile_clinic->husband->religion }}</li>
                        <li class="list-group-item"><strong>Citizenship:</strong> {{ $profile_clinic->husband->citizenship }}</li>
                    </ul>




                    @else
                
              

        <button type="button" class="btn btn-warning" 
                onclick="openEditModal({{ $profile_clinic->id }})">
            No husband data found.
        </button>





                    @endif
                </div>

                <!-- Child Profile Tab -->
 <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
    @if ($profile_clinic->relationshipAsMother && $profile_clinic->relationshipAsMother->children()->isNotEmpty())
        <h5>Children</h5>
        <ul>
            @foreach ($profile_clinic->relationshipAsMother->children() as $child)
                <li><strong>{{ $child->first_name }} {{ $child->last_name }} (Age: {{ $child->age }})</strong></li>
            @endforeach
        </ul>
    @else
        <p>No children data found.</p>
    @endif
</div>


                <!-- Settings Tab -->
                <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                    <p>Settings content goes here.</p>
                </div>
            </div>
        </div>
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



 <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
      <div class="modal-header">
              <h4 class="modal-title">Husband Detail</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('patients.storeprofile') }}" method="POST">
      @csrf
      <input type="hidden" name="data_spec" value="father">
      <input type="hidden" name="mother_id" id="mother_id">
      <div class="card card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
        
          <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Basic Info</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Birth Info</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Contact Info</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Other Info</a>
          </li>
      </ul>
  </div>
  <div class="card-body">
      <div class="tab-content" id="custom-tabs-two-tabContent">
        {{-- Basic Information Tab --}}
        <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
            <div class="row">
                <div class="col-lg-7">
                    <div class="form-group">
                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                </div>
                <div class="col-lg-5">
                <div class="form-group">
    <label for="suffix">Suffix</label>
    <select name="suffix" class="form-control">
        <option value="">None</option>
        <option value="Jr.">Jr.</option>
        <option value="Sr.">Sr.</option>
        <option value="II">II</option>
        <option value="III">III</option>
        <option value="IV">IV</option>
        <option value="V">V</option>
    </select>
</div>

            </div>
        </div>
        <div class="form-group">
            <label for="middle_name">Middle Name</label>
            <input type="text" name="middle_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name <span class="text-danger">*</span></label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
    </div>
    {{-- Profile Tab --}}
    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
  <div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="birth_date">Date of Birth <span class="text-danger">*</span></label>
            <input type="date" name="birth_date" id="birth_date" class="form-control" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="birth_date_age">Age</label>
            <input type="text" name="birth_date_age" id="birth_date_age" class="form-control" readonly>
        </div>
    </div>
</div>

 <hr>
 <h5>Place of Birth</h5>
 <div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="place_of_birth_region">Region</label>
            <select id="place_of_birth_region" name="place_of_birth_region" class="form-control">
                <option value="">Select Region</option>
                @foreach ($regions as $region)
                <option value="{{ $region->region_id }}">{{ $region->region_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="place_of_birth_province">Province</label>
            <select id="place_of_birth_province" name="place_of_birth_province" class="form-control" disabled>
                <option value="">Select Province</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="place_of_birth_municipality">Municipality</label>
            <select id="place_of_birth_municipality" name="place_of_birth_municipality" class="form-control" disabled>
                <option value="">Select Municipality</option>
            </select>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="place_of_birth_barangay">Barangay</label>
            <select id="place_of_birth_barangay" name="place_of_birth_barangay" class="form-control" disabled>
                <option value="">Select Barangay</option>
            </select>
        </div>
    </div>
</div>


</div>
{{-- Messages Tab --}}
<div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
    <div class="form-group col-lg-6">
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" class="form-control">
    </div>
    <hr>
<h5>Residence</h5>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="residence_region">Region</label>
            <select id="residence_region" name="residence_region" class="form-control">
                <option value="">Select Region</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->region_id }}">{{ $region->region_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="residence_province">Province</label>
            <select id="residence_province" name="residence_province" class="form-control" disabled>
                <option value="">Select Province</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="residence_municipality">Municipality</label>
            <select id="residence_municipality" name="residence_municipality" class="form-control" disabled>
                <option value="">Select Municipality</option>
            </select>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="residence_barangay">Barangay</label>
            <select id="residence_barangay" name="residence_barangay" class="form-control" disabled>
                <option value="">Select Barangay</option>
            </select>
        </div>
    </div>
</div>

</div>
{{-- Settings Tab --}}
<div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
  <div class="form-group">
    <label for="occupation">Occupation</label>
    <input type="text" name="occupation" class="form-control">
</div>
<div class="form-group">
    <label for="religion">Religion</label>
    <input type="text" name="religion" class="form-control">
</div>
<div class="form-group">
    <label for="citizenship">Citizenship</label>
    <input type="text" name="citizenship" class="form-control">
</div>
</div>
</div>
</div>

</div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="submitButton" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->





@endsection



@section('scripts')


<script>
    document.getElementById('submitButton').addEventListener('click', function() {

        this.disabled = true;

    });
</script>

<script type="text/javascript">
function openEditModal(mother_id){
    $('#mother_id').val(mother_id); // Set the mother_id value
    $('#modal-lg').modal('show');    // Open the modal
}

// When the modal is closed, reset the input value to null
$('#modal-lg').on('hidden.bs.modal', function () {
    $('#mother_id').val(null);
});
</script>
@endsection
