<?php

namespace App\Http\Controllers;
use App\Models\ClinicProfile;
use App\Models\Region;
use App\Models\ClinicProfileRelationship;
use Illuminate\Http\Request;
use Auth;

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
    $profile_clinic = ClinicProfile::findOrFail($id);
    $regions = Region::all();
    return view('patients.view', compact('profile_clinic','regions'));

}


public function edit(string $id)
{
        //
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



 public function store(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'suffix' => 'nullable|string|max:50',
        'birth_date' => 'required|date',

        'place_of_birth_region' => 'nullable|string',
        'place_of_birth_province' => 'nullable|string',
        'place_of_birth_municipality' => 'nullable|string',
        'place_of_birth_barangay' => 'nullable|string',

        'residence_region' => 'nullable|string',
        'residence_province' => 'nullable|string',
        'residence_municipality' => 'nullable|string',
        'residence_barangay' => 'nullable|string',

        'phone' => 'nullable|string|max:20',
        'occupation' => 'nullable|string|max:255',
        'religion' => 'nullable|string|max:255',
        'citizenship' => 'nullable|string|max:255',
    ]);

    if ($request->data_spec == "mother") {
        $gender = 'female';
        $data_spec = 'mother';
    } else {
        $gender = 'male';
        $data_spec = 'father';
    }

    // Save the profile first (mother or father)
  $profile = new ClinicProfile();
$profile->first_name = $validated['first_name'];
$profile->middle_name = $validated['middle_name'] ?? null;
$profile->last_name = $validated['last_name'];
$profile->suffix = $validated['suffix'] ?? null;
$profile->birth_date = $validated['birth_date'];

$profile->place_of_birth_province = $validated['place_of_birth_province'] ?? null;
$profile->place_of_birth_city = $validated['place_of_birth_municipality'] ?? null;
$profile->place_of_birth_brgy = $validated['place_of_birth_barangay'] ?? null;
$profile->place_of_birth_country = $validated['place_of_birth_country'] ?? null;

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
    // If saving a father, create relationship
    if ($data_spec == 'father') {
        $motherId = $request->mother_id;
        $fatherId = $profile->id; // now you have the father's ID

        ClinicProfileRelationship::create([
            'mother_id' => $motherId,
            'father_id' => $fatherId,
            'child_ids' => [], // or whatever default
        ]);
    }

    return redirect()->back()->with('success', 'Patient profile created successfully.');
}



}
