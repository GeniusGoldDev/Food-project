<?php

namespace App\Http\Controllers;

use App\PromoSlider;
use App\Slide;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\DeliveryAreaPro\DeliveryArea;
use Modules\SuperCache\SuperCache;
use Nwidart\Modules\Facades\Module;

class PromoSliderController extends Controller
{
    /**
     * @param $name
     * @param $data
     */
    private function processSuperCache($name, $data = null)
    {
        if (Module::find('SuperCache') && Module::find('SuperCache')->isEnabled()) {
            $superCache = new SuperCache();
            $superCache->cacheResponse($name, $data);
        }
    }
    /**
     * @param Request $request
     */
    public function promoSlider(Request $request)
    {

        $mainSlider = PromoSlider::where('position_id', 0)->where('is_active', 1)->first();
        $this->processSuperCache('main-slider', $mainSlider);

        $otherPosition = PromoSlider::whereIn('position_id', [1, 2, 3, 4, 5, 6])->where('is_active', 1)->first();
        $this->processSuperCache('other-position-slider', $otherPosition);

        // if present then return that for all locations
        // return response()->json($mainSlider);
        if ($mainSlider) {

            $mainSlides = Slide::where('promo_slider_id', $mainSlider->id)
                ->where('is_active', '1')
                ->with('promo_slider', 'restaurant', 'item', 'item.restaurant', 'restaurant.delivery_areas', 'item.restaurant.delivery_areas')
                ->ordered()
                ->get();

            $availableMainSlides = new Collection();

            foreach ($mainSlides as $mainSlide) {
                $url = null;

                if ($mainSlide->model == null) {
                    $check = true;
                }

                //for store
                if ($mainSlide->model == 1) {
                    $check = $this->checkOperation($request->latitude, $request->longitude, $mainSlide->restaurant);
                    if ($check) {
                        $mainSlide->slug = 'stores/' . $mainSlide->restaurant->slug;
                    }
                }

                //for item
                if ($mainSlide->model == 2) {
                    $check = $this->checkOperation($request->latitude, $request->longitude, $mainSlide->item->restaurant);
                    if ($check) {
                        $mainSlide->slug = 'stores/' . $mainSlide->item->restaurant->slug . '/' . $mainSlide->item->id;
                    }
                }

                //for custom url
                if ($mainSlide->model == 3) {
                    if ($mainSlide->is_locationset) {
                        $data = collect([
                            'latitude' => $mainSlide->latitude,
                            'longitude' => $mainSlide->longitude,
                            'delivery_radius' => $mainSlide->radius,
                            'delivery_areas' => [],
                        ]);
                        $data = json_decode($data);
                        $check = $this->checkOperation($request->latitude, $request->longitude, $data);
                        if ($check) {
                            $mainSlide->slug = $mainSlide->url;
                        }
                    } else {
                        $check = true;
                        if ($check) {
                            $mainSlide->slug = $mainSlide->url;
                        }
                    }
                }

                if ($check) {
                    $availableMainSlides->push($mainSlide);
                }

            }

            $availableMainSlides->toArray();

            $availableMainSlides = $availableMainSlides->map(function ($slide) {
                return [
                    'data' => $slide->only(['id', 'name', 'image', 'model']),
                    'url' => $slide->slug,
                    'promo_slider' => [
                        'size' => $slide->promo_slider->size,
                    ],
                ];
            });

            $this->processSuperCache('main-slider-slides-' . $mainSlider->id, $availableMainSlides);

        } else {
            $availableMainSlides = null;
        }

        if ($otherPosition) {

            $otherSlides = Slide::where('promo_slider_id', $otherPosition->id)
                ->where('is_active', '1')
                ->with('promo_slider', 'restaurant', 'item', 'item.restaurant', 'restaurant.delivery_areas', 'item.restaurant.delivery_areas')
                ->ordered()
                ->get();

            $availableOtherSlides = new Collection();

            foreach ($otherSlides as $otherSlide) {
                $url = null;

                if ($otherSlide->model == null) {
                    $check = true;
                }

                //for store
                if ($otherSlide->model == 1) {
                    $check = $this->checkOperation($request->latitude, $request->longitude, $otherSlide->restaurant);
                    if ($check) {
                        $otherSlide->slug = 'stores/' . $otherSlide->restaurant->slug;
                    }
                }

                //for item
                if ($otherSlide->model == 2) {
                    $check = $this->checkOperation($request->latitude, $request->longitude, $otherSlide->item->restaurant);
                    if ($check) {
                        $otherSlide->slug = 'stores/' . $otherSlide->item->restaurant->slug . '/' . $otherSlide->item->id;
                    }
                }

                //for custom url
                if ($otherSlide->model == 3) {
                    if ($otherSlide->is_locationset) {
                        $data = collect([
                            'latitude' => $otherSlide->latitude,
                            'longitude' => $otherSlide->longitude,
                            'delivery_radius' => $otherSlide->radius,
                            'delivery_areas' => [],
                        ]);
                        $data = json_decode($data);
                        $check = $this->checkOperation($request->latitude, $request->longitude, $data);
                        if ($check) {
                            $otherSlide->slug = $otherSlide->url;
                        }
                    } else {
                        $check = true;
                        if ($check) {
                            $otherSlide->slug = $otherSlide->url;
                        }
                    }
                }

                if ($check) {
                    $availableOtherSlides->push($otherSlide);
                }

            }

            $availableOtherSlides->toArray();

            $availableOtherSlides = $availableOtherSlides->map(function ($slide) {
                return [
                    'data' => $slide->only(['id', 'name', 'image', 'model']),
                    'url' => $slide->slug,
                    'promo_slider' => [
                        'size' => $slide->promo_slider->size,
                        'position_id' => $slide->promo_slider->position_id,
                    ],
                ];
            });

            // $this->processSuperCache('main-slider-slides-' . $mainSlider->id, $availableOtherSlides);

        } else {
            $availableOtherSlides = null;
        }

        $response = [
            'mainSlides' => $availableMainSlides,
            'otherSlides' => $availableOtherSlides,
        ];
        return response()->json($response);
    }

    /**
     * @param $latitudeFrom
     * @param $longitudeFrom
     * @param $restaurant
     * @return mixed
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
}
