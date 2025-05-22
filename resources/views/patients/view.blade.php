@extends('layouts.master')
@section('style')
@endsection
@section('header')
Patient Management
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
            title: '{{ $errors->first() }}'  
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
        
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    @include('patients.tabs.patient')
                    @include('patients.tabs.husband')
        
                    @include('patients.tabs.settings')
                    @include('patients.partials.modals')
                </div>
            </div>
        </div>






        <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id="editProfileForm" method="POST" action="{{ route('patients.update') }}">
                    @csrf
                    <input type="hidden" name="profile_id" id="aedit_profile_id">
                    <input type="hidden" name="sino" id="sino">


                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Profiles</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="card card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="edit-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="tab-basic" data-toggle="pill" href="#tab-basic-pane" role="tab" aria-controls="tab-basic-pane" aria-selected="true">Basic Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-birth" data-toggle="pill" href="#tab-birth-pane" role="tab" aria-controls="tab-birth-pane" aria-selected="false">Birth Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-contact" data-toggle="pill" href="#tab-contact-pane" role="tab" aria-controls="tab-contact-pane" aria-selected="false">Contact Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-other" data-toggle="pill" href="#tab-other-pane" role="tab" aria-controls="tab-other-pane" aria-selected="false">Other Info</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="edit-tabs-content">

                                        {{-- Basic Info --}}
                                        <div class="tab-pane fade show active" id="tab-basic-pane" role="tabpanel" aria-labelledby="tab-basic">
                                            <div class="row">
                                                <div class="col-lg-7">
                                                    <x-form.input-text name="first_name" label="First Name" id="aedit_first_name" required />
                                                </div>
                                                <div class="col-lg-5">
                                                    <x-form.select name="suffix" label="Suffix" id="edit_suffix"
                                                    :options="['' => 'None', 'Jr.' => 'Jr.', 'Sr.' => 'Sr.', 'II' => 'II', 'III' => 'III']" />
                                                </div>
                                            </div>
                                            <x-form.input-text name="middle_name" label="Middle Name" id="aedit_middle_name" />
                                            <x-form.input-text name="last_name" label="Last Name" id="aedit_last_name" required />

                                        </div>

                                        {{-- Birth Info --}}
                                        <div class="tab-pane fade" id="tab-birth-pane" role="tabpanel" aria-labelledby="tab-birth">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <x-form.input-date name="birth_date" label="Date of Birth" id="aedit_birth_date" required />
                                                </div>
                                                <div class="col-lg-6">

                                                   <x-form.input-text name="birth_date_age" id="aedit_birth_date_age" label="Age" readonly/>
                                               </div>
                                           </div>
                                           <hr>
                                           <h5>Place of Birth</h5>
                                           <x-form.location-select prefix="aedit_place_of_birth" :regions="$regions" />

                                       </div>

                                       {{-- Contact Info --}}
                                       <div class="tab-pane fade" id="tab-contact-pane" role="tabpanel" aria-labelledby="tab-contact">
                                        <div class="form-group col-lg-6">
                                            <x-form.input-number name="phone" label="Phone Number" id="aedit_phone" />
                                        </div>
                                        <hr>
                                        <h5>Residence</h5>
                                        <x-form.location-select prefix="aedit_residence" :regions="$regions" />
                                    </div>

                                    {{-- Other Info --}}
                                    <div class="tab-pane fade" id="tab-other-pane" role="tabpanel" aria-labelledby="tab-other">
                                       <x-reference.occupation ref="ROccupation" name="occupation" id="aedit_occupation" />

                                        <x-reference.religion ref="RReligion" name="religion"  id="aedit_religion" label="Religion" />

                                    <x-reference.citizenship ref="RCitizenship" name="citizenship" id="aedit_citizenship" label="Citizenship" />



                                        </div>

                                    </div> <!-- /.tab-content -->
                                </div> <!-- /.card-body -->
                            </div> <!-- /.card -->
                        </div> <!-- /.modal-body -->

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>

                    </div> <!-- /.modal-content -->
                </form>
            </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->











        <script type="text/javascript">
            function openEditProfileModal(profileId, sins) {
                $.get(`/patients/clinic-profiles/${profileId}/edit`, function (data) {
console.log(data.profile_id)

        // ====== Basic Info ======
                    $('#aedit_first_name').val(data.first_name);
                    $('#aedit_middle_name').val(data.middle_name);
                    $('#aedit_last_name').val(data.last_name);
                    $('#aedit_suffix').val(data.suffix);
                    $('#aedit_birth_date').val(data.birth_date);
                    $('#aedit_birth_date_age').val(data.age);
                    $('#aedit_profile_id').val(data.profile_id);


                    $('#aedit_phone').val(data.phone);
                    $('#sino').val(sins);

                    $('#aedit_religion').val(data.religion);
                    $('#aedit_citizenship').val(data.citizenship);
                    $('#aedit_occupation').val(data.occupation);
                    


        // ====== Place of Birth ======
                    $('#aedit_place_of_birth_region').val(data.pob_region);
                    populateSelect('#aedit_place_of_birth_province', data.pob_provinces, data.pob_province);
                    populateSelect('#aedit_place_of_birth_municipality', data.pob_cities, data.pob_city);
                    populateSelect('#aedit_place_of_birth_barangay', data.pob_barangays, data.pob_brgy);

        // ====== Residence ======
                    $('#aedit_residence_region').val(data.res_region);
                    populateSelect('#aedit_residence_province', data.res_provinces, data.res_province);

        // Populate cities and barangays for residence
                    populateSelect('#aedit_residence_municipality', data.res_cities, data.res_city);
                    populateSelect('#aedit_residence_barangay', data.res_barangays, data.res_brgy);

        // ====== Show Modal ======
                    $('#editProfileModal').modal('show');
                });
            }

            function populateSelect(selector, items, selectedValue) {
                const $select = $(selector);
    $select.empty().append('<option value="">Select</option>');  // Clear existing options

  
    if (items && items.length > 0) {
        items.forEach(item => {
            // Dynamically detect ID and name fields
            let id = item.barangay_id || item.municipality_id || item.province_id || item.id;
            let name = item.barangay_name || item.municipality_name || item.province_name || item.region_name || 'Unknown';

            // Check if the current item's ID matches the selected value
            let selected = (id == selectedValue) ? 'selected' : ''; 

            // Append the option with the correct selected attribute
            $select.append(`<option value="${id}" ${selected}>${name}</option>`);
        });
    } else {
        $select.append('<option value="">No options available</option>');
    }
}

</script>










</section>
<!-- Right col: Role List -->
<section class="col-lg-6 connectedSortable">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">List of Children</h3>

           
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             @include('patients.tabs.children')
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

</section>
</div>
@endsection
@section('scripts')


@endsection