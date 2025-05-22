<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'type_of_birth',
        'child_was',
        'birth_order',
        'weight_at_birth',
        'total_number_of_children_alive',
        'number_of_children_still_leaving',
        'total_number_of_children_alive_dead',
        'age_of_father',
        'age_of_mother',
    ];

    public function profile()
    {
        return $this->belongsTo(ClinicProfile::class, 'profile_id');
    }


public function attendant()
{
    return $this->belongsTo(Attendant::class, 'attendant_id');
}



    
}
