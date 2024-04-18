<?php

/* Setting the locale route */
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('error-logs/{hash}', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

/* Installation Routes */
Route::get('install/start', 'InstallController@start')->name('install.start');
Route::get('install/pre-installation', 'InstallController@preInstallation')->name('install.preInstallation');
Route::get('install/configuration', 'InstallController@getConfiguration')->name('install.configuration');
Route::post('install/configuration', 'InstallController@postConfiguration')->name('install.configurationPost');
Route::get('install/complete', 'InstallController@complete')->name('install.complete');
/* END Installation Routes */

/* Update Routes */
Route::get('install/update', 'UpdateController@updatePage')->name('updatePage');
Route::post('install/update', 'UpdateController@update')->name('updatePost');
/* END Update Routes */

Route::get('/', 'PageController@indexPage')->name('get.index');

Route::get('/schedule/run/{password}', 'SchedulerController@run');
Route::get('/files-backup/run/{password}', 'BackupController@filesBackuprun');
Route::get('/database-backup/run/{password}', 'BackupController@dbBackuprun');

/* Auth Routes */
Route::get('/auth/login', 'PageController@loginPage')->name('get.login');
Route::post('/auth/login', 'Auth\LoginController@login')->name('post.login');
Route::get('auth/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/auth/store-registration', 'PageController@storeRegistration')->name('storeRegistration');
Route::get('/auth/delivery-registration', 'PageController@deliveryRegistration')->name('deliveryRegistration');

Route::get('/auth/forgot-password', 'PageController@forgotPassword')->name('forgotPassword');
Route::post('/auth/forgot-password-send-email', 'PageController@forgotPasswordSendEmail')->name('forgotPasswordSendEmail');

Route::get('/auth/change-password', 'PageController@changePassword')->name('changePassword');
Route::post('/auth/change-password', 'PageController@changePasswordPost')->name('changePasswordPost');

Route::post('auth/register', 'RegisterController@registerRestaurantDelivery')->name('registerRestaurantDelivery');
/* END Auth Routes */
