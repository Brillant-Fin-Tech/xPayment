<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);


Route::group(['prefix' => 'client', 'as' => 'client.', 'namespace' => 'Client'], function () {
    Route::get('/', 'PaymentController@index')->name('home');
});


Route::group(['prefix' => 'panel', 'as' => 'panel.', 'namespace' => 'Panel', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Payer
    Route::delete('payers/destroy', 'PayerController@massDestroy')->name('payers.massDestroy');
    Route::resource('payers', 'PayerController');

    // Payment Method
    Route::delete('payment-methods/destroy', 'PaymentMethodController@massDestroy')->name('payment-methods.massDestroy');
    Route::resource('payment-methods', 'PaymentMethodController');

    // Client
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientController');

    // Client Payment Method
    Route::delete('client-payment-methods/destroy', 'ClientPaymentMethodController@massDestroy')->name('client-payment-methods.massDestroy');
    Route::resource('client-payment-methods', 'ClientPaymentMethodController');

    // Client Site
    Route::delete('client-sites/destroy', 'ClientSiteController@massDestroy')->name('client-sites.massDestroy');
    Route::resource('client-sites', 'ClientSiteController');

    // Client Site Token
    Route::delete('client-site-tokens/destroy', 'ClientSiteTokenController@massDestroy')->name('client-site-tokens.massDestroy');
    Route::resource('client-site-tokens', 'ClientSiteTokenController');

    // Transactionx
    Route::delete('transactionxes/destroy', 'TransactionxController@massDestroy')->name('transactionxes.massDestroy');
    Route::resource('transactionxes', 'TransactionxController');

    // Payer Site
    Route::delete('payer-sites/destroy', 'PayerSiteController@massDestroy')->name('payer-sites.massDestroy');
    Route::resource('payer-sites', 'PayerSiteController');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Payer
    Route::delete('payers/destroy', 'PayerController@massDestroy')->name('payers.massDestroy');
    Route::resource('payers', 'PayerController');

    // Payment Method
    Route::delete('payment-methods/destroy', 'PaymentMethodController@massDestroy')->name('payment-methods.massDestroy');
    Route::resource('payment-methods', 'PaymentMethodController');

    // Client
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientController');

    // Client Payment Method
    Route::delete('client-payment-methods/destroy', 'ClientPaymentMethodController@massDestroy')->name('client-payment-methods.massDestroy');
    Route::resource('client-payment-methods', 'ClientPaymentMethodController');

    // Client Site
    Route::delete('client-sites/destroy', 'ClientSiteController@massDestroy')->name('client-sites.massDestroy');
    Route::resource('client-sites', 'ClientSiteController');

    // Client Site Token
    Route::delete('client-site-tokens/destroy', 'ClientSiteTokenController@massDestroy')->name('client-site-tokens.massDestroy');
    Route::resource('client-site-tokens', 'ClientSiteTokenController');

    // Transactionx
    Route::delete('transactionxes/destroy', 'TransactionxController@massDestroy')->name('transactionxes.massDestroy');
    Route::resource('transactionxes', 'TransactionxController');

    // Payer Site
    Route::delete('payer-sites/destroy', 'PayerSiteController@massDestroy')->name('payer-sites.massDestroy');
    Route::resource('payer-sites', 'PayerSiteController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
