<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $table = 'table_municipality';

    protected $fillable = ['municipality_id', 'province_id', 'municipality_name'];

    // Relationship to Province
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    // Relationship to Barangay
    public function barangays()
    {
        return $this->hasMany(Barangay::class, 'municipality_id');
    }
}
