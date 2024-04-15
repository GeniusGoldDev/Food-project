<?php

namespace App\Http\Controllers;

use App\PopularGeoPlace;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * @param Request $request
     */
    public function popularGeoLocations(Request $request)
    {
        $locations = PopularGeoPlace::where('is_active', '1')
            ->get()
            ->take(20);

        // sleep(5);
        return response()->json($locations);
    }
}
