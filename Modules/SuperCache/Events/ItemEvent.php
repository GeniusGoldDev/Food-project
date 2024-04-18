<?php

namespace Modules\SuperCache\Events;

use App\Item;
use Cache;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ItemEvent
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

    public function itemCreated(Item $item)
    {
        $this->clearStoreItemsCache($item->restaurant->id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function itemUpdated(Item $item)
    {
        $this->clearSingleItemCache($item->id);
        $this->clearStoreItemsCache($item->restaurant->id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function itemDeleted(Item $item)
    {
        //
    }

    /**
     * Item's id
     * @param $id
     */
    private function clearSingleItemCache($id)
    {
        Cache::forget('item-single-' . $id);
    }

    /**
     * Item's restaurant Id
     * @param $id
     */
    private function clearStoreItemsCache($id)
    {
        Cache::forget('items-recommended-' . $id);
        Cache::forget('items-all-' . $id);
    }

}
