<?php


namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;


class CartList extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];
    public $cartItems = [];

    public function removeCart($id)
    {
        \Cart::remove($id);

        session()->flash('success', 'Przedmiot został usunięty !');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'Koszyk został wyczyszczony !');
    }

    public function render()
    {
        $this->cartItems = \Cart::getContent()->toArray();

        return view('livewire.cart-list');
    }
}
