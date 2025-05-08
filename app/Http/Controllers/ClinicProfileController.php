<?php

namespace App\Http\Controllers;
use App\Models\ClinicProfile;
use App\Models\Region;
use App\Models\ClinicProfileRelationship;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class ClinicProfileController extends Controller
{







    public function index()
    {
      #$mothers = ClinicProfile::where('data_spec', 'mother')->get()->toArray();
      $mothers = ClinicProfile::where('data_spec', 'mother')->get();

      $regions = Region::all();
      return view('patients.index',compact('mothers','regions'));
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
    return view('patients.view', compact('profile_clinic','regions'));
}



public function edit($id)
{
    $profile = ClinicProfile::findOrFail($id);
    $birthDate = $profile->birth_date;
    $age = $birthDate ? Carbon::parse($birthDate)->age : null;
    return response()->json([
        'first_name' => $profile->first_name,
        'middle_name' => $profile->middle_name,
        'last_name' => $profile->last_name,
        'suffix' => $profile->suffix,
        'birth_date' => $profile->birth_date,
        'gender' => $profile->gender,
        'pob_region' => $profile->place_of_birth_region,
        'pob_province' => $profile->place_of_birth_province,
        'pob_city' => $profile->place_of_birth_city,
        'pob_brgy' => $profile->place_of_birth_brgy,
         'age' => $age,
    ]);
}

   
    public function update(Request $request, string $id)
    {
        dd($request->all());
    }




public function store(Request $request)
{
 
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'suffix' => 'nullable|string|max:50',
        'birth_date' => 'required|date',

        'pob_region' => 'nullable|string',
        'pob_province' => 'nullable|string',
        'pob_municipality' => 'nullable|string',
        'pob_barangay' => 'nullable|string',

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

    $profile->place_of_birth_province = $validated['pob_province'] ?? null;
    $profile->place_of_birth_city = $validated['pob_municipality'] ?? null;
    $profile->place_of_birth_brgy = $validated['pob_barangay'] ?? null;
    $profile->place_of_birth_country = $validated['pob_country'] ?? null;

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
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'suffix' => 'nullable|string|max:50',
        'birth_date' => 'required|date',

        'pob_region' => 'nullable|string',
        'pob_province' => 'required|string',
        'pob_municipality' => 'required|string',
        'pob_barangay' => 'required|string',

        'gender' => 'required|in:male,female',
    ]);

    $mother = ClinicProfile::find($validated['mother_id']);

    $child = ClinicProfile::create([
        'first_name' => $validated['first_name'],
        'middle_name' => $validated['middle_name'] ?? $mother->last_name,
        'last_name' => $validated['last_name'],
        'suffix' => $validated['suffix'] ?? null,
        'birth_date' => $validated['birth_date'],


        'pob_province' => $validated['pob_province'] ?? null,
        'pob_city' => $validated['pob_municipality'] ?? null,
        'pob_brgy' => $validated['pob_barangay'] ?? null,

        'gender' => $validated['gender'],
        'data_spec' => 'child',
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

    return redirect()->back()->with('success', 'Child added successfully.');
}





public function showChild($id)
{
    $child = ClinicProfile::with(['birthProvince', 'birthCity', 'birthBarangay'])->findOrFail($id);

    return response()->json([
        'first_name' => $child->first_name,
        'middle_name' => $child->middle_name,
        'last_name' => $child->last_name,
        'suffix' => $child->suffix,
        'birth_date' => $child->birth_date,
        'gender' => $child->gender,

        // These will now return actual names
        'pob_province' => optional($child->birthProvince)->province_name,
        'pob_city' => optional($child->birthCity)->municipality_name,
        'pob_brgy' => optional($child->birthBarangay)->barangay_name,
    ]);
}



public function updateChild(Request $request, $id)
{
    $child = ClinicProfile::findOrFail($id);

    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'suffix' => 'nullable|string|max:10',
        'birth_date' => 'required|date',
        'gender' => 'required|in:male,female',

        'pob_province' => 'nullable|string|max:255',
        'pob_city' => 'nullable|string|max:255',
        'pob_brgy' => 'nullable|string|max:255',
    ]);

    $child->update([
        'first_name' => $validated['first_name'],
        'middle_name' => $validated['middle_name'] ?? $child->middle_name,
        'last_name' => $validated['last_name'],
        'suffix' => $validated['suffix'] ?? null,
        'birth_date' => $validated['birth_date'],
        'gender' => $validated['gender'],

        'pob_province' => $validated['pob_province'] ?? null,
        'pob_city' => $validated['pob_city'] ?? null,
        'pob_brgy' => $validated['pob_brgy'] ?? null,
    ]);

    return redirect()->back()->with('success', 'Child profile updated successfully.');
}




}
