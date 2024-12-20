<?php

namespace App\Http\Controllers;

use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Thana;

class LocationController extends Controller
{
    public function getDistricts($division_id)
    {
        return response()->json(District::where('division_id', $division_id)->get());
    }

    public function getThanas($district_id)
    {
        return response()->json(Thana::where('district_id', $district_id)->get());
    }
}

