<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $table = 'table_barangay';

    protected $fillable = ['barangay_id', 'municipality_id', 'barangay_name'];

    // Relationship to Municipality
    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }
}
