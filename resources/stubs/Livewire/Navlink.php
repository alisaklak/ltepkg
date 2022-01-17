<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navlink extends Component
{



    public function fixed()
    {
        auth()->user()->sidebar_collapse=!auth()->user()->sidebar_collapse;
        auth()->user()->save();
    }



    public function render()
    {
        return <<<'blade'
            <div class="d-inline-block p-0">
                <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button" wire:click.prevent="fixed"><i class="fas fa-bars"></i></a>
                </li>
            </div>
        blade;
    }
}
