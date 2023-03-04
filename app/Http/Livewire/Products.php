<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{

    public function removeProduct($id)
    {
        Product::destroy($id);

        session()->flash('success', 'Produkt został usunięty !');
    }

    
    public function render()
    {
        return view('livewire.products-panel');
    }
}
