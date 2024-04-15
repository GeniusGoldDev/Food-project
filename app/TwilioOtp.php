<?php

namespace App;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class TwilioOtp
{
    /**
     * @param $phone
     */
    public function sendOtp($phone)
    {
        $sid = config('appSettings.twilioSid');
        $token = config('appSettings.twilioAccessToken');
        $verification_service = config('appSettings.twilioServiceId');

        $twilio = new Client($sid, $token);

        // phone number should be in E.164 format
        // twilio.com/docs/glossary/what-e164
        try {
            $verification = $twilio->verify->v2->services($verification_service)
                ->verifications
                ->create($request->phone, 'sms'); //sms verification
            return true;
        } catch (Exception $e) {
            return false;
        }
        return false;
    }

    /**
     * @param $otp
     * @param $phone
     */
    public function verifyOtp($otp, $phone)
    {
        $sid = config('appSettings.twilioSid');
        $token = config('appSettings.twilioAccessToken');
        $verification_service = config('appSettings.twilioServiceId');

        $twilio = new Client($sid, $token);

        try {
            $verification_check = $twilio->verify->v2->services($verification_service)
                ->verificationChecks
                ->create($request->otp, // code
                    array('to' => $request->phone) //phone number to verify
                );

            if ($verification_check->status === 'pending') {
                $success = true;
                return response()->json($success);
            } else {
                $success = false;
                return response()->json($success);
            }
        } catch (Exception $e) {
            $success = false;
            return response()->json($success);
        }
        $success = false;
        return response()->json($success);
    }
}
