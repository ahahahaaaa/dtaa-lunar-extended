<?php

Route::group([
    'middleware' => 'can:dtaa:manage-storefront',
], function () {
    Route::get('/', \DtaaLunarExtended\Http\Livewire\StoreFront::class)->name('dtaa.storefront.index');
});