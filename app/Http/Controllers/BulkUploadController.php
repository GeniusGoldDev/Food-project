<?php

namespace App\Http\Controllers;

use App\ItemCategory;
use App\Restaurant;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;
use Importer;

class BulkUploadController extends Controller
{
    /**
     * @param Request $request
     */
    public function restaurantBulkUpload(Request $request)
    {
        if ($request->hasFile('restaurant_csv')) {
            $filepath = $request->file('restaurant_csv')->getRealPath();

            $excel = Importer::make('Csv');
            $excel->hasHeader(true);
            $excel->load($filepath);
            $data = $excel->getCollection();

            if (!empty($data) && $data->count()) {
                foreach ($data as $key) {

                    if ($key['name'] == 'NULL') {
                        $name = null;
                    } else {
                        $name = $key['name'];
                    }

                    if ($key['description'] == 'NULL') {
                        $description = null;
                    } else {
                        $description = $key['description'];
                    }

                    if ($key['image'] == 'NULL') {
                        $image = null;
                        $placeholder_image = null;
                    } else {

                        $imageName = $key['image'];
                        $rand_name = time() . $imageName . str_random(10);
                        $filename = $rand_name . '.jpg';
                        Image::make(base_path('assets/img/restaurants/bulk-upload/' . $imageName))
                            ->resize(160, 117)
                            ->save(base_path('assets/img/restaurants/' . $filename), config('appSettings.uploadImageQuality '), 'jpg');
                        $image = '/assets/img/restaurants/' . $filename;

                        $placeholder_image = null;
                    }

                    if ($key['rating'] == 'NULL') {
                        $rating = null;
                    } else {
                        $rating = $key['rating'];
                    }

                    if ($key['delivery_time'] == 'NULL') {
                        $delivery_time = null;
                    } else {
                        $delivery_time = $key['delivery_time'];
                    }

                    if ($key['price_range'] == 'NULL') {
                        $price_range = null;
                    } else {
                        $price_range = $key['price_range'];
                    }

                    if ($key['address'] == 'NULL') {
                        $address = null;
                    } else {
                        $address = $key['address'];
                    }

                    if ($key['pincode'] == 'NULL') {
                        $pincode = null;
                    } else {
                        $pincode = $key['pincode'];
                    }

                    if ($key['landmark'] == 'NULL') {
                        $landmark = null;
                    } else {
                        $landmark = $key['landmark'];
                    }

                    if ($key['latitude'] == 'NULL') {
                        $latitude = null;
                    } else {
                        $latitude = $key['latitude'];
                    }

                    if ($key['longitude'] == 'NULL') {
                        $longitude = null;
                    } else {
                        $longitude = $key['longitude'];
                    }

                    if ($key['certificate'] == 'NULL') {
                        $certificate = null;
                    } else {
                        $certificate = $key['certificate'];
                    }

                    if ($key['restaurant_charges'] == 'NULL') {
                        $restaurant_charges = null;
                    } else {
                        $restaurant_charges = $key['restaurant_charges'];
                    }

                    if ($key['delivery_charges'] == 'NULL') {
                        $delivery_charges = null;
                    } else {
                        $delivery_charges = $key['delivery_charges'];
                    }

                    if ($key['is_pureveg'] == 'NULL') {
                        $is_pureveg = null;
                    } else {
                        $is_pureveg = $key['is_pureveg'];
                    }

                    if ($key['is_featured'] == 'NULL') {
                        $is_featured = null;
                    } else {
                        $is_featured = $key['is_featured'];
                    }

                    if ($key['delivery_type'] == 'NULL') {
                        $delivery_type = 1;
                    } else {
                        $is_featured = $key['delivery_type'];
                    }

                    $slug = str_slug($name) . '-' . str_random(15);

                    $sku = time() . str_random(10);

                    $insert[] = [
                        'name' => $name,
                        'description' => $description,
                        'image' => $image,
                        'rating' => $rating,
                        'delivery_time' => $delivery_time,
                        'price_range' => $price_range,
                        'address' => $address,
                        'pincode' => $pincode,
                        'landmark' => $landmark,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'certificate' => $certificate,
                        'restaurant_charges' => $restaurant_charges,
                        'delivery_charges' => $delivery_charges,
                        'is_pureveg' => $is_pureveg,
                        'slug' => $slug,
                        'placeholder_image' => $placeholder_image,
                        'sku' => $sku,
                        'is_accepted' => 1,
                        'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:m:s'),
                    ];
                }
                if (!empty($insert)) {
                    try {
                        DB::table('restaurants')->insert($insert);
                        return redirect()->back()->with(['success' => 'Operation Successful']);
                    } catch (\Illuminate\Database\QueryException $qe) {
                        return redirect()->back()->with(['message' => $qe->getMessage()]);
                    } catch (Exception $e) {
                        return redirect()->back()->with(['message' => $e->getMessage()]);
                    } catch (\Throwable $th) {
                        return redirect()->back()->with(['message' => $th]);
                    }
                }
            }
        }
    }

    /**
     * @param Request $request
     */
    public function itemBulkUpload(Request $request)
    {
        if ($request->hasFile('item_csv')) {
            $filepath = $request->file('item_csv')->getRealPath();

            $excel = Importer::make('Csv');
            $excel->hasHeader(true);
            $excel->load($filepath);
            $data = $excel->getCollection();

            $check = $data;
            $errors = [];
            $allRestaurantIds = Restaurant::all()->pluck('id')->toArray();
            $allItemCategoryIds = ItemCategory::all()->pluck('id')->toArray();

            if (!empty($check) && $check->count()) {
                foreach ($check as $key) {

                    if (!in_array($key['restaurant_id'], $allRestaurantIds)) {
                        array_push($errors, '"restaurant_id" is invalid for ' . $key['name']);
                    }

                    if (!in_array($key['item_category_id'], $allItemCategoryIds)) {
                        array_push($errors, '"item_category_id" is invalid for ' . $key['name']);
                    }

                    if ($key['image'] != 'NULL') {
                        if (!File::exists(base_path('assets/img/items/bulk-upload/' . $key['image']))) {
                            array_push($errors, '"image" filename is invalid for ' . $key['name']);
                        }
                    }
                }
            }

            //if error,
            if (!empty($errors)) {
                //delete the csv error file
                if (File::exists(storage_path('logs/csv_upload_error.txt'))) {
                    unlink(storage_path('logs/csv_upload_error.txt'));
                }
                //write all the errors on one file
                $message = 'Total Errors: ' . count($errors) . PHP_EOL;
                file_put_contents(storage_path('logs/csv_upload_error.txt'), $message, FILE_APPEND);
                $message = '-----------------' . PHP_EOL . PHP_EOL;
                file_put_contents(storage_path('logs/csv_upload_error.txt'), $message, FILE_APPEND);
                foreach ($errors as $key => $error) {
                    $message = $key + 1 . '. ' . $error . PHP_EOL;
                    file_put_contents(storage_path('logs/csv_upload_error.txt'), $message, FILE_APPEND);
                }

                //download the file
                return response()->download(storage_path('logs/csv_upload_error.txt'));
            }

            if (!empty($data) && $data->count()) {
                foreach ($data as $key) {

                    if ($key['name'] == 'NULL') {
                        $name = null;
                    } else {
                        $name = $key['name'];
                    }

                    if ($key['restaurant_id'] == 'NULL') {
                        $restaurant_id = null;
                    } else {
                        $restaurant_id = $key['restaurant_id'];
                    }

                    if ($key['item_category_id'] == 'NULL') {
                        $item_category_id = null;
                    } else {
                        $item_category_id = $key['item_category_id'];
                    }

                    if ($key['price'] == 'NULL') {
                        $price = null;
                    } else {
                        $price = $key['price'];
                    }

                    if ($key['image'] == 'NULL') {
                        $image = null;
                        $placeholder_image = null;
                    } else {
                        $imageName = $key['image'];
                        $rand_name = time() . str_random(10);

                        $filename = $rand_name . '.' . $imageName;
                        $filename = substr($filename, 0, strrpos($filename, '.')) . '.jpg';

                        Image::make(base_path('assets/img/items/bulk-upload/' . $imageName))
                            ->resize(486, 355)
                            ->save(base_path('assets/img/items/' . $filename), config('appSettings.uploadImageQuality '), 'jpg');

                        $image = '/assets/img/items/' . $filename;

                        $placeholder_image = null;
                    }

                    if ($key['is_recommended'] == 'NULL') {
                        $is_recommended = null;
                    } else {
                        $is_recommended = $key['is_recommended'];
                    }

                    if ($key['is_popular'] == 'NULL') {
                        $is_popular = null;
                    } else {
                        $is_popular = $key['is_popular'];
                    }

                    if ($key['is_new'] == 'NULL') {
                        $is_new = null;
                    } else {
                        $is_new = $key['is_new'];
                    }

                    if ($key['desc'] == 'NULL') {
                        $desc = null;
                    } else {
                        $desc = $key['desc'];
                    }

                    if ($key['is_veg'] == 'NULL') {
                        $is_veg = null;
                    } else {
                        $is_veg = $key['is_veg'];
                    }

                    $insert[] = [
                        'name' => $name,
                        'restaurant_id' => $restaurant_id,
                        'item_category_id' => $item_category_id,
                        'price' => $price,
                        'image' => $image,
                        'placeholder_image' => $placeholder_image,
                        'is_recommended' => $is_recommended,
                        'is_popular' => $is_popular,
                        'is_new' => $is_new,
                        'desc' => $desc,
                        'is_veg' => $is_veg,
                        'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:m:s'),
                    ];
                }
                if (!empty($insert)) {
                    try {
                        DB::table('items')->insert($insert);
                        return redirect()->back()->with(['success' => 'Operation Successful']);
                    } catch (\Illuminate\Database\QueryException $qe) {
                        return redirect()->back()->with(['message' => $qe->getMessage()]);
                    } catch (Exception $e) {
                        return redirect()->back()->with(['message' => $e->getMessage()]);
                    } catch (\Throwable $th) {
                        return redirect()->back()->with(['message' => $th]);
                    }
                }
            }
        }
    }

    /**
     * @param Request $request
     */
    public function itemBulkUploadFromRestaurant(Request $request)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        if ($request->hasFile('item_csv')) {
            $filepath = $request->file('item_csv')->getRealPath();

            $excel = Importer::make('Csv');
            $excel->hasHeader(true);
            $excel->load($filepath);
            $data = $excel->getCollection();

            $check = $data;
            $errors = [];
            $allRestaurantIds = Restaurant::all()->pluck('id')->toArray();
            $allItemCategoryIds = ItemCategory::all()->pluck('id')->toArray();

            if (!empty($check) && $check->count()) {
                foreach ($check as $key) {

                    if (!in_array($key['restaurant_id'], $allRestaurantIds)) {
                        array_push($errors, '"restaurant_id" is invalid for ' . $key['name']);
                    }

                    if (!in_array($key['item_category_id'], $allItemCategoryIds)) {
                        array_push($errors, '"item_category_id" is invalid for ' . $key['name']);
                    }

                    if ($key['image'] != 'NULL') {
                        if (!File::exists(base_path('assets/img/items/bulk-upload/' . $key['image']))) {
                            array_push($errors, '"image" filename is invalid for ' . $key['name']);
                        }
                    }

                }
            }

            //if error,
            if (!empty($errors)) {
                //delete the csv error file
                unlink(storage_path('logs/csv_upload_error.txt'));

                //write all the errors on one file
                $message = 'Total Errors: ' . count($errors) . PHP_EOL;
                file_put_contents(storage_path('logs/csv_upload_error.txt'), $message, FILE_APPEND);
                $message = '-----------------' . PHP_EOL . PHP_EOL;
                file_put_contents(storage_path('logs/csv_upload_error.txt'), $message, FILE_APPEND);
                foreach ($errors as $key => $error) {
                    $message = $key + 1 . '. ' . $error . PHP_EOL;
                    file_put_contents(storage_path('logs/csv_upload_error.txt'), $message, FILE_APPEND);
                }

                //download the file
                return response()->download(storage_path('logs/csv_upload_error.txt'));
            }

            if (!empty($data) && $data->count()) {
                foreach ($data as $key) {

                    if ($key['name'] == 'NULL') {
                        $name = null;
                    } else {
                        $name = $key['name'];
                    }

                    if ($key['restaurant_id'] == 'NULL') {
                        $restaurant_id = null;
                    } else {
                        if (in_array($key['restaurant_id'], $restaurantIds)) {
                            $restaurant_id = $key['restaurant_id'];

                        } else {
                            $restaurant_id = null;
                        }

                    }

                    if ($key['item_category_id'] == 'NULL') {
                        $item_category_id = null;
                    } else {
                        $item_category_id = $key['item_category_id'];
                    }

                    if ($key['price'] == 'NULL') {
                        $price = null;
                    } else {
                        $price = $key['price'];
                    }

                    if ($key['image'] == 'NULL') {
                        $image = null;
                        $placeholder_image = null;
                    } else {
                        $imageName = $key['image'];
                        $rand_name = time() . str_random(10);

                        $filename = $rand_name . '.' . $imageName;
                        $filename = substr($filename, 0, strrpos($filename, '.')) . '.jpg';

                        Image::make(base_path('assets/img/items/bulk-upload/' . $imageName))
                            ->resize(486, 355)
                            ->save(base_path('assets/img/items/' . $filename), config('appSettings.uploadImageQuality '), 'jpg');

                        $image = '/assets/img/items/' . $filename;

                        $placeholder_image = null;
                    }

                    if ($key['is_recommended'] == 'NULL') {
                        $is_recommended = null;
                    } else {
                        $is_recommended = $key['is_recommended'];
                    }

                    if ($key['is_popular'] == 'NULL') {
                        $is_popular = null;
                    } else {
                        $is_popular = $key['is_popular'];
                    }

                    if ($key['is_new'] == 'NULL') {
                        $is_new = null;
                    } else {
                        $is_new = $key['is_new'];
                    }

                    if ($key['desc'] == 'NULL') {
                        $desc = null;
                    } else {
                        $desc = $key['desc'];
                    }

                    if ($key['is_veg'] == 'NULL') {
                        $is_veg = null;
                    } else {
                        $is_veg = $key['is_veg'];
                    }

                    $insert[] = [
                        'name' => $name,
                        'restaurant_id' => $restaurant_id,
                        'item_category_id' => $item_category_id,
                        'price' => $price,
                        'image' => $image,
                        'placeholder_image' => $placeholder_image,
                        'is_recommended' => $is_recommended,
                        'is_popular' => $is_popular,
                        'is_new' => $is_new,
                        'desc' => $desc,
                        'is_veg' => $is_veg,
                        'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:m:s'),
                    ];
                }
                if (!empty($insert)) {
                    try {
                        DB::table('items')->insert($insert);
                        return redirect()->back()->with(['success' => 'Operation Successful']);
                    } catch (\Illuminate\Database\QueryException $qe) {
                        return redirect()->back()->with(['message' => $qe->getMessage()]);
                    } catch (Exception $e) {
                        return redirect()->back()->with(['message' => $e->getMessage()]);
                    } catch (\Throwable $th) {
                        return redirect()->back()->with(['message' => $th]);
                    }
                }
            }
        }
    }
}
