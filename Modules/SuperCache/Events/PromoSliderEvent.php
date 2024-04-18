<?php

namespace Modules\SuperCache\Events;

use App\PromoSlider;
use App\Slide;
use Cache;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PromoSliderEvent
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

    public function promoSliderCreated(PromoSlider $promoSlider)
    {
        $this->clearAllPromoSliders();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function promoSliderUpdated(PromoSlider $promoSlider)
    {
        $this->clearAllPromoSliders();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function promoSliderDeleted(PromoSlider $promoSlider)
    {
        $this->clearAllPromoSliders();
    }

    /**
     * @param Slide $slide
     */
    public function slideCreated(Slide $slide)
    {
        $this->clearAllSlides($slide->promo_slider_id);
    }
    /**
     * @param Slide $slide
     */
    public function slideUpdated(Slide $slide)
    {
        $this->clearAllSlides($slide->promo_slider_id);
    }
    /**
     * @param Slide $slide
     */
    public function slideDeleted(Slide $slide)
    {
        $this->clearAllSlides($slide->promo_slider_id);
    }

    /**
     * @param $id
     */
    private function clearAllPromoSliders()
    {
        Cache::forget('main-slider');
        Cache::forget('other-position-slider');
    }

    /**
     * Slider id
     * @param $id
     */
    private function clearAllSlides($id)
    {
        Cache::forget('main-slider-slides-' . $id);
        Cache::forget('other-position-slides-' . $id);
    }

}
