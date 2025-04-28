@extends('layouts.master')
@section('header')
Patient Management
@endsection
@section('style')
<style type="text/css">
    th{
        text-align: center;
    }
</style>
@endsection
@section('content')
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
<div class="row">
    <section class="col-lg-7 connectedSortable"> {{-- patients.storeMother --}}
     <form action="{{ route('patients.storeprofile') }}" method="POST">
      @csrf
      <input type="hidden" name="data_spec" value="mother">
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="pt-2 px-3">
              <h3 class="card-title">Register New Patient</h3>
          </li>
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
<div class="card-footer">
  <button type="submit" id="submitButton" class="btn btn-primary col-lg-12">Register Patient</button>
</div>
</div>
</form>
</section>
<section class="col-lg-5 connectedSortable">
 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Maternals List</h3>
  </div>
  <div class="card-body">
      <table class="table table-bordered table-hover table-head-fixed text-nowrap " id="maternityTable">
        <thead>
            <tr>
                <th style="width: 10px">No.</th>
                <th>Name</th>
                <th >Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mothers as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ ucwords($data->full_name) }}</td>
                    <td style="text-align: center;">
                        
                        <a href="{{ route('patients.show', $data['id']) }}" class="btn btn-sm btn-primary">View Details</a>

                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</section>
</div>{{-- end of row --}}
@endsection
@section('scripts')
<script type="text/javascript">
  $(function () {
    $('#maternityTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
  });
});
</script>

<script>
    document.getElementById('submitButton').addEventListener('click', function() {
        // Disable the submit button to prevent multiple clicks
        this.disabled = true;
        // Optionally, you can show some loading animation here
    });
</script>



@endsection