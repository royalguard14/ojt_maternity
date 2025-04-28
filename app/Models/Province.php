<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'table_province';

    protected $fillable = ['province_id', 'region_id', 'province_name'];

    // Relationship to Region
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    // Relationship to Municipality
    public function municipalities()
    {
        return $this->hasMany(Municipality::class, 'province_id');
    }
}
