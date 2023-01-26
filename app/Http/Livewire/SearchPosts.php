<?php

use App\Models\Post;
use Livewire\Component;
use Illuminate\Http\Request;

class SearchUsers extends Component
{
    // public $search ='';


    public function render(Request $request)
    {
        $search = $request->input('search');
        return view('livewire.search-posts', [
            'posts' => Post::where('title', $search)->get(),
        ]);
    }
}
