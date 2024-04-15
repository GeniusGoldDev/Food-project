<?php

namespace App\Http\Controllers;

use App\RestaurantCategory;
use App\RestaurantCategorySlider;
use App\Setting;
use Exception;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Image;

class RestaurantCategoryController extends Controller
{
    public function restaurantCategorySlider()
    {
        $categoriesCount = RestaurantCategory::get()->count();
        $restaurantCategories = RestaurantCategory::get();
        $restaurantCategoriesActive = RestaurantCategory::where('is_active', '1')->get();
        $restaurantCategorySlider = RestaurantCategorySlider::ordered()->get();

        return view('admin.restaurantCategorySlider', array(
            'categoriesCount' => $categoriesCount,
            'restaurantCategories' => $restaurantCategories,
            'restaurantCategoriesActive' => $restaurantCategoriesActive,
            'restaurantCategorySlider' => $restaurantCategorySlider,
        ));
    }

    /**
     * @param Request $request
     */
    public function newRestaurantCategory(Request $request)
    {
        $resCat = new RestaurantCategory();
        $resCat->name = $request->name;

        if ($request->is_active == 'true') {
            $resCat->is_active = true;
        } else {
            $resCat->is_active = false;
        }
        $resCat->save();

        return redirect()->back()->with(['success' => 'Restaurant Category Created']);
    }
    /**
     * @param Request $request
     */
    public function createRestaurantCategorySlide(Request $request)
    {
        $slide = new RestaurantCategorySlider();

        $slide->name = $request->name;

        $image = $request->file('image');
        $rand_name = time() . str_random(10);
        $filename = $rand_name . '.' . $image->getClientOriginalExtension();
        $filename_sm = $rand_name . '-sm.' . $image->getClientOriginalExtension();

        Image::make($image)
            ->resize(384, 384)
            ->save(base_path('assets/img/slider/' . $filename));
        $slide->image = '/assets/img/slider/' . $filename;

        Image::make($image)
            ->resize(20, 20)
            ->save(base_path('assets/img/slider/small/' . $filename_sm));
        $slide->image_placeholder = '/assets/img/slider/small/' . $filename_sm;

        $slide->categories_ids = $request->restaurant_categories;

        try {
            $slide->save();
            return redirect()->back()->with(['success' => 'Slide Created']);
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(['message' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => $th]);
        }
    }

    /**
     * @param $id
     */
    public function deleteRestaurantCategorySlide($id)
    {
        $slide = RestaurantCategorySlider::where('id', $id)->first();

        if ($slide) {
            $slide->delete();
            return redirect()->back()->with(['success' => 'Slide Deleted']);
        }
        return redirect()->back()->with(['message' => 'Not Found']);
    }

    /**
     * @param $id
     */
    public function disableRestaurantCategorySlide($id)
    {
        $slide = RestaurantCategorySlider::where('id', $id)->first();

        if ($slide) {
            $slide->toggleActive()->save();
            return redirect()->back()->with(['success' => 'Opearation Successful']);
        }
        return redirect()->back()->with(['message' => 'Not Found']);
    }

    /**
     * @param Request $request
     */
    public function updateRestaurantCategory(Request $request)
    {
        $category = RestaurantCategory::where('id', $request->id)->first();

        if ($category) {
            $category->name = $request->name;

            if ($request->is_active == 'true') {
                $category->is_active = true;
            } else {
                $category->is_active = false;
            }
            $category->save();

            return response()->json(true);
        }
        return response()->json(false);
    }

    public function getRestaurantCategorySlider()
    {
        $slides = RestaurantCategorySlider::where('is_active', '1')
            ->ordered()
            ->get(['id', 'name', 'image', 'image_placeholder', 'categories_ids']);

        foreach ($slides as $slide) {
            $newArr = new Collection();

            $resCats = RestaurantCategory::whereIn('id', $slide->categories_ids)->get();

            foreach ($resCats as $resCat) {
                $arr = [
                    'value' => (int) $resCat->id,
                    'label' => $resCat->name,
                ];
                $newArr->push($arr);
            }
            $slide['categories_ids'] = $newArr;
        }

        return response()->json($slides);
    }

    public function getAllRestaurantsCategories()
    {
        $categories = RestaurantCategory::where('is_active', '1')->get();

        if (count($categories) > 0) {
            $response = [
                'status' => true,
                'categories' => $categories,
            ];
            return response()->json($response);
        }
        $response = [
            'status' => false,
            'message' => 'No active categories found',
        ];
        return response()->json($response);
    }

    /**
     * @param Request $request
     */
    public function saveRestaurantCategorySliderSettings(Request $request, Factory $cache)
    {
        $allSettings = $request->all();

        foreach ($allSettings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting != null) {
                $setting->value = $value;
                $setting->save();
            }
        }

        $setting = Setting::where('key', 'enRestaurantCategorySlider')->first();
        if ($request->enRestaurantCategorySlider == 'true') {
            $setting->value = 'true';
            $setting->save();
        } else {
            $setting->value = 'false';
            $setting->save();
        }

        $setting = Setting::where('key', 'showRestaurantCategorySliderLabel')->first();
        if ($request->showRestaurantCategorySliderLabel == 'true') {
            $setting->value = 'true';
            $setting->save();
        } else {
            $setting->value = 'false';
            $setting->save();
        }

        $cache->forget('settings'); //reset cache
        return redirect()->back()->with(['success' => 'Operation Successful']);
    }

    /**
     * @param Request $request
     */
    public function updateCategorySlidePosition(Request $request)
    {
        RestaurantCategorySlider::setNewOrder($request->newOrder);
        return response()->json(['success' => true]);
    }
}
