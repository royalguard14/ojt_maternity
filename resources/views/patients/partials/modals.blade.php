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
            <!-- child report Mode -->
            <div id="viewSection">
             <div class="row">
                 <div class="col-md-6"><x-form.input-text name="viewGender" label="Gender" readonly/></div>
                 <div class="col-md-6"><x-form.input-text name="viewBirthDate" label="Birth Date" readonly/></div>
             </div>
             <x-form.input-text name="viewBirthPlace" label="Place of Birth" readonly/>
             <hr>

         </div>


         <!-- clinic report Mode -->

         <div id="clinicSection">
            <div class="row">
                <div class="col-md-3">
                    <x-form.input-text name="viewTypeOfBirth" label="Type of Birth" readonly/>
                </div>
                <div class="col-md-3">
                    <x-form.input-text name="viewChildWas" label="If Multiple Birth, Child Was" readonly/>
                </div>
                <div class="col-md-3">
                    <x-form.input-text name="viewBirthOrder" label="Birth Order" readonly/>
                </div>
                <div class="col-md-3">
                    <x-form.input-text name="viewWeight" label="Weight at Birth" readonly/>
                </div>
            </div>


            <div class="row">

                <div class="form-group col-md-4">


                    <x-form.input-text name="motherAgeInput" label="Age of Mother" readonly/>
                </div>
                <div class="form-group col-md-4">

                    <x-form.input-text name="fatherAgeInput" label="Age of Father" readonly/>
                </div>

                <div class="form-group col-md-4">
                    <x-form.input-text name="attendant" label="Attendant" readonly/>
                </div>
            </div>
        </div>





        <!-- Edit Mode -->
        <div id="editSection" style="display: none;">



<form id="editChildForm" method="POST">
        @csrf
        @method('PUT')

        <div class="card card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-child-info-tab" data-toggle="pill" href="#tab-child-info" role="tab" aria-controls="tab-child-info" aria-selected="true">
                            Child Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-clinic-record-tab" data-toggle="pill" href="#tab-clinic-record" role="tab" aria-controls="tab-clinic-record" aria-selected="false">
                            Clinic Record
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

                    <!-- Child Info Tab -->
                    <div class="tab-pane fade show active" id="tab-child-info" role="tabpanel" aria-labelledby="tab-child-info-tab">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <x-form.input-text name="edit_first_name" id="edit_first_name" label="First Name" />
                            </div>
                            <div class="form-group col-md-3">
                                <x-form.input-text name="edit_middle_name" id="edit_middle_name" label="Middle Name" readonly />
                            </div>
                            <div class="form-group col-md-3">
                                <x-form.input-text name="edit_last_name" id="edit_last_name" label="Last Name" readonly />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="suffixInput">Suffix</label>
                                <select name="suffixInput" id="suffixInput" class="form-control">
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

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <x-form.birth-date name="birthDateInput" id="birthDateInput" label="Birth Date" readonly/>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="genderInput">Gender</label>
                                <select name="gender" id="genderInput" class="form-control">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <h5>Place of Birth</h5>
                        <x-form.location-select prefix="pobs" :regions="$regions" />
                    </div>

                    <!-- Clinic Record Tab -->
                    <div class="tab-pane fade" id="tab-clinic-record" role="tabpanel" aria-labelledby="tab-clinic-record-tab">

                        <!-- Birth Info -->
  

 
        <!-- Birth Info -->
        <div class="form-row">
            <div class="form-group col-md-4">
                <x-reference.birth-type ref="RBirthType" name="edit_tb" label="Type of Birth" />
            </div>
            <div class="form-group col-md-4">
                <x-reference.birth-sequence ref="RBirthOrder" name="edit_child_was" label="If Multiple Birth, Child Was" />
            </div>
            <div class="form-group col-md-4">
                <x-reference.birth-sequence ref="RBirthOrder" name="edit_birth_order" label="Birth Order" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Weight at Birth (g)</label>
                <input type="number" name="weight_at_birth" id="weightInput" class="form-control" placeholder="e.g. 3000">
            </div>
            <div class="form-group col-md-4">
                <label>Total Children Alive</label>
                <input type="number" name="total_number_of_children_alive" id="childrenAliveInput" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Still Living</label>
                <input type="number" name="number_of_children_still_leaving" id="stillLivingInput" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Total Alive + Dead</label>
                <input type="number" name="total_number_of_children_alive_dead" id="aliveDeadInput" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Age of Mother</label>
                <input type="number" name="age_of_mother" id="emotherAgeInput" class="form-control" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Age of Father</label>
                <input type="number" name="age_of_father" id="efatherAgeInput" class="form-control" readonly>
            </div>
        </div>

                    </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div><!-- /.card -->

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
               


<div class="card card-tabs">
  <div class="card-header p-0 pt-1">
    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="custom-tabs-one-personal-tab" data-toggle="pill" href="#custom-tabs-one-personal" role="tab" aria-controls="custom-tabs-one-personal" aria-selected="true">Personal Info</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="custom-tabs-one-clinic-tab" data-toggle="pill" href="#custom-tabs-one-clinic" role="tab" aria-controls="custom-tabs-one-clinic" aria-selected="false">Clinic Info</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="custom-tabs-one-tabContent">
      <div class="tab-pane fade show active" id="custom-tabs-one-personal" role="tabpanel" aria-labelledby="custom-tabs-one-personal-tab">
        <!-- Personal Info content goes here -->
             <!-- Name Fields -->
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" value="{{ $profile_clinic->last_name }}" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="last_name">Last Name</label>
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
                    <x-form.location-select prefix="pob" :regions="$regions" />
      </div>
      <div class="tab-pane fade" id="custom-tabs-one-clinic" role="tabpanel" aria-labelledby="custom-tabs-one-clinic-tab">
        <!-- Clinic Info content goes here -->
                    <!-- Birth Info Section -->
                    <h5>Birth Information</h5>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <x-reference.birth-type ref="RBirthType" name="type_of_birth" label="Type of Birth" />
                        </div>
                        <div class="form-group col-md-4">
                            <x-reference.birth-sequence ref="RBirthOrder" name="child_was" label="Child Was" />
                        </div>
                        <div class="form-group col-md-4">
                            <x-reference.birth-sequence ref="RBirthOrder" name="birth_order" label="Birth Order" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="weight_at_birth">Weight at Birth (grams)</label>
                            <input type="number" name="weight_at_birth" class="form-control" placeholder="e.g. 3000" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="total_number_of_children_alive">Total Children Alive</label>
                            <input type="number" name="total_number_of_children_alive" class="form-control" min="{{$profile_clinic->relationshipAsMother->children->count()}}" value="{{$profile_clinic->relationshipAsMother->children->count() + 1}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="number_of_children_still_leaving">Still Living</label>
                            <input type="number" name="number_of_children_still_leaving" class="form-control" min="{{$profile_clinic->relationshipAsMother->children->count()}}" value="{{$profile_clinic->relationshipAsMother->children->count() + 1}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="total_number_of_children_alive_dead">Total Alive + Dead</label>
                            <input type="number" name="total_number_of_children_alive_dead" class="form-control" min="0" value="0">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="age_of_mother">Age of Mother</label>
                            <input type="number" name="age_of_mother" class="form-control" min="0" value="{{ $profile_clinic->age }}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="age_of_father">Age of Father</label>
                            <input type="number" name="age_of_father" class="form-control" min="0" value="{{ $profile_clinic->husband?->age }}" readonly>
                        </div>
                    </div>

                    <select class="form-control" name="attendant" required>

                        <option selected >Select Attendant</option>

                            @foreach($attendants as $data)

<option value="{{ $data->id }}" >{{ $data->name }}</option>
@endforeach

                    </select>


      </div>
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
<div class="modal fade" id="addHusband" tabindex="-1" aria-labelledby="addChildModalLabel" aria-hidden="true">
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
                            <x-form.location-select prefix="pob1" :regions="$regions" />
                            
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
                    <x-reference.occupation ref="ROccupation" name="occupation"  />
                    <x-reference.religion ref="RReligion" name="religion"  label="Religion" />
                    <x-reference.citizenship ref="RCitizenship" name="citizenship" label="Citizenship" />
                </div>
            </div> <!-- /.tab-content -->
        </div> <!-- /.card-body -->
    </div> <!-- /.card -->
</div> <!-- /.modal-body -->
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" id="submitButton" class="btn btn-primary">Save changes</button>
</div>
</form>
</div> <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->