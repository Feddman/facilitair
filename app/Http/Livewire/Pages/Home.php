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
            $pins = $category->pins()->paginate($this->perPage);

        } else if(request()->get('t')) {
            $pins = \App\Models\Pin::withAnyTags(request()->get('t'))->paginate($this->perPage);

        } else if(request()->get('s')) {
            $searchTerm = request()->get('s');
            $pins = Pin::where('title', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('tags', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                })
                ->with('tags')
                ->paginate($this->perPage);



        } else {

            $pins = \App\Models\Pin::paginate($this->perPage);
        }

        return view('livewire.pages.home', [
            'pins' => $pins,
        ]);
    }
}
