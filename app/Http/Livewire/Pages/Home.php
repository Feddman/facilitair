<?php

namespace App\Http\Livewire\Pages;

use App\Models\Pin;
use Livewire\Component;

class Home extends Component
{
    public $perPage = 10;
    public $testPerPage = 10;


    public function mount() {

    }

    public function render()
    {
        if(request()->get('c')) {
            $category = \App\Models\Category::where('id', request()->get('c'))->first();
            // dd($category);
            $pins = $category->pins;

        } else if(request()->get('t')) {
            $pins = \App\Models\Pin::withAnyTags(request()->get('t'))->paginate($this->perPage);

        } else if(request()->get('s')) {
            $pins = \App\Models\Pin::where('title', 'like', '%'.request()->get('s').'%')->paginate($this->perPage);
            $pinsFromTag = \App\Models\Pin::withAnyTags(request()->get('s'))->paginate($this->perPage);
            if ($pinsFromTag) {
                $pins[] = $pinsFromTag;
            }


            $pins = collect($pins)->flatten()->unique('id');

        } else {

            $pins = \App\Models\Pin::paginate($this->perPage);
        }

        return view('livewire.pages.home', [
            'pins' => $pins,
        ]);
    }
}
