<?php
Route::group(['middleware' => 'role:Store Owner|permission:login_as_store_owner'], function () {
    Route::impersonate();
});

/* Admin Routes */
Route::group(['prefix' => 'admin'], function () {

    Route::get('/processPayment', 'AdminController@processPayment')->name('admin.processPayment');

    Route::group(['middleware' => 'permission:delivery_guys_view'], function () {
        Route::get('/manage-delivery-guys', 'AdminController@manageDeliveryGuys')->name('admin.manageDeliveryGuys');
        Route::get('/deliveryGuyUsersDatatable', 'Datatables\DeliveryGuyUsersDatatable@deliveryGuyUsersDatatable')->name('admin.deliveryGuyUsersDatatable');
        Route::get('/manage-delivery-guys-stores/{id}', 'AdminController@getManageDeliveryGuysRestaurants')->name('admin.get.manageDeliveryGuysRestaurants');
    });

    Route::group(['middleware' => 'permission:delivery_guys_manage_stores'], function () {
        Route::post('/update-delivery-guys-stores', 'AdminController@updateDeliveryGuysRestaurants')->name('admin.updateDeliveryGuysRestaurants');
    });

    Route::group(['middleware' => 'permission:store_owners_view'], function () {
        Route::get('/manage-store-owners', 'AdminController@manageRestaurantOwners')->name('admin.manageRestaurantOwners');
        Route::get('/storeOwnerUsersDatatable', 'Datatables\StoreOwnerUsersDatatable@storeOwnerUsersDatatable')->name('admin.storeOwnerUsersDatatable');
        Route::get('/manage-store-owners-stores/{id}', 'AdminController@getManageRestaurantOwnersRestaurants')->name('admin.get.getManageRestaurantOwnersRestaurants');
    });

    Route::group(['middleware' => 'permission:store_owners_manage_stores'], function () {
        Route::post('/update-store-owners-stores', 'AdminController@updateManageRestaurantOwnersRestaurants')->name('admin.updateManageRestaurantOwnersRestaurants');
    });

    Route::group(['middleware' => 'permission:all_users_view'], function () {
        Route::get('/users', 'AdminController@users')->name('admin.users');
        Route::get('/usersDatatable', 'Datatables\UsersDatatable@usersDatatable')->name('admin.usersDatatable');
        Route::get('/user/edit/{id}', 'AdminController@getEditUser')->name('admin.get.editUser');
        Route::get('/user/delete/{id}', 'AdminController@deleteUser')->name('admin.deleteUser');
    });

    Route::group(['middleware' => 'permission:all_users_edit'], function () {
        Route::post('/saveNewUser', 'AdminController@saveNewUser')->name('admin.saveNewUser');
        Route::post('/user/edit/save', 'AdminController@updateUser')->name('admin.updateUser');
        Route::get('/user/ban/{id}', 'AdminController@banUser')->name('admin.banUser');

        Route::get('/delivery-ratings/{id}', 'RatingReviewController@viewDeliveryReviews')->name('admin.viewDeliveryReviews');
    });

    Route::group(['middleware' => 'permission:all_users_wallet'], function () {
        Route::post('/user/add-money-to-wallet', 'AdminController@addMoneyToWallet')->name('admin.addMoneyToWallet');
        Route::post('/user/substract-money-from-wallet', 'AdminController@substractMoneyFromWallet')->name('admin.substractMoneyFromWallet');
    });

    Route::group(['middleware' => 'permission:wallet_transactions_view'], function () {
        Route::get('/wallet/transactions', 'AdminController@walletTransactions')->name('admin.walletTransactions');
        Route::get('/wallet/searchWalletTransactions', 'AdminController@searchWalletTransactions')->name('admin.searchWalletTransactions');
    });

    Route::group(['middleware' => 'permission:settings_manage'], function () {
        Route::get('/settings', 'SettingController@settings')->name('admin.settings');
        Route::post('/settings', 'SettingController@saveSettings')->name('admin.saveSettings');
        Route::post('/settings/send-test-mail', 'SettingController@sendTestmail')->name('admin.sendTestmail');
        Route::post('/settings/payment-gateways-toggle', 'PaymentController@togglePaymentGateways')->name('admin.togglePaymentGateways');

        Route::get('/backup/files', 'BackupController@filesBackup')->name('admin.filesBackup');
        Route::get('/backup/database', 'BackupController@dbBackup')->name('admin.dbBackup');

        Route::get('/fix-update-issues', 'AdminController@fixUpdateIssues')->name('admin.fixUpdateIssues');
        Route::post('/force-clear', 'SettingController@forceClear')->name('admin.forceClear');
        Route::post('/clean-everything', 'SettingController@cleanEverything')->name('admin.cleanEverything');
    });

    Route::group(['middleware' => 'permission:order_view'], function () {
        Route::get('/orders', 'AdminController@orders')->name('admin.orders');
        Route::get('/ordersDataTable', 'Datatables\OrdersDatatable@ordersDataTable')->name('admin.ordersDataTable');
        Route::get('/order/{order_id}', 'AdminController@viewOrder')->name('admin.viewOrder');
        Route::get('/printbill/{order_id}', 'AdminController@printThermalBill')->name('admin.printThermalBill');
    });

    Route::group(['middleware' => 'permission:order_actions'], function () {
        Route::post('/order/cancel-order', 'AdminController@cancelOrderFromAdmin')->name('admin.cancelOrderFromAdmin');
        Route::post('/order/accept-order', 'AdminController@acceptOrderFromAdmin')->name('admin.acceptOrderFromAdmin');
        Route::post('/order/assign-delivery', 'AdminController@assignDeliveryFromAdmin')->name('admin.assignDeliveryFromAdmin');
        Route::post('/order/reassign-delivery', 'AdminController@reAssignDeliveryFromAdmin')->name('admin.reAssignDeliveryFromAdmin');
        Route::get('/approve-payment-of-order/{order_id}', 'AdminController@approvePaymentOfOrder')->name('admin.approvePaymentOfOrder');
    });

    Route::group(['middleware' => 'permission:promo_sliders_manage'], function () {
        Route::get('/sliders', 'AdminController@sliders')->name('admin.sliders');
        Route::get('/sliders/disable/{id}', 'AdminController@disableSlider')->name('admin.disableSlider');
        Route::get('/sliders/delete/{id}', 'AdminController@deleteSlider')->name('admin.deleteSlider');
        Route::get('/sliders/{id}', 'AdminController@getEditSlider')->name('admin.get.editSlider');
        Route::post('/slider/create', 'AdminController@createSlider')->name('admin.createSlider');
        Route::post('/slider/save', 'AdminController@saveSlide')->name('admin.saveSlide');
        Route::post('/sliders/edit/save', 'AdminController@updateSlider')->name('admin.updateSlider');

        Route::get('/slider/delete/{id}', 'AdminController@deleteSlide')->name('admin.deleteSlide');
        Route::get('/slider/disable/{id}', 'AdminController@disableSlide')->name('admin.disableSlide');

        Route::get('/slide/edit/{id}', 'AdminController@editSlide')->name('admin.editSlide');
        Route::post('/slide/edit/save', 'AdminController@updateSlide')->name('admin.updateSlide');
        Route::post('/slide/edit/position/save', 'AdminController@updateSlidePosition')->name('admin.updateSlidePosition');
    });

    Route::group(['middleware' => 'permission:stores_view'], function () {
        Route::get('/stores', 'AdminController@restaurants')->name('admin.restaurants');
        Route::get('/stores/searchRestaurants', 'AdminController@searchRestaurants')->name('admin.post.searchRestaurants');
    });

    Route::group(['middleware' => 'permission:stores_sort'], function () {
        Route::get('/stores/sort', 'AdminController@sortStores')->name('admin.sortStores');
        Route::post('/stores/sort/save', 'AdminController@updateStorePosition')->name('admin.updateStorePosition');
    });

    Route::group(['middleware' => 'permission:approve_stores'], function () {
        Route::get('/stores/pending-acceptance', 'AdminController@pendingAcceptance')->name('admin.pendingAcceptance');
        Route::get('/stores/pending-acceptance/accept/{id}', 'AdminController@acceptRestaurant')->name('admin.acceptRestaurant');
    });

    Route::group(['middleware' => 'permission:stores_edit'], function () {
        Route::get('/store/edit/{id}', 'AdminController@getEditRestaurant')->name('admin.get.editRestaurant');
        Route::get('/store/disable/{id}', 'AdminController@disableRestaurant')->name('admin.disableRestaurant');
        Route::get('/store/delete/{id}', 'AdminController@deleteRestaurant')->name('admin.deleteRestaurant');
        Route::post('/store/edit/save', 'AdminController@updateRestaurant')->name('admin.updateRestaurant');
        Route::post('/store/update-slug', 'AdminController@updateSlug')->name('admin.updateSlug');
        Route::post('/update-store-payout-details', 'AdminController@updateStorePayoutDetails')->name('admin.updateStorePayoutDetails');

        Route::get('/store-ratings/{id}', 'RatingReviewController@viewStoreReviews')->name('admin.viewStoreReviews');
        Route::post('/rating/update', 'RatingReviewController@updateStoreReview')->name('admin.updateStoreReview');
    });

    Route::group(['middleware' => 'permission:stores_add'], function () {
        Route::post('/store/new/save', 'AdminController@saveNewRestaurant')->name('admin.saveNewRestaurant');
        Route::post('/store/bulk/save', 'BulkUploadController@restaurantBulkUpload')->name('admin.restaurantBulkUpload');
        Route::post('/store/schedule/save', 'AdminController@updateRestaurantScheduleData')->name('admin.updateRestaurantScheduleData');
    });

    Route::group(['middleware' => 'permission:addon_categories_view'], function () {
        Route::get('/addoncategories', 'AdminController@addonCategories')->name('admin.addonCategories');
        Route::get('/addoncategories/searchAddonCategories', 'AdminController@searchAddonCategories')->name('admin.post.searchAddonCategories');
        Route::get('/addoncategory/edit/{id}', 'AdminController@getEditAddonCategory')->name('admin.editAddonCategory');
        Route::get('/addoncategory/get-addons/{id}', 'AdminController@addonsOfAddonCategory')->name('admin.addonsOfAddonCategory');
    });

    Route::group(['middleware' => 'permission:addon_categories_edit'], function () {
        Route::post('/addoncategory/edit/save', 'AdminController@updateAddonCategory')->name('admin.updateAddonCategory');
    });

    Route::group(['middleware' => 'permission:addon_categories_add'], function () {
        Route::get('/addoncategory/new', 'AdminController@newAddonCategory')->name('admin.newAddonCategory');
        Route::post('/addoncategory/new/save', 'AdminController@saveNewAddonCategory')->name('admin.saveNewAddonCategory');
    });

    Route::group(['middleware' => 'permission:addons_view'], function () {
        Route::get('/addons', 'AdminController@addons')->name('admin.addons');
        Route::get('/addons/searchAddons', 'AdminController@searchAddons')->name('admin.post.searchAddons');
        Route::get('/addon/edit/{id}', 'AdminController@getEditAddon')->name('admin.editAddon');
    });

    Route::group(['middleware' => 'permission:addons_edit'], function () {
        Route::post('/addon/edit/save', 'AdminController@updateAddon')->name('admin.updateAddon');
    });

    Route::group(['middleware' => 'permission:addons_actions'], function () {
        Route::get('/addon/disable/{id}', 'AdminController@disableAddon')->name('admin.disableAddon');
        Route::get('/addon/delete/{id}', 'AdminController@deleteAddon')->name('admin.deleteAddon');
    });

    Route::group(['middleware' => 'permission:addons_add'], function () {
        Route::post('/addon/new/save', 'AdminController@saveNewAddon')->name('admin.saveNewAddon');
    });

    Route::group(['middleware' => 'permission:items_view'], function () {
        Route::get('/items', 'AdminController@items')->name('admin.items');
        Route::get('/items/searchItems', 'AdminController@searchItems')->name('admin.post.searchItems');
        Route::get('/item/edit/{id}', 'AdminController@getEditItem')->name('admin.get.editItem');
        Route::get('/item/delete/{id}', 'AdminController@deleteItem')->name('admin.deleteItem');
        Route::get('/store/{restaurant_id}/items', 'AdminController@getRestaurantItems')->name('admin.getRestaurantItems');

    });

    Route::group(['middleware' => 'permission:items_actions'], function () {
        Route::get('/item/disable/{id}', 'AdminController@disableItem')->name('admin.disableItem');
    });

    Route::group(['middleware' => 'permission:items_edit'], function () {
        Route::post('/item/edit/save', 'AdminController@updateItem')->name('admin.updateItem');

        Route::get('/items/sort/{restaurant_id}', 'AdminController@sortMenusAndItems')->name('admin.sortMenusAndItems');
        Route::post('/items/sort/save', 'AdminController@updateItemPositionForStore')->name('admin.updateItemPositionForStore');
        Route::post('/itemcategories/sort/save', 'AdminController@updateMenuCategoriesPositionForStore')->name('admin.updateMenuCategoriesPositionForStore');
    });

    Route::group(['middleware' => 'permission:items_add'], function () {
        Route::post('/item/new/save', 'AdminController@saveNewItem')->name('admin.saveNewItem');
        Route::post('/item/bulk/save', 'BulkUploadController@itemBulkUpload')->name('admin.itemBulkUpload');
    });

    Route::group(['middleware' => 'permission:menu_categories_view'], function () {
        Route::get('/itemcategories', 'AdminController@itemcategories')->name('admin.itemcategories');
        Route::get('/itemCategoriesDataTable', 'Datatables\ItemCategoriesDatatable@itemCategoriesDataTable')->name('admin.itemCategoriesDataTable');
    });

    Route::group(['middleware' => 'permission:menu_categories_edit'], function () {
        Route::post('/itemcategories/new/save', 'AdminController@createItemCategory')->name('admin.createItemCategory');
    });

    Route::group(['middleware' => 'permission:menu_categories_actions'], function () {
        Route::get('/itemcategory/disable/{id}', 'AdminController@disableCategory')->name('admin.disableCategory');
    });

    Route::group(['middleware' => 'permission:menu_categories_add'], function () {
        Route::post('/itemcategory/edit/save', 'AdminController@updateItemCategory')->name('admin.updateItemCategory');
    });

    Route::group(['middleware' => 'permission:coupons_manage'], function () {
        Route::get('/coupons', 'CouponController@coupons')->name('admin.coupons');
        Route::post('/coupon/new/save', 'CouponController@saveNewCoupon')->name('admin.post.saveNewCoupon');
        Route::get('/coupon/edit/{id}', 'CouponController@getEditCoupon')->name('admin.get.getEditCoupon');
        Route::post('/coupon/edit/save', 'CouponController@updateCoupon')->name('admin.updateCoupon');
        Route::get('/coupon/delete/{id}', 'CouponController@deleteCoupon')->name('admin.deleteCoupon');
    });

    Route::group(['middleware' => 'permission:send_notification_manage'], function () {
        Route::get('/notifications', 'NotificationController@notifications')->name('admin.notifications');
        Route::post('/notifications/upload', 'NotificationController@uploadNotificationImage')->name('admin.uploadNotificationImage');
        Route::post('/notifications/send', 'NotificationController@sendNotifiaction')->name('admin.sendNotifiaction');
        Route::post('/notification-to-users/send', 'NotificationController@sendNotificationToSelectedUsers')->name('admin.sendNotificationToSelectedUsers');
        Route::get('/delete-alerts-junk', 'NotificationController@deleteAlertsJunk')->name('admin.deleteAlertsJunk');
    });

    Route::group(['middleware' => 'permission:popular_location_manage'], function () {
        Route::get('/popular-geo-locations', 'AdminController@popularGeoLocations')->name('admin.popularGeoLocations');
        Route::post('/popular-geo-location/new/save', 'AdminController@saveNewPopularGeoLocation')->name('admin.saveNewPopularGeoLocation');
        Route::get('/popular-geo-location/disable/{id}', 'AdminController@disablePopularGeoLocation')->name('admin.disablePopularGeoLocation');
        Route::get('/popular-geo-location/delete/{id}', 'AdminController@deletePopularGeoLocation')->name('admin.deletePopularGeoLocation');
    });

    Route::group(['middleware' => 'permission:pages_manage'], function () {
        Route::get('/pages', 'AdminController@pages')->name('admin.pages');
        Route::post('/page/new/save', 'AdminController@saveNewpage')->name('admin.saveNewPage');
        Route::get('/page/edit/{id}', 'AdminController@getEditPage')->name('admin.getEditPage');
        Route::post('/page/edit/save', 'AdminController@updatePage')->name('admin.updatePage');
        Route::get('/page/delete/{id}', 'AdminController@deletePage')->name('admin.deletePage');
    });

    Route::group(['middleware' => 'permission:store_payouts_manage'], function () {
        Route::get('/store-payouts', 'AdminController@restaurantpayouts')->name('admin.restaurantpayouts');
        Route::get('/store-payouts/{id}', 'AdminController@viewRestaurantPayout')->name('admin.viewRestaurantPayout');
        Route::post('/store-payouts/save', 'AdminController@updateRestaurantPayout')->name('admin.updateRestaurantPayout');
    });

    Route::group(['middleware' => 'permission:translations_manage'], function () {
        Route::get('/translations', 'AdminController@translations')->name('admin.translations');
        Route::get('/translation/new', 'AdminController@newTranslation')->name('admin.newTranslation');
        Route::post('/translation/new/save', 'AdminController@saveNewTranslation')->name('admin.saveNewTranslation');
        Route::get('/translation/edit/{id}', 'AdminController@editTranslation')->name('admin.editTranslation');
        Route::post('/translation/edit/save', 'AdminController@updateTranslation')->name('admin.updateTranslation');
        Route::get('/translation/disable/{id}', 'AdminController@disableTranslation')->name('admin.disableTranslation');
        Route::get('/translation/delete/{id}', 'AdminController@deleteTranslation')->name('admin.deleteTranslation');
        Route::get('/translation/make-default/{id}', 'AdminController@makeDefaultLanguage')->name('admin.makeDefaultLanguage');
    });

    Route::group(['middleware' => 'permission:delivery_collection_manage'], function () {
        Route::get('/delivery-collections', 'DeliveryCollectionController@deliveryCollections')->name('admin.deliveryCollections');
        Route::post('/delivery-collection/collect/{id}', 'DeliveryCollectionController@collectDeliveryCollection')->name('admin.collectDeliveryCollection');
    });

    Route::group(['middleware' => 'permission:delivery_collection_logs_view'], function () {
        Route::get('/delivery-collection-logs', 'DeliveryCollectionController@deliveryCollectionLogs')->name('admin.deliveryCollectionLogs');
        Route::get('/delivery-collection-logs/{id}', 'DeliveryCollectionController@deliveryCollectionLogsForSingleUser')->name('admin.deliveryCollectionLogsForSingleUser');
    });

    Route::group(['middleware' => 'permission:store_category_sliders_manage'], function () {
        Route::get('/store-category-slider', 'RestaurantCategoryController@restaurantCategorySlider')->name('admin.restaurantCategorySlider');
        Route::get('/store-category-slider/delete/{id}', 'RestaurantCategoryController@deleteRestaurantCategorySlide')->name('admin.deleteRestaurantCategorySlide');
        Route::get('/store-category-slider/disable/{id}', 'RestaurantCategoryController@disableRestaurantCategorySlide')->name('admin.disableRestaurantCategorySlide');
        Route::post('/store-category-slider/new', 'RestaurantCategoryController@newRestaurantCategory')->name('admin.newRestaurantCategory');
        Route::post('/store-category-slider/update', 'RestaurantCategoryController@updateRestaurantCategory')->name('admin.updateRestaurantCategory');
        Route::post('/store-category-slider/save-settings', 'RestaurantCategoryController@saveRestaurantCategorySliderSettings')->name('admin.saveRestaurantCategorySliderSettings');
        Route::post('/create-store-category-slide', 'RestaurantCategoryController@createRestaurantCategorySlide')->name('admin.createRestaurantCategorySlide');
        Route::post('/store-category-slider/edit/position/save', 'RestaurantCategoryController@updateCategorySlidePosition')->name('admin.updateCategorySlidePosition');
    });

    Route::group(['middleware' => 'role:Admin'], function () {
        Route::get('/modules', 'ModuleController@modules')->name('admin.modules');
        Route::post('/module/upload', 'ModuleController@uploadModuleZipFile')->name('admin.uploadModuleZipFile');
        Route::post('/module/install', 'ModuleController@installModule')->name('admin.installModule');
        Route::get('/module/disable/{id}', 'ModuleController@disableModule')->name('admin.disableModule');
        Route::get('/module/enable/{id}', 'ModuleController@enableModule')->name('admin.enableModule');

        Route::get('/update-foodomaa', 'UpdateController@updateFoodomaa')->name('admin.updateFoodomaa');
        Route::get('/update-foodomaa-now', 'UpdateController@updateFoodomaaNow')->name('admin.updateFoodomaaNow');
        Route::post('/update-foodomaa/upload', 'UpdateController@uploadUpdateZipFile')->name('admin.uploadUpdateZipFile');
    });

    Route::group(['middleware' => 'permission:reports_view'], function () {
        Route::get('/reports/top-items', 'ReportController@viewTopItems')->name('admin.viewTopItems');
    });

    Route::group(['middleware' => 'permission:login_as_store_owner'], function () {
        Route::get('/impersonate/{id}', 'AdminController@impersonate')->name('admin.impersonate');
    });

    Route::group(['middleware' => 'role:Admin'], function () {
        Route::get('/roles-and-permission-management', 'RolesAndPermissionController@index')->name('admin.rolesManagement');
        Route::post('/roles-and-permission-management/save', 'RolesAndPermissionController@createNewRoleWithPermissions')->name('admin.createNewRoleWithPermissions');
        Route::get('/roles-and-permission-management/edit/{id}', 'RolesAndPermissionController@editRoleAndPermissions')->name('admin.editRoleAndPermissions');
        Route::post('/roles-and-permission-management/update', 'RolesAndPermissionController@updateRoleAndPermissions')->name('admin.updateRoleAndPermissions');

        Route::get('/server-stats', 'ServerStatsController@getServerStatsPage')->name('admin.getServerStatsPage');
        Route::get('/server-stats-data', 'ServerStatsController@getServerStatsData')->name('admin.getServerStatsData');
    });

    Route::get('/manager', 'AdminController@manager')->name('admin.manager');

    Route::group(['middleware' => 'permission:dashboard_view'], function () {
        Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    });

});
/* END Admin Routes */
