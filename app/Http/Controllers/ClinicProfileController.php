<?php

namespace App\Http\Controllers;
use App\Models\ClinicProfile;
use App\Models\Region;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Barangay;
use App\Models\BirthInfo;
use App\Models\ClinicProfileRelationship;
use App\Models\Attendant;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class ClinicProfileController extends Controller
{


public function updateMC(Request $request, $id)
{
    $relationship = ClinicProfileRelationship::findOrFail($id);

    $validated = $request->validate([
        'is_married' => 'nullable|boolean',
        'date_of_marriage' => 'nullable|date',
        'place_of_marriage' => 'nullable|string|max:255',
    ]);

    $relationship->update([
        'is_married' => $request->has('is_married'),
        'date_of_marriage' => $validated['date_of_marriage'],
        'place_of_marriage' => $validated['place_of_marriage'],
    ]);

    return redirect()->back()->with('success', 'Marriage information updated successfully.');
}





    public function index()
    {
      
      $mothers = ClinicProfile::where('data_spec', 'mother')->get();




$layout = auth()->user()->role->role_name === 'Developer'
    ? 'layouts.master'
    : 'layouts.master-front';













      $regions = Region::all();
      return view('patients.index',compact('mothers','regions','layout'));
  }


public function show(string $id)
{
    $profile_clinic = ClinicProfile::with([
        'relationshipAsMother', 
        'relationshipAsFather', 
        'husband', 
        'wife'
    ])->findOrFail($id);

    $regions = Region::all();


$layout = auth()->user()->role->role_name === 'Developer'
    ? 'layouts.master'
    : 'layouts.master-front';



$relationship = ClinicProfileRelationship::findOrFail($id);

    $attendants = Attendant::all();
    return view('patients.view', compact('profile_clinic','regions','attendants','layout','relationship'));
}







public function edit($id)
{
    $profile = ClinicProfile::findOrFail($id);
    $age = $profile->birth_date ? Carbon::parse($profile->birth_date)->age : null;

    // Resolve region ID from province ID (birth)
    $birthProvince = Province::find($profile->place_of_birth_province);
    $birthRegionId = $birthProvince ? $birthProvince->region_id : null;

    // Resolve region ID from province ID (residence)
    $resProvince = Province::find($profile->residence_province);
    $resRegionId = $resProvince ? $resProvince->region_id : null;

    // Get child location lists (birth)
    $birthProvinces = $birthRegionId ? Province::where('region_id', $birthRegionId)->get() : collect();
    $birthCities = $profile->place_of_birth_province ? Municipality::where('province_id', $profile->place_of_birth_province)->get() : collect();
    $birthBarangays = $profile->place_of_birth_city ? Barangay::where('municipality_id', $profile->place_of_birth_city)->get() : collect();

    // Get child location lists (residence)
    $resProvinces = $resRegionId ? Province::where('region_id', $resRegionId)->get() : collect();
    $resCities = $profile->residence_province ? Municipality::where('province_id', $profile->residence_province)->get() : collect();
    $resBarangays = $profile->residence_city ? Barangay::where('municipality_id', $profile->residence_city)->get() : collect();









    return response()->json([
        // Basic info
        'first_name' => $profile->first_name,
        'middle_name' => $profile->middle_name,
        'last_name' => $profile->last_name,
        'suffix' => $profile->suffix,
        'birth_date' => $profile->birth_date,
        'gender' => $profile->gender,
        'age' => $age,

        'religion' => $profile->religion,
        'citizenship' => $profile->citizenship,
'occupation' => $profile->occupation,
'phone' => $profile->phone,
        

        // Place of birth (IDs)
        'pob_region' => $birthRegionId,
        'pob_province' => $profile->place_of_birth_province,
        'pob_city' => $profile->place_of_birth_city,
        'pob_brgy' => $profile->place_of_birth_brgy,

        // Residence (IDs)
        'res_region' => $resRegionId,
        'res_province' => $profile->residence_province,
        'res_city' => $profile->residence_city,
        'res_brgy' => $profile->residence_brgy,

        // Lists for selects
        'pob_provinces' => $birthProvinces,
        'pob_cities' => $birthCities,
        'pob_barangays' => $birthBarangays,

        'res_provinces' => $resProvinces,
        'res_cities' => $resCities,
        'res_barangays' => $resBarangays,

        'profile_id' => $id,


    ]);
}












public function update(Request $request)
{
$validated = $request->validate([
    'first_name' => 'required|string|max:255',
    'middle_name' => 'nullable|string|max:255',
    'last_name' => 'required|string|max:255',
    'suffix' => 'nullable|string|max:50',
    'birth_date' => 'required|date',
    'aedit_place_of_birth_province' => 'nullable|integer',
    'aedit_place_of_birth_municipality' => 'nullable|integer',
    'aedit_place_of_birth_barangay' => 'nullable|integer',
    'aedit_residence_province' => 'nullable|integer',
    'aedit_residence_municipality' => 'nullable|integer',
    'aedit_residence_barangay' => 'nullable|integer',
    'phone' => 'nullable|string|max:20',
    'occupation' => 'nullable|string|max:255',
    'religion' => 'nullable|string|max:255',
    'citizenship' => 'nullable|string|max:255',
]);

// |regex:/^(09|\+639)\d{9}$/



    $profile = ClinicProfile::findOrFail($request->profile_id);


$profile->fill(array_filter([
    'first_name' => $validated['first_name'],
    'middle_name' => $request->has('middle_name') ? $validated['middle_name'] : $profile->middle_name,
    'last_name' => $validated['last_name'],
    'suffix' => $request->has('suffix') ? $validated['suffix'] : $profile->suffix,
    'birth_date' => $validated['birth_date'],

    'place_of_birth_province' => $request->has('aedit_place_of_birth_province') ? $validated['aedit_place_of_birth_province'] : $profile->place_of_birth_province,
    'place_of_birth_city' => $request->has('aedit_place_of_birth_municipality') ? $validated['aedit_place_of_birth_municipality'] : $profile->place_of_birth_city,
    'place_of_birth_brgy' => $request->has('aedit_place_of_birth_barangay') ? $validated['aedit_place_of_birth_barangay'] : $profile->place_of_birth_brgy,

    'residence_province' => $request->has('aedit_residence_province') ? $validated['aedit_residence_province'] : $profile->residence_province,
    'residence_city' => $request->has('aedit_residence_municipality') ? $validated['aedit_residence_municipality'] : $profile->residence_city,
    'residence_brgy' => $request->has('aedit_residence_barangay') ? $validated['aedit_residence_barangay'] : $profile->residence_brgy,

    'phone' => $request->has('phone') ? $validated['phone'] : $profile->phone,
    'occupation' => $request->has('occupation') ? $validated['occupation'] : $profile->occupation,
    'religion' => $request->has('religion') ? $validated['religion'] : $profile->religion,
    'citizenship' => $request->has('citizenship') ? $validated['citizenship'] : $profile->citizenship,
]));


    $profile->save();

  $redirectId = $request->sino === 'mother' ? $request->profile_id : $profile->wife?->id;





return redirect()->route('patients.show', $redirectId)->with('success', 'Profile updated successfully.');

}



public function store(Request $request)
{


 
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'suffix' => 'nullable|string|max:50',
        'birth_date' => 'required|date',

        'pob1_region' => 'nullable|string',
        'pob1_province' => 'nullable|string',
        'pob1_municipality' => 'nullable|string',
        'pob1_barangay' => 'nullable|string',

        'residence_region' => 'nullable|string',
        'residence_province' => 'nullable|string',
        'residence_municipality' => 'nullable|string',
        'residence_barangay' => 'nullable|string',

        'phone' => 'nullable|string|max:20',
        'occupation' => 'nullable|string|max:255',
        'religion' => 'nullable|string|max:255',
        'citizenship' => 'nullable|string|max:255',
    ]);

    $data_spec = $request->data_spec;
    $gender = $data_spec === 'mother' ? 'female' : 'male';

    // Create profile
    $profile = new ClinicProfile();
    $profile->first_name = $validated['first_name'];
    $profile->middle_name = $validated['middle_name'] ?? null;
    $profile->last_name = $validated['last_name'];
    $profile->suffix = $validated['suffix'] ?? null;
    $profile->birth_date = $validated['birth_date'];

    $profile->place_of_birth_province = $validated['pob1_province'] ?? null;
    $profile->place_of_birth_city = $validated['pob1_municipality'] ?? null;
    $profile->place_of_birth_brgy = $validated['pob1_barangay'] ?? null;
    $profile->place_of_birth_country = $validated['pob1_country'] ?? null;

    $profile->residence_province = $validated['residence_province'] ?? null;
    $profile->residence_city = $validated['residence_municipality'] ?? null;
    $profile->residence_brgy = $validated['residence_barangay'] ?? null;
    $profile->residence_country = $validated['residence_country'] ?? null;

    $profile->gender = $gender;
    $profile->phone = $validated['phone'] ?? null;
    $profile->occupation = $validated['occupation'] ?? null;
    $profile->religion = $validated['religion'] ?? null;
    $profile->citizenship = $validated['citizenship'] ?? null;

    $profile->data_spec = $data_spec;
    $profile->save();

    // Create or update relationship
    if ($data_spec === 'mother') {
        // Save mother with empty father and child_ids
        ClinicProfileRelationship::create([
            'mother_id' => $profile->id,
            'father_id' => null,
            'child_ids' => [],
        ]);
    } elseif ($data_spec === 'father') {
        $motherId = $request->mother_id;

        // Try to find existing relationship
        $relationship = ClinicProfileRelationship::where('mother_id', $motherId)->first();

        if ($relationship) {
            // Update existing
            $relationship->father_id = $profile->id;
            $relationship->save();
        } else {
            // Create new if not found
            ClinicProfileRelationship::create([
                'mother_id' => $motherId,
                'father_id' => $profile->id,
                'child_ids' => [],
            ]);
        }
    }

    return redirect()->back()->with('success', 'Patient profile created successfully.');
}



public function storeChild(Request $request)
{


    $validated = $request->validate([
        'mother_id' => 'required|exists:clinic_profiles,id',

        // Child identity
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'suffix' => 'nullable|string|max:50',
        'birth_date' => 'required|date',
        'gender' => 'required|in:male,female',

        // Place of birth
        'pob_region' => 'nullable|string',
        'pob_province' => 'required|string',
        'pob_municipality' => 'required|string',
        'pob_barangay' => 'required|string',

        // Birth info
        'type_of_birth' => 'required|string',
        'child_was' => 'required|string',
        'birth_order' => 'required|string',
        'weight_at_birth' => 'required|integer', // in grams
        'total_number_of_children_alive' => 'required|integer',
        'number_of_children_still_leaving' => 'required|integer',
        'total_number_of_children_alive_dead' => 'required|integer',
        'age_of_mother' => 'required|integer',
        'age_of_father' => 'required|integer',
        'attendant' => 'required|integer',
    ]);

    $mother = ClinicProfile::find($validated['mother_id']);

    $child = ClinicProfile::create([
        'first_name' => $validated['first_name'],
        'middle_name' => $validated['middle_name'] ?? $mother->last_name,
        'last_name' => $validated['last_name'],
        'suffix' => $validated['suffix'] ?? null,
        'birth_date' => $validated['birth_date'],

        'place_of_birth_country' => 'Philippines',
        'place_of_birth_province' => $validated['pob_province'],
        'place_of_birth_city' => $validated['pob_municipality'],
        'place_of_birth_brgy' => $validated['pob_barangay'],

        'gender' => $validated['gender'],
        'data_spec' => 'child',
    ]);

    // Save additional birth info
    BirthInfo::create([
        'profile_id' => $child->id,
        'type_of_birth' => $validated['type_of_birth'],
        'child_was' => $validated['child_was'],
        'birth_order' => $validated['birth_order'],
        'weight_at_birth' => $validated['weight_at_birth'],
        'total_number_of_children_alive' => $validated['total_number_of_children_alive'],
        'number_of_children_still_leaving' => $validated['number_of_children_still_leaving'],
        'total_number_of_children_alive_dead' => $validated['total_number_of_children_alive_dead'],
        'age_of_mother' => $validated['age_of_mother'],
        'age_of_father' => $validated['age_of_father'],
'attendant_id' => $validated['attendant'],

    ]);

    // Find or create the relationship record
    $relationship = ClinicProfileRelationship::firstOrCreate(
        ['mother_id' => $mother->id],
        ['father_id' => null, 'child_ids' => []]
    );

    $children = $relationship->child_ids ?? [];
    $children[] = $child->id;
    $relationship->child_ids = array_unique($children);
    $relationship->save();

    return redirect()->back()->with('success', 'Child and birth info added successfully.');
}




public function showChild($id)
{
  $child = ClinicProfile::with(['birthProvince', 'birthCity', 'birthBarangay', 'birthInfo','birthInfo.attendant'
])->findOrFail($id);





    // Resolve region ID from province ID (birth)
    $birthProvince = Province::find($child->place_of_birth_province);
    $birthRegionId = $birthProvince ? $birthProvince->region_id : null;


    // Get child location lists (birth)
    $birthProvinces = $birthRegionId ? Province::where('region_id', $birthRegionId)->get() : collect();




    $birthCities = $child->place_of_birth_province ? Municipality::where('province_id', $child->place_of_birth_province)->get() : collect();
    $birthBarangays = $child->place_of_birth_city ? Barangay::where('municipality_id', $child->place_of_birth_city)->get() : collect();




//dd($birthBarangays->toArray());


return response()->json([
    'child' => $child,
    'pob_region' => $birthRegionId,
    'pob_province' => $child->place_of_birth_province,
    'pob_city' => $child->place_of_birth_city,
    'pob_brgy' => $child->place_of_birth_brgy,

    // Lists for selects
    'pob_provinces' => $birthProvinces,
    'pob_cities' => $birthCities,
    'pob_barangays' => $birthBarangays,

]);

}



public function updateChild(Request $request, $id)
{
    $child = ClinicProfile::findOrFail($id);



#dd($request->all());
    // Validate input
    $validated = $request->validate([
        'edit_first_name' => 'required|string|max:255',
        'edit_middle_name' => 'nullable|string|max:255',
        'edit_last_name' => 'required|string|max:255',
        'suffixInput' => 'nullable|string|max:10',
        'birthDateInput' => 'required|date',
        'gender' => 'required|in:male,female',

        'pobs_province' => 'nullable|string|max:255',
        'pobs_municipality' => 'nullable|string|max:255',
        'pobs_barangay' => 'nullable|string|max:255',

        'edit_tb' => 'nullable|string|max:255',
        'edit_child_was' => 'nullable|string|max:255',
        'edit_birth_order' => 'nullable|string|max:255',
        'weight_at_birth' => 'nullable|numeric|min:0',
        'total_number_of_children_alive' => 'nullable|integer|min:0',
        'number_of_children_still_leaving' => 'nullable|integer|min:0',
        'total_number_of_children_alive_dead' => 'nullable|integer|min:0',
        'age_of_mother' => 'nullable|integer|min:0',
        'age_of_father' => 'nullable|integer|min:0',
        'eattendant' => 'required|integer|min:0',
    ]);

    // Build update data for ClinicProfile
    $updateData = [
        'first_name' => $validated['edit_first_name'],
        'middle_name' => $validated['edit_middle_name'] ?? null,
        'last_name' => $validated['edit_last_name'],
        'suffix' => $validated['suffixInput'] ?? null,
        'birth_date' => $validated['birthDateInput'],
        'gender' => $validated['gender'],
    ];

    // Conditionally update POB fields if provided
    if (!empty($validated['pobs_province'])) {
        $updateData['place_of_birth_province'] = $validated['pobs_province'];
    }
    if (!empty($validated['pobs_municipality'])) {
        $updateData['place_of_birth_city'] = $validated['pobs_municipality'];
    }
    if (!empty($validated['pobs_barangay'])) {
        $updateData['place_of_birth_brgy'] = $validated['pobs_barangay'];
    }

    $child->update($updateData);

    // Update or create birth info
    $child->birthInfo()->updateOrCreate(
        ['profile_id' => $child->id],
        [
            'type_of_birth' => $validated['edit_tb'] ?? null,
            'child_was' => $validated['edit_child_was'] ?? null,
            'birth_order' => $validated['edit_birth_order'] ?? null,
            'weight_at_birth' => $validated['weight_at_birth'] ?? null,
            'total_number_of_children_alive' => $validated['total_number_of_children_alive'] ?? null,
            'number_of_children_still_leaving' => $validated['number_of_children_still_leaving'] ?? null,
            'total_number_of_children_alive_dead' => $validated['total_number_of_children_alive_dead'] ?? null,
            'age_of_mother' => $validated['age_of_mother'] ?? null,
            'age_of_father' => $validated['age_of_father'] ?? null,
            'attendant_id' => $validated['eattendant'] ?? null,

        ]
    );

    return redirect()->back()->with('success', 'Child profile updated successfully.');
}


public function print($id)
{
    // Eager load relationships for the child
    $child = ClinicProfile::with([
        'birthInfo.attendant',
        'birthProvince',
        'birthCity',
        'birthBarangay'
    ])->findOrFail($id);

    // Load parental relationship data
    $relationship = $child->parents();
    $mother = $relationship?->mother;
    $father = $relationship?->father;

    // Load residence data for mother and father if present
    if ($mother) {
        $mother->loadMissing(['residenceBarangay', 'residenceCity', 'residenceProvince']);
    }

    if ($father) {
        $father->loadMissing(['residenceBarangay', 'residenceCity', 'residenceProvince']);
    }

    // Graceful fallback for mother's residence
    $mother_barangay = optional($mother?->residenceBarangay)->barangay_name ?? $mother?->residence_brgy;
    $mother_city    = optional($mother?->residenceCity)->municipality_name ?? $mother?->residence_city;
    $mother_province = optional($mother?->residenceProvince)->province_name ?? $mother?->residence_province;
    $mother_country = $mother?->residence_country ?? null;

    // Graceful fallback for father's residence
    $father_barangay = optional($father?->residenceBarangay)->barangay_name ?? $father?->residence_brgy;
    $father_city    = optional($father?->residenceCity)->municipality_name ?? $father?->residence_city;
    $father_province = optional($father?->residenceProvince)->province_name ?? $father?->residence_province;
    $father_country = $father?->residence_country ?? null;

    // Build full birth place string
    $birth_place = implode(', ', array_filter([
        optional($child->birthBarangay)->barangay_name ?? $child->place_of_birth_brgy,
        optional($child->birthCity)->municipality_name ?? $child->place_of_birth_city,
        optional($child->birthProvince)->province_name ?? $child->place_of_birth_province
    ]));

    return view('patients.print', compact(
        'child',
        'birth_place',
        'mother',
        'father',
        'mother_barangay',
        'mother_city',
        'mother_province',
        'mother_country',
        'father_barangay',
        'father_city',
        'father_province',
        'father_country',
        'relationship'
    ));
}


}
