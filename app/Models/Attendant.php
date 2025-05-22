<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'address',
    ];

    // One attendant can attend many birth records
    public function birthInfos()
    {
        return $this->hasMany(BirthInfo::class);
    }
}
