<?php
use Lunar\Hub\Http\Middleware\Authenticate;
Route::group([
    'prefix' => config('lunar-hub.system.path', 'dtaa'),
    'middleware' => config('lunar-hub.system.middleware', ['web']),
], function () {
      Route::group([
        'middleware' => [
            Authenticate::Class,
        ],
    ], function ($router) {
        Route::group([
            'prefix' => 'storefront',
        ], __DIR__.'/includes/storefront.php');
        Route::group([
            'prefix' => 'homeblock',
        ], __DIR__.'/includes/homeblock.php');
    });
});