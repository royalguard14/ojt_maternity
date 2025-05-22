<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterSetup extends Model
{
      protected $fillable = [
        'printer_brand',
        'printer_unit',
        'form_no',
        'printer_setting',
    ];

    protected $casts = [
        'printer_setting' => 'array',
    ];
}
