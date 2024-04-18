<?php

/* Restaurant Order Routes */
Route::group(['prefix' => 'store-owner', 'middleware' => 'storeowner'], function () {

    Route::get('/orders', 'RestaurantOwnerController@orders')->name('restaurant.orders');
    Route::post('/orders/get-new-orders', 'RestaurantOwnerController@getNewOrders')->name('restaurant.getNewOrders');

    Route::get('/orders/accept-order/{id}', 'RestaurantOwnerController@acceptOrder')->name('restaurant.acceptOrder');
    Route::get('/orders/mark-order-ready/{id}', 'RestaurantOwnerController@markOrderReady')->name('restaurant.markOrderReady');
    Route::get('/orders/mark-selfpickup-order-completed/{id}', 'RestaurantOwnerController@markSelfPickupOrderAsCompleted')->name('restaurant.markSelfPickupOrderAsCompleted');

    Route::get('/orders/cancel-order/{id}', 'RestaurantOwnerController@cancelOrder')->name('restaurant.cancelOrder');

    Route::get('/stores', 'RestaurantOwnerController@restaurants')->name('restaurant.restaurants');
    Route::get('/store/edit/{id}', 'RestaurantOwnerController@getEditRestaurant')->name('restaurant.get.editRestaurant');
    Route::post('/store/new/save', 'RestaurantOwnerController@saveNewRestaurant')->name('restaurant.saveNewRestaurant');
    Route::get('/store/disable/{id}', 'RestaurantOwnerController@disableRestaurant')->name('restaurant.disableRestaurant');
    Route::post('/store/edit/save', 'RestaurantOwnerController@updateRestaurant')->name('restaurant.updateRestaurant');
    Route::post('/store/new/save', 'RestaurantOwnerController@saveNewRestaurant')->name('restaurant.saveNewRestaurant');

    Route::post('/store/schedule/save', 'RestaurantOwnerController@updateRestaurantScheduleData')->name('restaurant.updateRestaurantScheduleData');

    Route::get('/itemcategories', 'RestaurantOwnerController@itemcategories')->name('restaurant.itemcategories');
    Route::post('/itemcategories/new/save', 'RestaurantOwnerController@createItemCategory')->name('restaurant.createItemCategory');
    Route::get('/itemcategory/disable/{id}', 'RestaurantOwnerController@disableCategory')->name('restaurant.disableCategory');
    Route::post('/itemcategory/edit/save', 'AdminController@updateItemCategory')->name('restaurant.updateItemCategory');

    Route::get('/addoncategories', 'RestaurantOwnerController@addonCategories')->name('restaurant.addonCategories');
    Route::get('/addoncategories/searchAddonCategories', 'RestaurantOwnerController@searchAddonCategories')->name('restaurant.post.searchAddonCategories');
    Route::get('/addoncategory/edit/{id}', 'RestaurantOwnerController@getEditAddonCategory')->name('restaurant.editAddonCategory');
    Route::post('/addoncategory/edit/save', 'RestaurantOwnerController@updateAddonCategory')->name('restaurant.updateAddonCategory');
    Route::get('/addoncategory/new', 'RestaurantOwnerController@newAddonCategory')->name('restaurant.newAddonCategory');
    Route::post('/addoncategory/new/save', 'RestaurantOwnerController@saveNewAddonCategory')->name('restaurant.saveNewAddonCategory');

    Route::get('/addons', 'RestaurantOwnerController@addons')->name('restaurant.addons');
    Route::get('/addons/searchAddons', 'RestaurantOwnerController@searchAddons')->name('restaurant.post.searchAddons');
    Route::get('/addon/edit/{id}', 'RestaurantOwnerController@getEditAddon')->name('restaurant.editAddon');
    Route::post('/addon/edit/save', 'RestaurantOwnerController@updateAddon')->name('restaurant.updateAddon');
    Route::post('/addon/new/save', 'RestaurantOwnerController@saveNewAddon')->name('restaurant.saveNewAddon');
    Route::get('/addon/disable/{id}', 'RestaurantOwnerController@disableAddon')->name('restaurant.disableAddon');
    Route::get('/addon/delete/{id}', 'RestaurantOwnerController@deleteAddon')->name('restaurant.deleteAddon');

    Route::get('/items', 'RestaurantOwnerController@items')->name('restaurant.items');
    Route::get('/stores/searchItems', 'RestaurantOwnerController@searchItems')->name('restaurant.post.searchItems');
    Route::get('/items/edit/{id}', 'RestaurantOwnerController@getEditItem')->name('restaurant.get.editItem');
    Route::get('/item/disable/{id}', 'RestaurantOwnerController@disableItem')->name('restaurant.disableItem');
    Route::post('/item/edit/save', 'RestaurantOwnerController@updateItem')->name('restaurant.updateItem');
    Route::post('/item/new/save', 'RestaurantOwnerController@saveNewItem')->name('restaurant.saveNewItem');
    Route::post('/item/bulk/save', 'BulkUploadController@itemBulkUploadFromRestaurant')->name('restaurant.itemBulkUpload');

    Route::get('/items/sort/{restaurant_id}', 'RestaurantOwnerController@sortMenusAndItems')->name('restaurant.sortMenusAndItems');
    Route::post('/items/sort/save', 'RestaurantOwnerController@updateItemPositionForStore')->name('restaurant.updateItemPositionForStore');
    Route::post('/itemcategories/sort/save', 'RestaurantOwnerController@updateMenuCategoriesPositionForStore')->name('restaurant.updateMenuCategoriesPositionForStore');

    Route::get('/orders', 'RestaurantOwnerController@orders')->name('restaurant.orders');
    Route::get('/orders/searchOrders', 'RestaurantOwnerController@postSearchOrders')->name('restaurant.post.searchOrders');
    Route::get('/order/{order_id}', 'RestaurantOwnerController@viewOrder')->name('restaurant.viewOrder');

    Route::get('/earnings/{restaurant_id?}', 'RestaurantOwnerController@earnings')->name('restaurant.earnings');
    Route::post('/earnings/send-payout-request', 'RestaurantOwnerController@sendPayoutRequest')->name('restaurant.sendPayoutRequest');

    Route::post('/save-store-owner-notification-token', 'NotificationController@saveRestaurantOwnerNotificationToken')->name('saveRestaurantOwnerNotificationToken');

    Route::get('/ratings/{restaurant_id?}', 'RestaurantOwnerController@ratings')->name('restaurant.ratings');

    Route::get('zen-mode/{status}', function ($status) {
        Session::put('zenMode', $status);
        return redirect()->route('restaurant.dashboard');
    })->name('restaurant.zenMode');

    Route::post('/check-order-status-new-order', 'RestaurantOwnerController@checkOrderStatusNewOrder')->name('restaurant.checkOrderStatusNewOrder');
    Route::post('/check-order-status-selfpickup-order', 'RestaurantOwnerController@checkOrderStatusSelfPickupOrder')->name('restaurant.checkOrderStatusSelfPickupOrder');

    Route::post('/update-store-payout-details', 'RestaurantOwnerController@updateStorePayoutDetails')->name('restaurant.updateStorePayoutDetails');

    Route::get('/dashboard', 'RestaurantOwnerController@dashboard')->name('restaurant.dashboard');

});
/* END Restaurant Owner Routes */
