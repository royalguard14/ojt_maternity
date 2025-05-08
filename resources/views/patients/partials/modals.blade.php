<!-- Child view-edit Modal -->
<div class="modal fade" id="childModal" tabindex="-1" role="dialog" aria-labelledby="childModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="childModalLabel">Child Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <!-- View Mode -->
    <div id="viewSection">
        <p><strong>Full Name:</strong> <span id="viewFullName"></span></p>
        <p><strong>Birth Date:</strong> <span id="viewBirthDate"></span></p>
        <p><strong>Gender:</strong> <span id="viewGender"></span></p>
        <p><strong>Place of Birth:</strong> <span id="viewBirthPlace"></span></p>
    </div>
    <!-- Edit Mode -->
    <div id="editSection" style="display: none;">
        <form id="editChildForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>First Name</label>
                    <input type="text" name="first_name" id="firstNameInput" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" id="middleNameInput" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Last Name</label>
                    <input type="text" name="last_name" id="lastNameInput" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Suffix</label>
                    <input type="text" name="suffix" id="suffixInput" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Birth Date</label>
                    <input type="date" name="birth_date" id="birthDateInput" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Gender</label>
                    <select name="gender" id="genderInput" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Province</label>
                    <input type="text" name="place_of_birth_province" id="provinceInput" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>City/Municipality</label>
                    <input type="text" name="place_of_birth_city" id="cityInput" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Barangay</label>
                    <input type="text" name="place_of_birth_brgy" id="brgyInput" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>
</div>
</div>
</div>


<!-- Add Child Modal -->
<div class="modal fade" id="addChildModal" tabindex="-1" aria-labelledby="addChildModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('patients.storeChild') }}">
            @csrf
            <input type="hidden" name="mother_id" value="{{ $profile_clinic->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addChildModalLabel">Add Child</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Name Fields -->
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="middle_name">Middle Name </label>
                            <input type="text" class="form-control" name="middle_name" value="{{ $profile_clinic->last_name }}" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="last_name">Last Name </label>
                            <input type="text" class="form-control" name="last_name" value="{{ $profile_clinic->husband?->last_name }}" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="suffix">Suffix</label>
                            <input type="text" class="form-control" name="suffix" placeholder="e.g. Jr, III">
                        </div>
                    </div>
                    <!-- Birth Date and Gender -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="birth_date">Birth Date</label>
                            <input type="date" class="form-control" name="birth_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                            <select class="form-control" name="gender" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <!-- Place of Birth -->
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Child</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- edit husband --}}
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
                <form action="{{ route('patients.storeprofile') }}" method="POST" id="parentForm">
                    @csrf
                    <input type="hidden" name="data_spec" value="father">
                    <input type="hidden" name="mother_id" id="mother_id">

                    <div class="card card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
                                       href="#custom-tabs-two-home" role="tab"
                                       aria-controls="custom-tabs-two-home" aria-selected="true">Basic Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                       href="#custom-tabs-two-profile" role="tab"
                                       aria-controls="custom-tabs-two-profile" aria-selected="false">Birth Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill"
                                       href="#custom-tabs-two-messages" role="tab"
                                       aria-controls="custom-tabs-two-messages" aria-selected="false">Contact Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill"
                                       href="#custom-tabs-two-settings" role="tab"
                                       aria-controls="custom-tabs-two-settings" aria-selected="false">Other Info</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">

                                {{-- Basic Information Tab --}}
                                <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel"
                                     aria-labelledby="custom-tabs-two-home-tab">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <x-form.input-text name="first_name" label="First Name" required />
                                        </div>
                                        <div class="col-lg-5">
                                            <x-form.select name="suffix" label="Suffix"
                                                           :options="['' => 'None', 'Jr.' => 'Jr.', 'Sr.' => 'Sr.', 'II' => 'II', 'III' => 'III']" />
                                        </div>
                                    </div> 
                                    <x-form.input-text name="middle_name" label="Middle Name" />
                                    <x-form.input-text name="last_name" label="Last Name" required />
                                </div>

                                {{-- Birth Info Tab --}}
                                <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                     aria-labelledby="custom-tabs-two-profile-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <x-form.input-date name="birth_date" label="Date of Birth" required />
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="birth_date_age">Age</label>
                                                <input type="text" name="birth_date_age" id="birth_date_age"
                                                       class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Place of Birth</h5>
                                    <x-form.location-select prefix="pob" :regions="$regions" />
                                </div>

                                {{-- Contact Info Tab --}}
                                <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel"
                                     aria-labelledby="custom-tabs-two-messages-tab">
                                    <div class="form-group col-lg-6">
                                        <x-form.input-number name="phone" label="Phone Number" />
                                    </div>
                                    <hr>
                                    <h5>Residence</h5>
                                    <x-form.location-select prefix="residence" :regions="$regions" />
                                </div>

                                {{-- Other Info Tab --}}
                                <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel"
                                     aria-labelledby="custom-tabs-two-settings-tab">
                                    <x-form.input-text name="occupation" label="Occupation" />
                                    <x-form.input-text name="religion" label="Religion" />
                                    <x-form.input-text name="citizenship" label="Citizenship" />
                                </div>

                            </div> <!-- /.tab-content -->
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </form>
            </div> <!-- /.modal-body -->

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="submitButton" class="btn btn-primary">Save changes</button>
            </div>

        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
