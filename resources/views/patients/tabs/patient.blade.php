<!-- Patient Profile Tab -->
<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                    <h5>
                        <strong>Name:</strong> {{ $profile_clinic->full_name }}
                    </h5>

   
<ul class="list-group">
   @if ($profile_clinic->id)
   <button class="btn btn-warning btn-sm" onclick="openEditProfileModal({{ $profile_clinic->id }}, 'mother')">Update</button>
   @endif
   <li class="list-group-item"><strong>Birth Date:</strong> {{ $profile_clinic->formatted_birth_date }} ({{ $profile_clinic->age }} years old)</li>
   <li class="list-group-item"><strong>Place of Birth:</strong> {{ $profile_clinic->full_place_of_birth }}</li>
   <li class="list-group-item"><strong>Residence:</strong> {{ $profile_clinic->full_residence }}</li>
   <li class="list-group-item"><strong>Phone:</strong> {{ $profile_clinic->phone }}</li>
   <li class="list-group-item"><strong>Occupation:</strong> {{ $profile_clinic->occupation }}</li>
   <li class="list-group-item"><strong>Religion:</strong> {{ $profile_clinic->religion }}</li>
   <li class="list-group-item"><strong>Citizenship:</strong> {{ $profile_clinic->citizenship }}</li>
</ul>
</div>


