<?php

namespace App\Http\Controllers;

use App\Alert;
use App\PushToken;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Ixudra\Curl\Facades\Curl;

class NotificationController extends Controller
{
    /**
     * @param Request $request
     */
    public function saveToken(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $pushToken = PushToken::where('user_id', $user->id)->first();

            if ($pushToken) {
                //update the existing token
                $pushToken->token = $request->push_token;
                $pushToken->save();
            } else {
                //create new token for user
                $pushToken = new PushToken();
                $pushToken->token = $request->push_token;
                $pushToken->user_id = $user->id;
                $pushToken->save();
            }
            $success = $request->push_token;
            return response()->json($success);
        }
        return response()->json(['success' => false], 401);
    }
    /**
     * @param Request $request
     */
    public function saveRestaurantOwnerNotificationToken(Request $request)
    {
        $user = auth()->user();
        if ($user) {

            $pushToken = PushToken::where('user_id', $user->id)->first();

            if ($pushToken) {
                //update the existing token
                $pushToken->token = $request->push_token;
                $pushToken->save();
            } else {
                //create new token for user
                $pushToken = new PushToken();
                $pushToken->token = $request->push_token;
                $pushToken->user_id = $user->id;
                $pushToken->save();
            }
            $success = $request->push_token;
            return response()->json($success);
        }
        return response()->json(['success' => false], 401);
    }

    public function notifications()
    {
        $subscriberCount = PushToken::count();
        $users = User::all('id', 'name', 'email');

        $countJunkData = Alert::whereDate('created_at', '<', Carbon::now()->subDays(7))->count();

        return view('admin.notifications', array(
            'subscriberCount' => $subscriberCount,
            'users' => $users,
            'countJunkData' => $countJunkData,
        ));
    }

    public function deleteAlertsJunk()
    {
        DB::statement('DELETE FROM alerts WHERE created_at < NOW() - INTERVAL 7 DAY;');

        return redirect()->back()->with(['success' => 'Junk data deleted successfully.']);
    }
    /**
     * @param Request $request
     */
    public function sendNotifiaction(Request $request)
    {
        $secretKey = 'key=' . config('appSettings.firebaseSecret');

        $data = $request->except(['_token']);

        $alertData = $request->except(['_token']);
        $alertData = json_encode($alertData);
        $alertData = json_decode($alertData);
        $alertData = array(
            'title' => $alertData->data->title,
            'message' => $alertData->data->message,
            'badge' => $alertData->data->badge,
            'icon' => $alertData->data->icon,
            'click_action' => $alertData->data->click_action,
            'unique_order_id' => null,
            'custom_notification' => true,
            'custom_image' => $alertData->data->image,
        );

        /* Save to Alerts table */
        $subscribers = User::all();
        foreach ($subscribers as $subscriber) {
            $alert = new Alert();
            $alert->data = json_encode($alertData);
            $alert->user_id = $subscriber->id;
            $alert->is_read = 0;
            $alert->save();
        }
        /*  END Save to Alerts Table */

        $data = json_encode($data);

        $data = substr($data, 0, -1);

        $pushTokens = PushToken::where('is_active', '1')->get(['token'])->pluck('token');

        if (count($pushTokens)) {

            $i = 0;
            $len = count($pushTokens);
            $last = $len - 1;

            $chunks = $pushTokens->chunk(900)->toArray();
            foreach ($chunks as $chunk) {

                $i = 0;
                $len = count($chunk);
                $last = $len - 1;

                $tokens = ', "registration_ids": [';

                foreach ($chunk as $key => $value) {
                    if ($i == $last) {
                        $tokens .= '"' . $value . '"]}';
                    } else {
                        $tokens .= '"' . $value . '",';
                    }
                    $i++;
                }
                $fullData = $data . $tokens;

                Curl::to('https://fcm.googleapis.com/fcm/send')
                    ->withHeader('Content-Type: application/json')
                    ->withHeader("Authorization: $secretKey")
                    ->withData($fullData)
                    ->post();
                // $response = json_decode($response);
            }
        }

        return redirect()->back()->with(['success' => 'Notifications & Alerts Sent']);

    }

    /**
     * @param Request $request
     */
    public function sendNotificationToSelectedUsers(Request $request)
    {
        $secretKey = 'key=' . config('appSettings.firebaseSecret');

        $data = $request->except(['_token']);

        $alertData = $request->except(['_token']);
        $alertData = json_encode($alertData);
        $alertData = json_decode($alertData);
        $alertData = array(
            'title' => $alertData->data->title,
            'message' => $alertData->data->message,
            'badge' => $alertData->data->badge,
            'icon' => $alertData->data->icon,
            'click_action' => $alertData->data->click_action,
            'unique_order_id' => null,
            'custom_notification' => true,
            'custom_image' => $alertData->data->image,
        );

        /* Save to Alerts table */
        $subscribers = User::whereIn('id', $request->users)->get();
        foreach ($subscribers as $subscriber) {
            $alert = new Alert();
            $alert->data = json_encode($alertData);
            $alert->user_id = $subscriber->id;
            $alert->is_read = 0;
            $alert->save();
        }
        /*  END Save to Alerts Table */

        $data = json_encode($data);

        $data = substr($data, 0, -1);

        $pushTokens = PushToken::where('is_active', '1')
            ->whereIn('user_id', $request->users)
            ->get(['token'])
            ->pluck('token')
            ->toArray();
        if (count($pushTokens)) {
            $i = 0;
            $len = count($pushTokens);
            $last = $len - 1;
            $tokens = ', "registration_ids": [';

            foreach ($pushTokens as $key => $value) {
                if ($i == $last) {
                    $tokens .= '"' . $value . '"]}';
                } else {
                    $tokens .= '"' . $value . '",';
                }
                $i++;
            }

            $fullData = $data . $tokens;
            $response = Curl::to('https://fcm.googleapis.com/fcm/send')
                ->withHeader('Content-Type: application/json')
                ->withHeader("Authorization: $secretKey")
                ->withData($fullData)
                ->post();

            $response = json_decode($response);

            // return redirect()->back()->with(['success' => 'Success: ' . $response->success . ' & Failed: ' . $response->failure]);
        }
        return redirect()->back()->with(['success' => 'Notifications & Alerts Sent']);
    }

    /**
     * @param Request $request
     */
    public function uploadNotificationImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = time() . '-' . str_random(10) . '.' . $image->getClientOriginalExtension();
            Image::make($request->file)->resize(1600, 1100)->save(base_path('/assets/img/various/' . $filename));
            return response()->json(['success' => $filename]);
        }
    }

    /**
     * @param Request $request
     */
    public function getUserNotifications(Request $request)
    {

        $user = auth()->user();

        if ($user) {
            $notifications = Alert::where('user_id', $user->id)
                ->orderBy('id', 'DESC')
                ->whereDate('created_at', '>', Carbon::now()->subDays(7))
                ->get()
                ->take(20);
            return response()->json($notifications);
        }

        return response()->json(['success' => false], 401);
    }

    /**
     * @param Request $request
     */
    public function markAllNotificationsRead(Request $request)
    {

        $user = auth()->user();

        if ($user) {
            $notifications = Alert::where('user_id', $user->id)->get();
            foreach ($notifications as $notification) {
                $notification->is_read = true;
                $notification->save();
            }
            $notifications = Alert::where('user_id', $user->id)
                ->orderBy('id', 'DESC')
                ->whereDate('created_at', '>', Carbon::now()->subDays(7))
                ->get()
                ->take(20);
            return response()->json($notifications);
        }
        return response()->json(['success' => false], 401);
    }

    /**
     * @param Request $request
     */
    public function markOneNotificationRead(Request $request)
    {
        $user = auth()->user();
        $notification = Alert::where('id', $request->notification_id)->first();

        if ($user && $notification) {

            $notification->is_read = true;
            $notification->save();

            $notifications = Alert::where('user_id', $user->id)
                ->orderBy('id', 'DESC')
                ->whereDate('created_at', '>', Carbon::now()->subDays(7))
                ->get()
                ->take(20);
            return response()->json($notifications);
        }
        return response()->json(['success' => false], 401);
    }
}
