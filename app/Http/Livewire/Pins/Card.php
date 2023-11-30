<?php

namespace App\Http\Livewire\Pins;

use Livewire\Component;


class Card extends Component
{
    public $pin;

    public function mount($pin) {
        $this->pin = $pin;
    }

    public function render()
    {
        return view('livewire.pins.card');
    }

    public function toggleLike() {
        if(!auth()->user()) {
            return redirect()->route('login');
        }
        $this->pin->likes()->toggle(auth()->user()->id);
        $this->pin->refresh();
    }

    public function toggleSave() {
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $this->pin->saves()->toggle(auth()->user()->id);
        $this->pin->refresh();
        // Toaster::success('Testing!');
    }
}
