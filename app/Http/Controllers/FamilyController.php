<?php

namespace App\Http\Controllers;

use App\Models\ClinicProfile;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function maternal()
    {
        $layout = auth()->user()->role->role_name === 'Developer'
            ? 'layouts.master'
            : 'layouts.master-front';

        $mothers = ClinicProfile::where('data_spec', 'mother')->get();
        return view('family.maternal', compact('mothers', 'layout'));
    }

    public function paternal()
    {
        $layout = auth()->user()->role->role_name === 'Developer'
            ? 'layouts.master'
            : 'layouts.master-front';

        $fathers = ClinicProfile::where('data_spec', 'father')->get();
        return view('family.paternal', compact('fathers', 'layout'));
    }

    public function offspring()
    {
        $layout = auth()->user()->role->role_name === 'Developer'
            ? 'layouts.master'
            : 'layouts.master-front';

        $children = ClinicProfile::where('data_spec', 'child')->get();
        return view('family.offspring', compact('children', 'layout'));
    }  
}
