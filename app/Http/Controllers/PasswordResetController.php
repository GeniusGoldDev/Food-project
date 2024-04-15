<?php

namespace App\Http\Controllers;

use App\PasswordResetOtp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    /**
     * @param Request $request
     */

    //for customer application
    public function sendPasswordResetMail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        

        if ($user) {

            $pool = '23456789ABCDEFGHJKMNPQRSTUVWXYZ';
            $length = 6;
            $code = strtoupper(substr(str_shuffle(str_repeat($pool, 5)), 0, $length));

            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'code' => $code,
            ];
         

            try {
		 
                //send the mail to the requested user's email
                
            
              Mail::send('emails.passwordReset',  ['mailData' => $data], function ($message) use ($data) {
                    $message->subject(config('appSettings.passwordResetEmailSubject'));
                    $message->from(config('appSettings.sendEmailFromEmailAddress'), config('appSettings.sendEmailFromEmailName'));
                    $message->to($data['email']);
                });
     

                 
                
                // check if password reset otp already exists
                $checkIfOtpExists = PasswordResetOtp::where('user_id', $user->id)->first();
                if ($checkIfOtpExists) {
                    //if exists then update the code
                    $checkIfOtpExists->code = $code;
                    $checkIfOtpExists->save();
                } else {
                    //else create new code and save in DB
                    $passwordResetOtp = new PasswordResetOtp();
                    $passwordResetOtp->user_id = $user->id;
                    $passwordResetOtp->code = $code;
                    $passwordResetOtp->save();
                }

                $response = [
                    'success' => true,
                    'message' => 'Password reset mail sent',
                ];
                return response()->json($response);
            } catch (Exception $e) {
                $response = [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'error_code' => 'SWR', //Something Went Wrong
                ];
                return response()->json($response);
            }

        }

        $response = [
            'success' => false,
            'message' => 'User not found',
            'error_code' => 'UNF', //User Not Found
        ];
        return response()->json($response);

    }

    /**
     * @param $value
     */
    //for customer application
    public function verifyPasswordResetOtp(Request $request)
    {
        //get the user from email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            //get the corresponding OTP
            $passwordResetOtp = PasswordResetOtp::where('user_id', $user->id)->first();

            // if otp present
            if ($passwordResetOtp) {
                //if otp matches
                if (strtoupper($request->code) == $passwordResetOtp->code) {
                    $response = [
                        'success' => true,
                        'message' => 'OTP Valid',
                    ];
                    return response()->json($response);
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Invalid OTP',
                        'error_code' => 'IVOTP', //Invalid OTP
                    ];
                    return response()->json($response);
                }

            } else {
                $response = [
                    'success' => false,
                    'message' => 'OTP not requested',
                    'error_code' => 'SWR', //Something Went Wrong
                ];
                return response()->json($response);
            }
        }
        $response = [
            'success' => false,
            'message' => 'User not found',
            'error_code' => 'UNF', //User Not Found
        ];
        return response()->json($response);

    }

    /**
     * @param Request $request
     */
    //for customer application
    public function changeUserPassword(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $passwordResetOtp = PasswordResetOtp::where('user_id', $user->id)->first();

            if ($passwordResetOtp) {
                if (strtoupper($request->code) == $passwordResetOtp->code) {
                    //change password here
                    if ($request->has('password') && $request->password != null) {
                        $user->password = \Hash::make($request->password);
                        $user->save();
                        $response = [
                            'success' => true,
                            'message' => 'Password changed',
                        ];
                        return response()->json($response);
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Something went wrong',
                            'error_code' => 'SWR', //Something Went Wrong
                        ];
                        return response()->json($response);
                    }

                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Invalid OTP',
                        'error_code' => 'IVOTP', //Invalid OTP
                    ];
                    return response()->json($response);
                }

            } else {
                $response = [
                    'success' => false,
                    'message' => 'OTP not requested',
                    'error_code' => 'SMR', //Something Went Wrong
                ];
                return response()->json($response);
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'User not found',
                'error_code' => 'UNF', //User Not Found
            ];
            return response()->json($response);
        }

    }

}
