<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Barangay;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // Fetch Provinces by Region ID
    public function getProvinces($region_id)
    {
        $provinces = Province::where('region_id', $region_id)->get();
        return response()->json($provinces);
    }

    // Fetch Municipalities by Province ID
    public function getMunicipalities($province_id)
    {
        $municipalities = Municipality::where('province_id', $province_id)->get();
        return response()->json($municipalities);
    }

    // Fetch Barangays by Municipality ID
    public function getBarangays($municipality_id)
    {
        $barangays = Barangay::where('municipality_id', $municipality_id)->get();
        return response()->json($barangays);
    }
}
