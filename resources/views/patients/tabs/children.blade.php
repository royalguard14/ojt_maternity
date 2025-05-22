<!-- Child Profile Tab -->

    @if ($profile_clinic->relationshipAsMother && $profile_clinic->relationshipAsMother->children->isNotEmpty())

    <table class="table table-head-fixed text-nowrap" id="example3">
        <thead>
            <tr>
                <th style="width: 10px">No.</th>
                <th>Name</th>
                <th>Age</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profile_clinic->relationshipAsMother->children as $index => $child)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $child->full_name }}</td>
                <td>{{ $child->age }}</td>
                <td style="text-align: center;">


   <div class="btn-group">
                        <button type="button" class="btn btn-default" onclick="openChildModal({{ $child->id }}, 'view')">
                          <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-default" onclick="openChildModal({{ $child->id }}, 'clinic')">
                          <i class="fas fa-user-nurse"></i>
                        </button>
                        <button type="button" class="btn btn-default" onclick="openChildModal({{ $child->id }}, 'edit')">
                          <i class="fas fa-pen"></i>
                        </button>


                     @if($profile_clinic->husband && $profile_clinic->husband->exists)
                      <button type="button" class="btn btn-default" onclick="printForm({{ $child->id }})">
  <i class="fas fa-paperclip"></i>
</button>
                        @endif
    </div>




                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h5>No children data found.</h5>
    <table class="table table-head-fixed text-nowrap" id="example3">
        <thead>
            <tr>
                <th style="width: 10px">No.</th>
                <th>Name</th>
                <th>Age</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" class="text-center">No children records to display.</td>
            </tr>
        </tbody>
    </table>
    @endif
    @if($profile_clinic->husband && $profile_clinic->husband->exists)
    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addChildModal">
        Add Child
    </button>
    @endif


<script>
  // one function to handle all three modes
  function openChildModal(id, mode) {
    fetch(`/patients/children/${id}`)
      .then(res => res.json())
      .then(data => {

        console.log(data.child.birth_info)
        const child     = data.child;
        const info      = child.birth_info || {};
        const att       = info.attendant || {};
        const modal     = $('#childModal');
        const sections  = {
          view:     ['viewSection'],
          clinic:   ['clinicSection'],
          edit:     ['editSection']
        };

        // 1) Title Case name + set modal title
        const rawName = [child.first_name, child.middle_name, child.last_name]
          .filter(Boolean).join(' ') +
          (child.suffix ? `, ${child.suffix}` : '');
        const titleCase = rawName
          .replace(/\w\S*/g, w => w[0].toUpperCase() + w.substr(1).toLowerCase())
          .trim();
        document.getElementById('childModalLabel').textContent =
          `${titleCase} – ${mode === 'view' ? 'Report Card' : mode === 'clinic' ? 'Clinic Report' : 'Edit Child'}`;

        // 2) Hide all sections, then show just the ones for this mode
        ['viewSection','clinicSection','editSection'].forEach(id => {
          document.getElementById(id).style.display = 'none';
        });
        sections[mode].forEach(id => {
          document.getElementById(id).style.display = 'block';
        });

        // 3) Always populate the “view” fields (child basics)
        document.getElementById('viewGender').value = child.gender || '';
        document.getElementById('viewBirthDate').value = new Date(child.birth_date)
          .toLocaleDateString('en-US',{year:'numeric',month:'long',day:'numeric'});
        document.getElementById('viewBirthPlace').value = child.full_place_of_birth || '';

        // 4) Always populate the “edit” fields (so switching into edit is immediate)
        document.getElementById('edit_first_name').value  = child.first_name || '';
        document.getElementById('edit_middle_name').value = child.middle_name || '';
        document.getElementById('edit_last_name').value   = child.last_name || '';
        document.getElementById('suffixInput').value      = child.suffix || '';
        document.getElementById('birthDateInput').value   = child.birth_date || '';
        document.getElementById('genderInput').value      = child.gender || '';
        document.getElementById('pobs_region').value      = data.pob_region || '';
        populateSelect('#pobs_province', data.pob_provinces, data.pob_province);
        populateSelect('#pobs_municipality', data.pob_cities,    data.pob_city);
        populateSelect('#pobs_barangay',    data.pob_barangays, data.pob_brgy);

        document.getElementById('edit_tb').value           = info.type_of_birth     || '';
        document.getElementById('edit_child_was').value    = info.child_was         || '';
        document.getElementById('edit_birth_order').value  = info.birth_order       || '';
        document.getElementById('weightInput').value       = info.weight_at_birth   || '';
        document.getElementById('childrenAliveInput').value= info.total_number_of_children_alive   || '';
        document.getElementById('stillLivingInput').value  = info.number_of_children_still_leaving || '';
        document.getElementById('aliveDeadInput').value    = info.total_number_of_children_alive_dead || 0;
        document.getElementById('emotherAgeInput').value   = info.age_of_mother     || '';
        document.getElementById('efatherAgeInput').value   = info.age_of_father     || '';

        // 5) Populate the clinic section fields
        document.getElementById('viewTypeOfBirth').value = info.type_of_birth || '';
        document.getElementById('viewChildWas').value    = info.child_was     || '';
        document.getElementById('viewBirthOrder').value  = info.birth_order   || '';
        document.getElementById('viewWeight').value      = info.weight_at_birth
                                                           ? info.weight_at_birth + ' g'
                                                           : '';
        document.getElementById('motherAgeInput').value  = info.age_of_mother || '';
        document.getElementById('fatherAgeInput').value  = info.age_of_father || '';
        document.getElementById('attendant').value       = att.name
                                                           ? `${att.name} (${att.position})`
                                                           : '';

        // 6) If editing, set form action
        if (mode === 'edit') {
          document.getElementById('editChildForm').action = `/patients/children/${id}`;
        }

        modal.modal('show');
      });
  }


</script>




<script>
    function printForm(id) {
        window.open(`/patients/children/${id}/print`, '_blank');
    }
</script>
