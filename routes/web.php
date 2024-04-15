<?php

Route::group([
    'prefix' => config('lunar-hub.system.path', 'dtaa'),
    'middleware' => config('lunar-hub.system.middleware', ['web']),
], function () {
      Route::group([
        'middleware' => [
            Authenticate::class,
        ],
    ], function ($router) {
        Route::group([
            'prefix' => 'storefront',
        ], __DIR__.'/includes/storefront.php');
    });
});