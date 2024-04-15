<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeocoderController extends Controller
{
    /**
     * @param Request $request
     */
    public function coordinatesToAddress(Request $request)
    {

        try {
            $response = \Geocoder::getAddressForCoordinates($request->lat, $request->lng);

            if (config('appSettings.googleFullAddress') == 'false') {
                $allowedTypes = ['street_address', 'sublocality', 'subpremise', 'premise', 'street_number', 'floor', 'establishment', 'point_of_interest', 'parking', 'post_box', 'postal_town', 'room', 'bus_station', 'train_station', 'transit_station'];
                $finalAddress = '';
                $count = count($response['address_components']);

                foreach ($response['address_components'] as $key => $address) {
                    if (isset($address->types)) {
                        foreach ($address->types as $type) {
                            $allowed = false;
                            if (!in_array($type, $allowedTypes)) {
                                $allowed = true;
                            }
                        }
                        if ($allowed) {
                            $finalAddress .= $address->long_name;
                            if ($key + 1 != $count) {
                                $finalAddress .= ', ';
                            }
                        }
                    }

                }
                return response()->json($finalAddress);
            } else {
                return response()->json($response['formatted_address']);
            }

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
        }

    }

    /**
     * @param Request $request
     */
    public function addressToCoordinates(Request $request)
    {
        $address = \Geocoder::getCoordinatesForAddress($request->string);
        return response()->json($address);
    }

}
