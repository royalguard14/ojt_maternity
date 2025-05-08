<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    // Specify the correct table name
    protected $table = 'table_province';

    // Set the primary key column name
    protected $primaryKey = 'province_id';

    // Define the fillable columns
    protected $fillable = ['province_id', 'region_id', 'province_name'];

    // Define relationship with Region model
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    // Define relationship with Municipality model
    public function municipalities()
    {
        return $this->hasMany(Municipality::class, 'province_id');
    }
}
