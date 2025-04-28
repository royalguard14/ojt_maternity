<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicProfileRelationship extends Model
{
    use HasFactory;

    protected $fillable = ['mother_id', 'father_id', 'child_ids'];

    protected $casts = [
        'child_ids' => 'array',
    ];

    public function mother()
    {
        return $this->belongsTo(ClinicProfile::class, 'mother_id');
    }

    public function father()
    {
        return $this->belongsTo(ClinicProfile::class, 'father_id');
    }

    public function children()
    {
        return ClinicProfile::whereIn('id', $this->child_ids)->get();
    }
}
