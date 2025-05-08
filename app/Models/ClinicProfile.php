<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Barangay;

class ClinicProfile extends Model
{
    use HasFactory;

    protected $table = 'clinic_profiles';

    protected $fillable = [
        'data_spec',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'birth_date',

        'place_of_birth_brgy',
        'place_of_birth_city',
        'place_of_birth_province',
        'place_of_birth_country',

        'gender',

        'residence_brgy',
        'residence_city',
        'residence_province',
        'residence_country',

        'phone',
        'occupation',
        'religion',
        'citizenship',
    ];

    protected $appends = ['full_name', 'age', 'full_residence', 'full_place_of_birth'];

    // === Accessors ===

    public function getFullNameAttribute()
    {
        return ucwords(
            $this->last_name . ', ' .
            $this->first_name .
            (!empty($this->middle_name) ? ' ' . strtoupper(substr($this->middle_name, 0, 1)) . '.' : '') .
            (!empty($this->suffix) ? ' ' . $this->suffix : '')
        );
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

public function getFullResidenceAttribute()
{
    $province = Province::where('province_id', $this->residence_province)->first();
    $municipality = Municipality::where('municipality_id', $this->residence_city)->first();
    $barangay = Barangay::where('barangay_id', $this->residence_brgy)->first();

    $provinceName = $province ? $province->province_name : null;
    $municipalityName = $municipality ? $municipality->municipality_name : null;
    $barangayName = $barangay ? $barangay->barangay_name : null;

    return collect([
        $barangayName,
        $municipalityName,
        $provinceName,
        $this->residence_country,
    ])->filter()->implode(', ');
}


    public function getFormattedBirthDateAttribute()
    {
        return Carbon::parse($this->birth_date)->translatedFormat('F d, Y'); 
    }

    // === Relationships ===

    public function relationshipAsMother()
    {
        return $this->hasOne(ClinicProfileRelationship::class, 'mother_id');
    }

    public function relationshipAsFather()
    {
        return $this->hasOne(ClinicProfileRelationship::class, 'father_id');
    }

    public function husband()
    {
        return $this->hasOneThrough(
            ClinicProfile::class,
            ClinicProfileRelationship::class,
            'mother_id', // foreign key on relationship
            'id',        // local key on clinic_profiles (husband)
            'id',        // local key on clinic_profiles (this)
            'father_id'  // foreign key on relationship
        );
    }

    public function wife()
    {
        return $this->hasOneThrough(
            ClinicProfile::class,
            ClinicProfileRelationship::class,
            'father_id',
            'id',
            'id',
            'mother_id'
        );
    }

    public function parents()
    {
        return ClinicProfileRelationship::whereJsonContains('child_ids', $this->id)->first();
    }





    public function birthProvince()
{
    return $this->belongsTo(Province::class, 'place_of_birth_province', 'province_id');
}

public function birthCity()
{
    return $this->belongsTo(Municipality::class, 'place_of_birth_city', 'municipality_id');
}

public function birthBarangay()
{
    return $this->belongsTo(Barangay::class, 'place_of_birth_brgy', 'barangay_id');
}



public function getFullPlaceOfBirthAttribute()
{
    $province = Province::where('province_id', $this->place_of_birth_province)->first();
    $municipality = Municipality::where('municipality_id', $this->place_of_birth_city)->first();
    $barangay = Barangay::where('barangay_id', $this->place_of_birth_brgy)->first();

    $provinceName = $province ? $province->province_name : null;
    $municipalityName = $municipality ? $municipality->municipality_name : null;
    $barangayName = $barangay ? $barangay->barangay_name : null;

    return collect([$barangayName, $municipalityName, $provinceName])
        ->filter()
        ->implode(', ');
}













}
