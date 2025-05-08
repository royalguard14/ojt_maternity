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
                    @include('patients.tabs.patient')
                    @include('patients.tabs.husband')
                    @include('patients.tabs.children')
                    @include('patients.tabs.settings')
                    @include('patients.partials.modals')
                </div>
            </div>
        </div>






<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editProfileForm" method="POST" action="{{ route('patients.update') }}">
            @csrf
            <input type="hidden" name="profile_id" id="edit_profile_id">
            <input type="hidden" name="role" id="edit_profile_role">
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
                                            <x-form.input-text name="first_name" label="First Name" id="edit_first_name" required />
                                        </div>
                                        <div class="col-lg-5">
                                            <x-form.select name="suffix" label="Suffix" id="edit_suffix"
                                                :options="['' => 'None', 'Jr.' => 'Jr.', 'Sr.' => 'Sr.', 'II' => 'II', 'III' => 'III']" />
                                        </div>
                                    </div>
                                    <x-form.input-text name="middle_name" label="Middle Name" id="edit_middle_name" />
                                    <x-form.input-text name="last_name" label="Last Name" id="edit_last_name" required />
                              
                                </div>

                                {{-- Birth Info --}}
                                <div class="tab-pane fade" id="tab-birth-pane" role="tabpanel" aria-labelledby="tab-birth">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <x-form.input-date name="birth_date" label="Date of Birth" id="edit_birth_date" required />
                                        </div>
                                        <div class="col-lg-6">
                                        
                                         <x-form.input-text name="birth_date_age" id="edit_birth_date_age"  readonly/>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Place of Birth</h5>
                                    <x-form.location-select prefix="edit_place_of_birth" :regions="$regions" />

                                </div>

                                {{-- Contact Info --}}
                                <div class="tab-pane fade" id="tab-contact-pane" role="tabpanel" aria-labelledby="tab-contact">
                                    <div class="form-group col-lg-6">
                                        <x-form.input-number name="phone" label="Phone Number" id="edit_phone" />
                                    </div>
                                    <hr>
                                    <h5>Residence</h5>
                                    <x-form.location-select prefix="edit_residence" :regions="$regions" />
                                </div>

                                {{-- Other Info --}}
                                <div class="tab-pane fade" id="tab-other-pane" role="tabpanel" aria-labelledby="tab-other">
                                    <x-form.input-text name="occupation" label="Occupation" id="edit_occupation" />
                                    <x-form.input-text name="religion" label="Religion" id="edit_religion" />
                                    <x-form.input-text name="citizenship" label="Citizenship" id="edit_citizenship" />
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
    
    $(document).ready(function() {
    // When region is selected, populate the provinces
    $('#edit_place_of_birth_region').on('change', function() {
        var regionId = $(this).val(); // Get selected region ID

        if (regionId) {
            // Fetch provinces based on the region
            $.get('/get-provinces-from-region/' + regionId, function(data) {
                var provinceSelect = $('#edit_place_of_birth_province');
                provinceSelect.empty().prop('disabled', false); // Enable province dropdown
                provinceSelect.append('<option value="">Select Province</option>'); // Reset options

                // Append the province options
                $.each(data.provinces, function(index, province) {
                    provinceSelect.append('<option value="' + province.province_id + '">' + province.province_name + '</option>');
                });

                // Trigger change event to load municipalities
                provinceSelect.trigger('change');
            });
        } else {
            $('#edit_place_of_birth_province').empty().prop('disabled', true); // Disable province dropdown
            $('#edit_place_of_birth_city').empty().prop('disabled', true); // Disable city dropdown
            $('#edit_place_of_birth_brgy').empty().prop('disabled', true); // Disable barangay dropdown
        }
    });

    // When province is selected, populate the municipalities
    $('#edit_place_of_birth_province').on('change', function() {
        var provinceId = $(this).val(); // Get selected province ID

        if (provinceId) {
            // Fetch municipalities based on the province
            $.get('/get-municipalities-from-province/' + provinceId, function(data) {
                var municipalitySelect = $('#edit_place_of_birth_city');
                municipalitySelect.empty().prop('disabled', false); // Enable city dropdown
                municipalitySelect.append('<option value="">Select Municipality</option>'); // Reset options

                // Append the municipality options
                $.each(data.municipalities, function(index, municipality) {
                    municipalitySelect.append('<option value="' + municipality.municipality_id + '">' + municipality.municipality_name + '</option>');
                });

                // Trigger change event to load barangays
                municipalitySelect.trigger('change');
            });
        } else {
            $('#edit_place_of_birth_city').empty().prop('disabled', true); // Disable city dropdown
            $('#edit_place_of_birth_brgy').empty().prop('disabled', true); // Disable barangay dropdown
        }
    });

    // When municipality is selected, populate the barangays
    $('#edit_place_of_birth_city').on('change', function() {
        var cityId = $(this).val(); // Get selected municipality ID

        if (cityId) {
            // Fetch barangays based on the municipality
            $.get('/get-barangays-from-city/' + cityId, function(data) {
                var barangaySelect = $('#edit_place_of_birth_brgy');
                barangaySelect.empty().prop('disabled', false); // Enable barangay dropdown
                barangaySelect.append('<option value="">Select Barangay</option>'); // Reset options

                // Append the barangay options
                $.each(data.barangays, function(index, barangay) {
                    barangaySelect.append('<option value="' + barangay.barangay_id + '">' + barangay.barangay_name + '</option>');
                });
            });
        } else {
            $('#edit_place_of_birth_brgy').empty().prop('disabled', true); // Disable barangay dropdown
        }
    });

    // On edit profile modal open, prefill the fields (for place of birth as an example)
    function openEditProfileModal(profileId) {
        $.get(`/patients/clinic-profiles/${profileId}/edit`, function(data) {
            console.log(data); // Check the structure of the data

            // Fill the basic profile fields
            $('#edit_first_name').val(data.first_name);
            $('#edit_middle_name').val(data.middle_name);
            $('#edit_last_name').val(data.last_name);
            $('#edit_suffix').val(data.suffix); // This might be null
            $('#edit_birth_date').val(data.birth_date);
            $('#edit_birth_date_age').val(data.age);

            // Populate the place of birth (Region, Province, Municipality, Barangay)
            if (data.pob_region) {
                $('#edit_place_of_birth_region').val(data.pob_region).trigger('change'); // Trigger change to load provinces
            }

            if (data.pob_province) {
                $('#edit_place_of_birth_province').val(data.pob_province).trigger('change'); // Trigger change to load municipalities
            }

            if (data.pob_city) {
                $('#edit_place_of_birth_city').val(data.pob_city).trigger('change'); // Trigger change to load barangays
            }

            if (data.pob_brgy) {
                $('#edit_place_of_birth_brgy').val(data.pob_brgy); // Set barangay
            }

            // Show the modal after setting values
            $('#editProfileModal').modal('show');
        });
    }
});

</script>





<script type="text/javascript">
function openEditProfileModal(profileId) {
    $.get(`/patients/clinic-profiles/${profileId}/edit`, function (data) {
        console.log(data);  // Debug

        // Fill basic info
        $('#edit_first_name').val(data.first_name);
        $('#edit_middle_name').val(data.middle_name);
        $('#edit_last_name').val(data.last_name);
        $('#edit_suffix').val(data.suffix);
        $('#edit_birth_date').val(data.birth_date);
        $('#edit_birth_date_age').val(data.age);

        // Populate Place of Birth using prefix "place_of_birth"
        loadRegionDropdowns(
            'edit_place_of_birth',
            data.pob_region,
            data.pob_province,
            data.pob_city,
            data.pob_brgy
        );

        // Open modal
        $('#editProfileModal').modal('show');
    });
}
</script>

<script type="text/javascript">
    function loadRegionDropdowns(prefix, regionId, provinceId, cityId, brgyId) {
    const regionSelect = $(`#${prefix}_region`);
    const provinceSelect = $(`#${prefix}_province`);
    const citySelect = $(`#${prefix}_city`);
    const brgySelect = $(`#${prefix}_brgy`);

    regionSelect.val(regionId).trigger('change');

    // Wait for provinces to load after region change
    setTimeout(() => {
        provinceSelect.val(provinceId).trigger('change');
        setTimeout(() => {
            citySelect.val(cityId).trigger('change');
            setTimeout(() => {
                brgySelect.val(brgyId);
            }, 300);
        }, 300);
    }, 300);
}

</script>











    </section>
<!-- Right col: Role List -->
<section class="col-lg-6 connectedSortable">
</section>
</div>
@endsection
@section('scripts')
<script>
    function viewChild(id) {
        fetch(`/patients/children/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('viewFullName').textContent =
        `${data.first_name} ${data.middle_name ?? ''} ${data.last_name}${data.suffix ? ', ' + data.suffix : ''}`;
        document.getElementById('viewBirthDate').textContent = data.birth_date;
        document.getElementById('viewGender').textContent = data.gender;
        document.getElementById('viewBirthPlace').textContent =
    `${data.place_of_birth_brgy}, ${data.place_of_birth_city}, ${data.place_of_birth_province}`;
    document.getElementById('viewSection').style.display = 'block';
    document.getElementById('editSection').style.display = 'none';
    document.getElementById('childModalLabel').textContent = 'View Child';
    $('#childModal').modal('show');
});
    }
    function editChild(id) {
        fetch(`/patients/children/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('firstNameInput').value = data.first_name;
            document.getElementById('middleNameInput').value = data.middle_name ?? '';
            document.getElementById('lastNameInput').value = data.last_name;
            document.getElementById('suffixInput').value = data.suffix ?? '';
            document.getElementById('birthDateInput').value = data.birth_date;
            document.getElementById('genderInput').value = data.gender;
            document.getElementById('provinceInput').value = data.place_of_birth_province ?? '';
            document.getElementById('cityInput').value = data.place_of_birth_city ?? '';
            document.getElementById('brgyInput').value = data.place_of_birth_brgy ?? '';
            document.getElementById('editChildForm').action = `/patients/children/${id}`;
            document.getElementById('childModalLabel').textContent = 'Edit Child';
            document.getElementById('viewSection').style.display = 'none';
            document.getElementById('editSection').style.display = 'block';
            $('#childModal').modal('show');
        });
    }
</script>

<script type="text/javascript">
    function openEditModal(mother_id){
        $('#mother_id').val(mother_id); 
        $('#modal-lg').modal('show');    
    }
    $('#modal-lg').on('hidden.bs.modal', function () {
        $('#mother_id').val(null);
    });
</script>
@endsection