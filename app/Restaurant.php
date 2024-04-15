<?php

namespace App;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Event;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Restaurant extends Model implements Sortable
{
    use SortableTrait, Favoriteable;

    /**
     * @var array
     */
    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_active' => 'integer',
        'is_accepted' => 'integer',
        'is_featured' => 'integer',
        'delivery_type' => 'integer',
        'delivery_radius' => 'integer',
        'base_delivery_distance' => 'integer',
        'extra_delivery_distance' => 'integer',
        'distance' => 'float',
        'is_operational' => 'boolean',
        'is_favorited' => 'boolean',
        'is_orderscheduling' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $hidden = array('created_at', 'updated_at');

    public static function boot()
    {
        parent::boot();

        static::created(function ($restaurant) {
            Event::dispatch('store.created', $restaurant);
        });

        static::updated(function ($restaurant) {
            Event::dispatch('store.updated', $restaurant);
        });

        static::deleted(function ($restaurant) {
            Event::dispatch('store.deleted', $restaurant);
        });
    }

    /**
     * @return mixed
     */
    public function items()
    {
        return $this->hasMany('App\Item');
    }

    /**
     * @return mixed
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return mixed
     */
    public function restaurant_categories()
    {
        return $this->belongsToMany('App\RestaurantCategory', 'restaurant_category_restaurant');
    }

    /**
     * @return mixed
     */
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        return $this;
    }

    /**
     * @return mixed
     */
    public function toggleAcceptance()
    {
        $this->is_accepted = !$this->is_accepted;
        return $this;
    }

    /**
     * @return mixed
     */
    public function isActive()
    {
        $this->where('is_active', 1);
        return $this;
    }
    /**
     * @return mixed
     */
    public function isNotActive()
    {
        $this->where('is_active', 0);
        return $this;
    }

    /**
     * @return mixed
     */
    public function delivery_areas()
    {
        if (class_exists("\Modules\DeliveryAreaPro\Entities\DeliveryArea")) {
            return $this->belongsToMany(\Modules\DeliveryAreaPro\Entities\DeliveryArea::class);
        }
        return $this->belongsToMany(User::class);
    }

    /**
     * @return mixed
     */
    public function payment_gateways()
    {
        return $this->belongsToMany(\App\PaymentGateway::class);
    }

    /**
     * @return mixed
     */
    public function payment_gateways_active()
    {
        return $this->belongsToMany(\App\PaymentGateway::class)->where('payment_gateways.is_active', '1');
    }

    /**
     * @return mixed
     */
    public function store_payout_details()
    {
        return $this->hadMany('App\StorePayoutDetail');
    }

    /**
     * @return mixed
     */
    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    /**
     * @return mixed
     */
    public function avgRating()
    {
        // return number_format((float) $this->ratings->avg('rating_store'), 1, '.', '');

        $avg = $this->ratings->avg('rating_store');
        return $avg;
    }
}
