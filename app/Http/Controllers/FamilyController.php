<?php

namespace App\Http\Controllers;
use App\Models\ClinicProfile;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function maternal()
    {
        $mothers = ClinicProfile::where('data_spec', 'mother')->get();
        return view('family.maternal', compact('mothers'));
    }

    public function paternal()
    {
        $fathers = ClinicProfile::where('data_spec', 'father')->get();
        return view('family.paternal', compact('fathers'));
    }

    public function offspring()
    {
        $children = ClinicProfile::where('data_spec', 'child')->get();
        return view('family.offspring', compact('children'));
    }  
}
