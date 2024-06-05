<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Payer
    Route::apiResource('payers', 'PayerApiController');

    // Payment Method
    Route::apiResource('payment-methods', 'PaymentMethodApiController');

    // Client
    Route::apiResource('clients', 'ClientApiController');

    // Client Payment Method
    Route::apiResource('client-payment-methods', 'ClientPaymentMethodApiController');

    // Client Site
    Route::apiResource('client-sites', 'ClientSiteApiController');

    // Client Site Token
    Route::apiResource('client-site-tokens', 'ClientSiteTokenApiController');

    // Client Site Payment Method
    Route::apiResource('client-site-payment-methods', 'ClientSitePaymentMethodApiController');
});
