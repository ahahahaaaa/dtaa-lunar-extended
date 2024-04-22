<?php

namespace DtaaLunarExtended\Http\Livewire;

use Livewire\Component;

class HomeBlock extends Component
{
    public function render()
    {
        return view('dtaa::livewire.home-block')->layout('adminhub::layouts.app', [
            'title' => __('dtaa::homeblock.title'),
        ]);
    }
}
