<?php

namespace App\Http\Controllers;

use App\Address;
use App\Restaurant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\DeliveryAreaPro\DeliveryArea;
use Nwidart\Modules\Facades\Module;

class AddressController extends Controller
{

    /**
     * @param $latitudeFrom
     * @param $longitudeFrom
     * @param $restaurant
     * @return boolean
     */
    private function checkOperation($latitudeFrom, $longitudeFrom, $restaurant)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($restaurant->latitude);
        $lonTo = deg2rad($restaurant->longitude);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        $distance = $angle * 6371; //distance in km

        //if any delivery area assigned
        if (count($restaurant->delivery_areas) > 0) {
            //check if delivery pro module exists,
            if (Module::find('DeliveryAreaPro') && Module::find('DeliveryAreaPro')->isEnabled()) {
                $dap = new DeliveryArea();
                return $dap->checkArea($latitudeFrom, $longitudeFrom, $restaurant->delivery_areas);
            } else {
                //else use geenral distance
                if ($distance <= $restaurant->delivery_radius) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            //if no delivery areas, then use general distance
            if ($distance <= $restaurant->delivery_radius) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @param $id
     */
    public function getAddresses(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            $addresses = Address::where('user_id', $user->id)->orderBy('id', 'DESC')->get();

            //if client sends checkOperationalRestaurant (From Change Address Cart Button) calculate the distance from the restaurant and send back
            if ($request->restaurant_id != null) {
                $restaurant = Restaurant::where('id', $request->restaurant_id)->first();
                if ($restaurant) {
                    $checkedAddress = new Collection();
                    foreach ($addresses as $address) {
                        $check = $this->checkOperation($address->latitude, $address->longitude, $restaurant);
                        if ($check) {
                            $address->is_operational = 1;
                            $checkedAddress->push($address);
                        } else {
                            $address->is_operational = 0;
                            $checkedAddress->push($address);
                        }
                    }
                    // $sorted = $checkedAddress->sortBy('is_operational');
                    return response()->json($checkedAddress);
                }
            }

            return response()->json($addresses);
        }
        return response()->json(['success' => false], 401);

    }

    /**
     * @param Request $request
     */
    public function saveAddress(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $address = new Address();
            $address->user_id = $user->id;
            $address->latitude = $request->latitude;
            $address->longitude = $request->longitude;
            $address->address = $request->address;
            $address->house = $request->house;
            $address->tag = $request->tag;
            $address->save();

            $user->default_address_id = $address->id;
            $user->save();

            if ($request->get_only_default_address !== null) {
                $address = Address::where('id', $user->default_address_id)->get(['address', 'house', 'latitude', 'longitude', 'tag'])->first();
                return response()->json($address);
            }

            $addresses = Address::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
            return response()->json($addresses);
        }
        return response()->json(['success' => false], 401);

    }

    /**
     * @param Request $request
     */
    public function deleteAddress(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $address = Address::where('user_id', $user->id)
                ->where('id', $request->address_id)
                ->first();

            if ($address) {
                $address->delete();
            }

            $addresses = Address::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
            return response()->json($addresses);
        }
        return response()->json(['success' => false], 401);
    }

    /**
     * @param Request $request
     */
    public function setDefaultAddress(Request $request)
    {

        $user = auth()->user();
        if ($user) {

            $user->default_address_id = $request->address_id;
            $user->save();

            $addresses = Address::where('user_id', $user->id)->orderBy('id', 'DESC')->get();

            return response()->json($addresses);
        }
        return response()->json(['success' => false], 401);

    }
}
