                 <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    @if ($profile_clinic->husband)
  
                    <h5>
                        <strong>Name:</strong> {{ $profile_clinic->husband->full_name }}
                    </h5>
                    <ul class="list-group">
                                   <button onclick="openEditProfileModal({{ $profile_clinic->husband->id }})" class="btn btn-sm btn-warning">
    Update
</button>
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


            <script type="text/javascript">
    function openEditModal(x) {
    $('#mother_id').val(x); // Set the value first
    $('#addHusband').modal('show'); // Then show the modal
}


            </script>