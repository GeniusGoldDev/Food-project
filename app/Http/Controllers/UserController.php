<?php
namespace App\Http\Controllers;

use App\AcceptDelivery;
use App\Address;
use App\Rating;
use App\Restaurant;
use App\SmsOtp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ixudra\Curl\Facades\Curl;
use JWTAuth;
use JWTAuthException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    private function getToken($email, $password)
    {
        $token = null;
        //$credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt(['email' => $email, 'password' => $password])) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'Password or email is invalid..',
                    'token' => $token,
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'Token creation failed',
            ]);
        }
        return $token;
    }

    /**
     * @param Request $request
     */
    public function login(Request $request)
    {

        $user = \App\User::where('email', $request->email)->get()->first();

        //check if it is coming from social login,
        if ($request->accessToken != null) {

            //check socialtoken validation
            $validation = $this->validateAccessToken($request->email, $request->provider, $request->accessToken);
            if ($validation) {
                if ($user) {
                    //user exists -> check if user has phone
                    if ($user->phone != null) {
                        // user has phone
                        //LOGIN USER
                        $token = JWTAuth::fromUser($user);
                        $user->auth_token = $token;

                        // Add address if address present
                        if (isset($request->address['lat'])) {
                            $address = new Address();
                            $address->user_id = $user->id;
                            $address->latitude = $request->address['lat'];
                            $address->longitude = $request->address['lng'];
                            $address->address = $request->address['address'];
                            $address->house = $request->address['house'];
                            $address->tag = $request->address['tag'];
                            $address->save();
                            $user->default_address_id = $address->id;
                        }

                        $user->save();
                        if ($user->default_address_id !== 0) {
                            $default_address = \App\Address::where('id', $user->default_address_id)->get(['address', 'house', 'latitude', 'longitude', 'tag'])->first();
                        } else {
                            $default_address = null;
                        }

                        $running_order = null;

                        $response = [
                            'success' => true,
                            'data' => [
                                'id' => $user->id,
                                'auth_token' => $token,
                                'name' => $user->name,
                                'email' => $user->email,
                                'phone' => $user->phone,
                                'default_address_id' => $user->default_address_id,
                                'default_address' => $default_address,
                                'delivery_pin' => $user->delivery_pin,
                                'wallet_balance' => $user->balanceFloat,
                                'avatar' => $user->avatar,
                                'tax_number' => $user->tax_number,
                            ],
                            'running_order' => $running_order,
                        ];
                        return response()->json($response);
                    }
                    if ($request->phone != null) {
                        $checkPhone = User::where('phone', $request->phone)->first();
                        if ($checkPhone) {
                            $response = [
                                'email_phone_already_used' => true,
                            ];
                            return response()->json($response);
                        } else {
                            try {
                                $user->phone = $request->phone;
                                $user->save();
                                $token = JWTAuth::fromUser($user);
                                $user->auth_token = $token;

                                // Add address if address present
                                if (isset($request->address['lat'])) {
                                    $address = new Address();
                                    $address->user_id = $user->id;
                                    $address->latitude = $request->address['lat'];
                                    $address->longitude = $request->address['lng'];
                                    $address->address = $request->address['address'];
                                    $address->house = $request->address['house'];
                                    $address->tag = $request->address['tag'];
                                    $address->save();
                                    $user->default_address_id = $address->id;
                                }

                                $user->save();
                            } catch (\Throwable $e) {
                                $response = ['success' => false, 'data' => 'Something went wrong. Please try again...'];
                                return response()->json($response, 201);
                            }

                            if ($user->default_address_id !== 0) {
                                $default_address = \App\Address::where('id', $user->default_address_id)->get(['address', 'house', 'latitude', 'longitude', 'tag'])->first();
                            } else {
                                $default_address = null;
                            }

                            $running_order = null;

                            $response = [
                                'success' => true,
                                'data' => [
                                    'id' => $user->id,
                                    'auth_token' => $token,
                                    'name' => $user->name,
                                    'email' => $user->email,
                                    'phone' => $user->phone,
                                    'default_address_id' => $user->default_address_id,
                                    'default_address' => $default_address,
                                    'delivery_pin' => $user->delivery_pin,
                                    'wallet_balance' => $user->balanceFloat,
                                    'avatar' => $user->avatar,
                                    'tax_number' => $user->tax_number,
                                ],
                                'running_order' => $running_order,
                            ];

                            return response()->json($response);
                        }

                    } else {
                        $response = [
                            'enter_phone_after_social_login' => true,
                        ];
                        return response()->json($response);
                    }
                } else {
                    // there is no user with this email..

                    if ($request->phone != null) {
                        $checkPhone = User::where('phone', $request->phone)->first();
                        if ($checkPhone) {
                            $response = [
                                'email_phone_already_used' => true,
                            ];
                            return response()->json($response);
                        } else {
                            enSovCheck($request);

                            //reg user
                            $user = new User();
                            $user->name = $request->name;
                            $user->email = $request->email;
                            $user->phone = $request->phone;
                            $user->password = \Hash::make(str_random(8));
                            $user->delivery_pin = strtoupper(str_random(5));
                            $user->user_ip = $request->ip();

                            try {
                                $user->save();
                                $user->assignRole('Customer');
                                $token = JWTAuth::fromUser($user);
                                $user->auth_token = $token;

                                // Add address if address present
                                if (isset($request->address['lat'])) {
                                    $address = new Address();
                                    $address->user_id = $user->id;
                                    $address->latitude = $request->address['lat'];
                                    $address->longitude = $request->address['lng'];
                                    $address->address = $request->address['address'];
                                    $address->house = $request->address['house'];
                                    $address->tag = $request->address['tag'];
                                    $address->save();
                                    $user->default_address_id = $address->id;
                                }

                                $user->save();
                            } catch (\Throwable $e) {
                                $response = ['success' => false, 'data' => 'Something went wrong. Please try again...'];
                                return response()->json($response, 201);
                            }

                            if ($user->default_address_id !== 0) {
                                $default_address = \App\Address::where('id', $user->default_address_id)->get(['address', 'house', 'latitude', 'longitude', 'tag'])->first();
                            } else {
                                $default_address = null;
                            }

                            $running_order = null;

                            $response = [
                                'success' => true,
                                'data' => [
                                    'id' => $user->id,
                                    'auth_token' => $token,
                                    'name' => $user->name,
                                    'email' => $user->email,
                                    'phone' => $user->phone,
                                    'default_address_id' => $user->default_address_id,
                                    'default_address' => $default_address,
                                    'delivery_pin' => $user->delivery_pin,
                                    'wallet_balance' => $user->balanceFloat,
                                    'avatar' => $user->avatar,
                                    'tax_number' => $user->tax_number,
                                ],
                                'running_order' => $running_order,
                            ];
                            return response()->json($response);
                        }

                    } else {
                        // SHOW ENTER PHONE NUMBER
                        $response = [
                            'enter_phone_after_social_login' => true,
                        ];
                        return response()->json($response);
                    }
                    return response()->json($response);
                }
            } else {
                $response = false;
                return response()->json($response);
            }
        }

        // if user exists, check user

        if ($request->password != null) {
            if ($user && \Hash::check($request->password, $user->password)) // The passwords match...
            {
                $token = self::getToken($request->email, $request->password);
                $user->auth_token = $token;

                // Add address if address present
                if (isset($request->address['lat'])) {
                    $address = new Address();
                    $address->user_id = $user->id;
                    $address->latitude = $request->address['lat'];
                    $address->longitude = $request->address['lng'];
                    $address->address = $request->address['address'];
                    $address->house = $request->address['house'];
                    $address->tag = $request->address['tag'];
                    $address->save();
                    $user->default_address_id = $address->id;
                }

                $user->save();
                if ($user->default_address_id !== 0) {
                    $default_address = \App\Address::where('id', $user->default_address_id)->get(['address', 'house', 'latitude', 'longitude', 'tag'])->first();
                } else {
                    $default_address = null;
                }

                $running_order = null;

                $response = [
                    'success' => true,
                    'data' => [
                        'id' => $user->id,
                        'auth_token' => $token,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'default_address_id' => $user->default_address_id,
                        'default_address' => $default_address,
                        'delivery_pin' => $user->delivery_pin,
                        'wallet_balance' => $user->balanceFloat,
                        'avatar' => $user->avatar,
                        'tax_number' => $user->tax_number,
                    ],
                    'running_order' => $running_order,
                ];
                return response()->json($response, 201);
            } else {
                $response = ['success' => false, 'data' => 'DONOTMATCH'];
                return response()->json($response, 201);
            }
        }

    }

/**
 * @param Request $request
 */
    public function register(Request $request)
    {

        enSovCheck($request);

        $checkEmail = User::where('email', $request->email)->first();
        $checkPhone = User::where('phone', $request->phone)->first();

        if ($checkPhone || $checkEmail) {
            $response = [
                'email_phone_already_used' => true,
            ];
            return response()->json($response);
        }

        $payload = [
            'password' => \Hash::make($request->password),
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'delivery_pin' => strtoupper(str_random(5)),
            'auth_token' => '',
            'user_ip' => $request->ip(),
        ];

        try {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'phone' => ['required'],
            ]);

            $user = new \App\User($payload);
            if ($user->save()) {

                $token = self::getToken($request->email, $request->password); // generate user token

                if (!is_string($token)) {
                    return response()->json(['success' => false, 'data' => 'Token generation failed'], 201);
                }

                $user = \App\User::where('email', $request->email)->get()->first();

                $user->auth_token = $token; // update user token

                // Add address if address present
                if (isset($request->address['lat'])) {
                    $address = new Address();
                    $address->user_id = $user->id;
                    $address->latitude = $request->address['lat'];
                    $address->longitude = $request->address['lng'];
                    $address->address = $request->address['address'];
                    $address->house = $request->address['house'];
                    $address->tag = $request->address['tag'];
                    $address->save();
                    $user->default_address_id = $address->id;
                }

                $user->save();
                $user->assignRole('Customer');

                if ($user->default_address_id !== 0) {
                    $default_address = \App\Address::where('id', $user->default_address_id)->get(['address', 'house', 'latitude', 'longitude', 'tag'])->first();
                } else {
                    $default_address = null;
                }

                $response = [
                    'success' => true,
                    'data' => [
                        'id' => $user->id,
                        'auth_token' => $token,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'default_address_id' => $user->default_address_id,
                        'default_address' => $default_address,
                        'delivery_pin' => $user->delivery_pin,
                        'wallet_balance' => $user->balanceFloat,
                        'avatar' => $user->avatar,
                        'tax_number' => $user->tax_number,
                    ],
                    'running_order' => null,
                ];
            } else {
                $response = ['success' => false, 'data' => 'Couldnt register user'];
            }
        } catch (\Throwable $e) {
            $response = ['success' => false, 'data' => 'Couldnt register user.'];
            return response()->json($response, 201);
        }

        return response()->json($response, 201);
    }

/**
 * @param Request $request
 */
    public function updateUserInfo(Request $request)
    {
        $user = auth()->user();

        if ($user) {

            if ($user->default_address_id !== 0) {
                $default_address = \App\Address::where('id', $user->default_address_id)->get(['address', 'house', 'latitude', 'longitude', 'tag'])->first();
            } else {
                $default_address = null;
            }

            $running_order = \App\Order::where('user_id', $user->id)
                ->whereIn('orderstatus_id', ['1', '2', '3', '4', '7', '8'])
                ->where('unique_order_id', $request->unique_order_id)
                ->with('restaurant')
                ->first();

            $delivery_details = null;
            if ($running_order) {
                if ($running_order->orderstatus_id == 3 || $running_order->orderstatus_id == 4) {
                    //get assigned delivery guy and get the details to show to customers
                    $delivery_guy = AcceptDelivery::where('order_id', $running_order->id)->first();
                    if ($delivery_guy) {
                        $delivery_user = User::where('id', $delivery_guy->user_id)->first();
                        $delivery_details = $delivery_user->delivery_guy_detail;
                        if (!empty($delivery_details)) {
                            $delivery_details = $delivery_details->toArray();
                            $delivery_details['phone'] = $delivery_user->phone;
                        }

                        $ratings = Rating::where('delivery_id', $delivery_user->id)->select(['rating_delivery', 'review_delivery'])->get();
                        $averageRating = number_format((float) $ratings->avg('rating_delivery'), 1, '.', '');
                        $delivery_details['rating'] = $averageRating;
                    }
                }
            }

            $response = [
                'success' => true,
                'data' => [
                    'id' => $user->id,
                    'auth_token' => $user->auth_token,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'default_address_id' => $user->default_address_id,
                    'default_address' => $default_address,
                    'delivery_pin' => $user->delivery_pin,
                    'wallet_balance' => $user->balanceFloat,
                    'avatar' => $user->avatar,
                    'tax_number' => $user->tax_number,
                ],
                'running_order' => $running_order,
                'delivery_details' => $delivery_details,
            ];

            return response()->json($response);
        }

    }

    /**
     * @param Request $request
     */
    public function checkRunningOrder(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            $running_order = \App\Order::where('user_id', $user->id)
                ->whereIn('orderstatus_id', ['1', '2', '3', '4', '7'])
                ->get();

            if (count($running_order) > 0) {
                $success = true;
                return response()->json($success);
            } else {
                $success = false;
                return response()->json($success);
            }
        }

    }

/**
 * @param $provider
 * @param $accessToken
 */
    public function validateAccessToken($email, $provider, $accessToken)
    {
        if ($provider == 'facebook') {
            // validate facebook access token
            $curl = Curl::to('https://graph.facebook.com/app/?access_token=' . $accessToken)->get();
            $curl = json_decode($curl);

            if (isset($curl->id)) {
                if ($curl->id == config('appSettings.facebookAppId')) {
                    return true;
                }
                return false;
            }
            return false;

        }
        if ($provider == 'google') {
            // validate google access token
            $curl = Curl::to('https://www.googleapis.com/oauth2/v3/tokeninfo?access_token=' . $accessToken)->get();
            $curl = json_decode($curl);

            if (isset($curl->email)) {
                if ($curl->email == $email) {
                    return true;
                }
                return false;
            }
            return false;
        }
    }

    /**
     * @param Request $request
     */
    public function getWalletTransactions(Request $request)
    {
        $user = auth()->user();
        // $user = auth()->user();
        if ($user) {
            // $balance = sprintf('%.2f', $user->balanceFloat);
            $balance = $user->balanceFloat;
            $transactions = $user->transactions()->orderBy('id', 'DESC')->get();

            $response = [
                'success' => true,
                'balance' => $balance,
                'transactions' => $transactions,
            ];
            return response()->json($response);
        } else {
            $response = [
                'success' => false,
            ];
            return response()->json($response);
        }
    }

    /**
     * @param Request $request
     */
    public function changeAvatar(Request $request)
    {
        $user = auth()->user();
        $user->avatar = $request->avatar;
        $user->save();
        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     */
    public function checkBan(Request $request)
    {
        $user = auth()->user();
        if ($user->is_active) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    /**
     * @param $id
     */
    public function toggleFavorite(Request $request)
    {
        $user = auth()->user();
        $restaurant = Restaurant::find($request->id);
        $restaurant->toggleFavorite();
        $restaurant->makeHidden(['delivery_areas']);
        $restaurant->is_favorited = $restaurant->isFavorited();
        $restaurant->avgRating = storeAvgRating($restaurant->ratings);
        return response()->json($restaurant);
    }

    /**
     * @param Request $request
     */
    public function updateTaxNumber(Request $request)
    {
        $user = auth()->user();
        $user->tax_number = $request->tax_number;
        $user->save();

        return response()->json(['success' => true]);
    }
};
