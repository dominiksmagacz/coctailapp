<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edytuj produkt') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="text-right text-blue-600"><a href="{{ route('shops.productList') }}">Powrót</a></div>
                                <div class="overflow-hidden ring-black ring-opacity-5 md:rounded-lg">
                                    <div class="pb-8 mb-5">
                                        @if ($errors->any())
                                            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                                                Dane są nieprawidłowo wprowadzone...
                                            </div>
                                            <ul
                                                class="'border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py- text-red-700">
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        {{ $error }} 
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>


                                    <form action="{{ route('shops.store') }}" method="POST" id="create_product"
                                        enctype="multipart/form-data">
                                        @csrf
                                        {{ __('Nowy produkt') }}
                                        <br />
                                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="name"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Nazwa produktu</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <input type="text" name="name" id="name" placeholder="Podaj nazwę"
                                                    autocomplete="given-name"
                                                    class="block w-full max-w-lg rounded-md 
                                                          focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm"
                                                    value="{{ old('title') }}">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="price"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Cena</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <input type="number" step="0.01" name="price" id="price" placeholder="Podaj cene"
                                                    autocomplete="given-price"
                                                    class="block w-full max-w-lg rounded-md 
                                                          focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm"
                                                    value="{{ old('title') }}">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="description"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Opis produktu</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <input type="text" name="description" id="description" placeholder="Podaj opis"
                                                    autocomplete="given-description"
                                                    class="block w-full max-w-lg rounded-md 
                                                          focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm"
                                                    value="{{ old('title') }}">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="col-md-6">
                                            <input type="file" accept="image/*,.pdf,.jpg" name="image_path"
                                                class="form-control">
                                        </div>
                                        <br />
                                        <button type="submit"
                                            class="mb-10 inline-flex justify-center rounded-md border border-transparent 
                                        bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Zapisz</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
