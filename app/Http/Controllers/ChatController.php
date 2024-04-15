<?php

namespace App\Http\Controllers;

use App\AcceptDelivery;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Nahid\Talk\Facades\Talk;

class ChatController extends Controller
{
    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        // $user = User::where('id', $request->user_id)->first();

        Talk::setAuthUserId($request->user_id);
    }

    /**
     * @param Request $request
     */
    public function deliveryCustomerChat(Request $request)
    {

        //the the user who is requesting the conversation...
        $user = User::where('id', $request->user_id)->first();
        // Talk::setAuthUserId($user);
        $order = Order::where('id', $request->order_id)
            ->whereIn('orderstatus_id', ['1', '2', '3', '4', '7'])
            ->where('user_id', $request->user_id)
            ->first();

        if ($order) {

            if ($user->hasRole('Customer')) {
                //find the assigned delivery guy by the Order ID
                $acceptDelivery = AcceptDelivery::where('order_id', $request->order_id)->first();
                if ($acceptDelivery) {
                    $delivery_guy = User::where('id', $acceptDelivery->user_id)->first();
                }
                //if customer, add the delivery guy id in user 2
                $message = Talk::sendMessageByUserId($delivery_guy->user_id, $request->message);

                if ($message) {
                    return response()->json(['success' => true, 'data' => $message], 200);
                }

            }
            if ($user->hasRole('Delivery Guy')) {

                //if delivery guy, add the customer id in user 2
                $acceptDelivery = AcceptDelivery::where('order_id', $request->order_id)->first();
                if ($acceptDelivery) {
                    $customer = User::where('id', $acceptDelivery->customer_id)->first();
                }
                //if customer, add the delivery guy id in user 2
                $message = Talk::sendMessageByUserId($customer->customer_id, $request->message);

                if ($message) {
                    return response()->json(['success' => true, 'data' => $message], 200);
                }

            }

        }
        return response()->json(['success' => false], 200);

    }
}
