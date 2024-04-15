<?php

Route::group([
    'middleware' => 'can:dtaa:manage-storefront',
], function () {
    Route::get('/', StoreFront::class)->name('dtaa.storefront.index');
});