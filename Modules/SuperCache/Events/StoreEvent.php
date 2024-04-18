<?php

namespace Modules\SuperCache\Events;

use App\Restaurant;
use Cache;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct()
    {

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function storeCreated(Restaurant $restaurant)
    {
        $this->clearStoreCache();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function storeUpdated(Restaurant $restaurant)
    {
        $this->clearStoreInfoCache($restaurant->slug);
        $this->clearStoreCache();

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function storeDeleted(Restaurant $restaurant)
    {
//
    }

    /**
     * @param $id
     */
    private function clearStoreInfoCache($slug)
    {
        Cache::forget('store-info-' . $slug);
    }

    private function clearStoreCache()
    {
        Cache::forget('stores-delivery-active');
        Cache::forget('stores-delivery-inactive');
        Cache::forget('stores-selfpickup-active');
        Cache::forget('stores-selfpickup-inactive');
    }

}
