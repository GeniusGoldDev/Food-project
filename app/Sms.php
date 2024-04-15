<?php

namespace App;

use App\SmsOtp;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use JWTAuth;
use JWTAuthException;
use Session;
use Twilio\Rest\Client;

class Sms
{

    /**
     * @param $actionType
     * @param $phone
     * @param $otp
     * @param null $message
     * @return mixed
     */
    public function processSmsAction($actionType, $phone, $otp = null, $message = null, $smsForDelivery = null)
    {
        // Selects Default Gateway
        $gateway = config('appSettings.defaultSmsGateway');

        switch ($gateway) {

            case '1':
                try {
                    $response = $this->msg91($actionType, $phone, $otp, $message, $smsForDelivery);
                } catch (Exception $e) {
                    $response = [
                        'success' => false,
                        'type' => 'MSG91',
                    ];
                }

                break;

            case '2':
                try {
                    $response = $this->twilio($actionType, $phone, $otp, $message);
                } catch (Exception $e) {
                    $response = [
                        'success' => false,
                        'type' => 'TWILIO',
                    ];
                }

                break;

        }
        return $response;

    }

    /**
     * @param $actionType
     * @param $phone
     * @param $otp
     * @param $message
     * @return mixed
     */
    private function msg91($actionType, $phone, $otp, $message, $smsForDelivery = null)
    {
        $authkey = config('appSettings.msg91AuthKey');
        $sender_id = config('appSettings.msg91SenderId');

        switch ($actionType) {

            case 'OTP':
                $otp = rand(11111, 99999);
                $message = config('appSettings.otpMessage') . ' ' . $otp;
                $this->saveOtp($phone, $otp);

                $msg_dlt_template_id = config('appSettings.msg91OtpDltTemplateId');
                if ($msg_dlt_template_id == null) {
                    $curlPost = "{ \"sender\": \"$sender_id\", \"route\": \"4\", \"sms\": [ { \"message\": \"$message\", \"to\": [ \"$phone\" ] } ] }";
                } else {
                    $curlPost = "{ \"DLT_TE_ID\": \"$msg_dlt_template_id\", \"sender\": \"$sender_id\", \"route\": \"4\", \"sms\": [ { \"message\": \"$message\", \"to\": [ \"$phone\" ] } ] }";
                }

                break;

            case 'VERIFY':
                $response = $this->verifyOtp($phone, $otp);
                return $response;
                break;

            case 'OD_NOTIFY':

                if ($smsForDelivery) {
                    $msg_dlt_template_id = config('appSettings.msg91NewOrderDeliveryDltTemplateId');
                } else {
                    $msg_dlt_template_id = config('appSettings.msg91NewOrderDltTemplateId');
                }

                if ($msg_dlt_template_id == null) {
                    $curlPost = "{ \"sender\": \"$sender_id\", \"route\": \"4\", \"sms\": [ { \"message\": \"$message\", \"to\": [ \"$phone\" ] } ] }";
                } else {
                    $curlPost = "{ \"DLT_TE_ID\": \"$msg_dlt_template_id\", \"sender\": \"$sender_id\", \"route\": \"4\", \"sms\": [ { \"message\": \"$message\", \"to\": [ \"$phone\" ] } ] }";
                }

                break;

        }

        $phone = preg_replace('/[^0-9]/', '', $phone);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.msg91.com/api/v2/sendsms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $curlPost,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                "authkey: $authkey",
                'content-type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return true;
        }

    }

    /**
     * @param $actionType
     * @param $phone
     * @param $otp
     * @param $message
     * @return mixed
     */
    private function twilio($actionType, $phone, $otp, $message)
    {
        $sid = config('appSettings.twilioSid');
        $token = config('appSettings.twilioAccessToken');
        $from = config('appSettings.twilioFromPhone');

        switch ($actionType) {

            case 'OTP':
                $otp = rand(11111, 99999);
                $message = config('appSettings.otpMessage') . ' ' . $otp;
                $this->saveOtp($phone, $otp);

                break;

            case 'VERIFY':
                $response = $this->verifyOtp($phone, $otp);
                return $response;
                break;

            case 'OD_NOTIFY':
                // Do Nothing Just Send
                break;
        }
        // Send Api Request

        $twilio = new Client($sid, $token);

        try {
            $twilio->messages->create(
                // Where to send a text message (your cell phone?)
                $phone,
                array(
                    'From' => $from,
                    'body' => $message,
                )
            );
            return true;
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            throw new Exception('Twilio Error');
        } catch (\Twilio\Rest\RestException $e) {
            \Log::error($e);
            throw new Exception('Twilio Error');
        } catch (\Twilio\Exceptions\RestException $e) {
            \Log::error($e);
            throw new Exception('Twilio Error');
        }
    }

    /**
     * @param $phone
     * @param $otp
     */
    private function saveOtp($phone, $otp)
    {

        $otpTable = SmsOtp::where('phone', $phone)->first();

        if ($otpTable) {
            //phone exists, just update the otp
            $otpTable->otp = $otp;
            $otpTable->save();
            # code...
        } else {
            //create new entry
            $otpTable = new SmsOtp();
            $otpTable->phone = $phone;
            $otpTable->otp = $otp;
            $otpTable->save();
        }
        // dd($phone);
    }

    /**
     * @param $phone
     * @param $otp
     */
    private function verifyOtp($phone, $otp)
    {
        // dd($otp);
        $otpTable = SmsOtp::where('phone', $phone)->first();

        if ($otpTable) {
            if ($otpTable->otp == $otp) {

                $response = [
                    'valid_otp' => true,
                ];

            } else {
                $response = [
                    'valid_otp' => false,
                ];
            }
        } else {
            $response = [
                'valid_otp' => false,
            ];

        }
        return $response;
    }

}
