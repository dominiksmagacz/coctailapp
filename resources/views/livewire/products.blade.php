    @extends('layouts.frontend')


    @section('content')
        <div class="container px-6 mx-auto">
            <h3 class="text-2xl font-medium text-gray-700">Lista produktów</h3>
            @if (Auth::user()->hasRole('admin'))
                <div class="text-right">
                    <a href="{{ route('shops.create') }}"
                        class="inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-4 py-2 text-base font-medium 
                    text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Dodaj produkt</a>
                </div>
            @endif
            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($products as $product)
                    <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                        <img src="{{ Storage::url(basename($product->image)) }}" alt="" class="w-full max-h-60">
                        <div class="flex items-end justify-end w-full bg-cover">
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
                            <span class="mt-2 text-gray-500">{{ $product->price }} PLN</span>
                            <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="id">
                                <input type="hidden" value="{{ $product->name }}" name="name">
                                <input type="hidden" value="{{ $product->price }}" name="price">
                                <input type="hidden" value="{{ Storage::url(basename($product->image)) }}" name="image">
                                <input type="hidden" value="1" name="quantity">
                                <button class="px-4 py-2 text-white bg-blue-800 rounded">Dodaj do koszyka</button>
                            </form>
                            @if (Auth::user()->hasRole('admin'))

                            <div class="relative mr-4 mt-4 mb-3 text-right text-sm font-medium sm:pr-6">
                                <a href="{{ route('shops.edit', $product->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Edytuj</a>
                            </div>
                            <div class="relative whitespace-nowrap  text-right text-sm font-medium sm:pr-6">
                                <a href="{{ route('shops.destroy', $product->id ) }}" class="mt-4 px-6 py-1 text-red-800">Usuń</a>
                            </div>

                                {{-- @livewire('products', ['id' => $product->id]) --}}
                                {{-- <livewire:products-panel :item="$product" :key="$product['id']"/> --}}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
