<?php

namespace App\Http\Controllers;

use App\DeliveryGuyDetail;
use App\User;
use Auth;
use Exception;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * @param Request $request
     */
    public function registerRestaurantDelivery(Request $request)
    {
        $validator = $request->validate([
            'captcha' => ['required', 'captcha'],
            'name' => ['required', 'string', 'max:180'],
            'email' => ['required', 'string', 'email', 'max:180', 'unique:users'],
            'phone' => ['required', 'string', 'min:8', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ],
            [
                'captcha.required' => 'Captcha is a required field.',
                'captcha.captcha' => 'Invalid Captcha',

                'name.required' => 'Name is a required field.',
                'name.string' => 'Name is invalid.',
                'name.max' => 'Name must be within 190 characters.',

                'email.required' => 'Email is a required field.',
                'email.string' => 'Email is invalid.',
                'email.email' => 'Email is invalid.',
                'email.max' => 'Email must be within 190 characters.',
                'email.unique' => 'This email address is already registered.',

                'phone.required' => 'Phone is a required field.',
                'phone.string' => 'Phone is invalid.',
                'phone.min' => 'Phone must be atleast 8 characters.',
                'phone.unique' => 'This phone number address is already registered.',

                'password.required' => 'Password is a required field.',
                'password.string' => 'Password is invalid.',
                'password.min' => 'Password must be atleast 6 characters long.',
            ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'delivery_pin' => strtoupper(str_random(5)),
                'password' => \Hash::make($request->password),
            ]);

            if ($request->has('role')) {
                if ($request->role == 'DELIVERY') {
                    $user->assignRole('Delivery Guy');

                    $deliveryGuyDetails = new DeliveryGuyDetail();
                    $deliveryGuyDetails->name = $request->name;

                    $deliveryGuyDetails->save();
                    $user->delivery_guy_detail_id = $deliveryGuyDetails->id;
                    $user->save();

                    //return session message...
                    return redirect()->back()->with(['delivery_register_message' => 'Delivery User Registered', 'success' => 'Delivery User Registered']);
                }
                if ($request->role == 'RESOWN') {
                    $user->assignRole('Store Owner');
                    // login and redirect to dashbaord...
                    Auth::loginUsingId($user->id);
                }
            } else {
                $user->assignRole('Customer');
                return redirect()->back()->with(['success' => 'User Created']);
            }
            return redirect()->back()->with(['success' => 'User Created']);

        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(['message' => 'Something went wrong. Please try again.']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong. Please try again.']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Something went wrong. Please try again.']);
        }
    }
}
