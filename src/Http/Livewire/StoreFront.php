<?php

namespace DtaaLunarExtended\Http\Livewire;

use Livewire\Component;

class StoreFront extends Component
{
    public function render()
    {
        return view('dtaa::livewire.store-front')->layout('adminhub::layouts.app', [
            'title' => __('dtaa::storefront.title'),
        ]);
    }
}
