<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

        'residence_brgy',
        'residence_city',
        'residence_province',
        'residence_country',

        'gender',
    
        'phone',
        'occupation',
        'religion',
        'citizenship',
    ];



public function getFullResidenceAttribute()
{
    return collect([
        $this->residence_brgy,
        $this->residence_city,
        $this->residence_province,
        $this->residence_country,
    ])->filter()->implode(', ');
} 

public function getFullPlaceOfBirthAttribute()
{
    return collect([
        $this->place_of_birth_brgy,
        $this->place_of_birth_city,
        $this->place_of_birth_province,
        $this->place_of_birth_country,
    ])->filter()->implode(', ');
}


public function getFormattedBirthDateAttribute()
{
    return Carbon::parse($this->birth_date)->translatedFormat('F d, Y'); 
}

public function getAgeAttribute()
{
    return \Carbon\Carbon::parse($this->birth_date)->age;
}


public function relationshipAsMother()
{
    return $this->hasOne(ClinicProfileRelationship::class, 'mother_id');
}

public function relationshipAsFather()
{
    return $this->hasOne(ClinicProfileRelationship::class, 'father_id');
}

public function parents()
{
    return ClinicProfileRelationship::whereJsonContains('child_ids', $this->id)->first();
}


public function husband()
{
    return $this->hasOneThrough(
        ClinicProfile::class,  
        ClinicProfileRelationship::class,  
        'mother_id',  
        'id',  
        'id',  
        'father_id'  
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


public function getFullNameAttribute()
{
    return ucwords(
        $this->last_name . ', ' . 
        $this->first_name .
        (!empty($this->middle_name) ? ' ' . strtoupper(substr($this->middle_name, 0, 1)) . '.' : '') .
        (!empty($this->suffix) ? ' ' . $this->suffix : '')
    );
}




    
}
