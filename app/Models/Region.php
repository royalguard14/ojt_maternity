<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    // Define table name if it's not the default (plural of model name)
    protected $table = 'table_region'; 

    // Fillable columns
    protected $fillable = ['region_id', 'region_name', 'region_description'];
    
    // You can add relationships here if needed, for example:
    // public function provinces() {
    //     return $this->hasMany(Province::class, 'region_id');
    // }
}
