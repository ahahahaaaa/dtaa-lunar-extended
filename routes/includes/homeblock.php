<?php

Route::group([
    'middleware' => 'can:dtaa:manage-homeblock',
], function () {
    Route::get('/', \DtaaLunarExtended\Http\Livewire\StoreFront::class)->name('dtaa.homeblock.index');
});