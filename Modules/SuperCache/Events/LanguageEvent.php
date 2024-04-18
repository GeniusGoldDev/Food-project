<?php

namespace Modules\SuperCache\Events;

use App\Translation;
use Cache;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LanguageEvent
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

    public function languageCreated(Translation $translation)
    {
        $this->clearAllLangauges();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function languageUpdated(Translation $translation)
    {
        $this->clearSingleLanguage($translation->id);
        $this->clearAllLangauges();

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function languageDeleted(Translation $translation)
    {
        //
    }

    /**
     * @param $id
     */
    private function clearAllLangauges()
    {
        Cache::forget('app-languages');
    }

    /**
     * @param $id
     */
    private function clearSingleLanguage($id)
    {
        Cache::forget('app-language-' . $id);
    }

}
