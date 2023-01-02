<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj przepis') }}
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
                                <div class="overflow-hidden ring-black ring-opacity-5 md:rounded-lg">

                                    <form action="{{ route('recipes.store') }}" method="POST" id="create_recipe">
                                        @csrf
                                        {{ __('Nazwa przepisu') }}
                                        <br />
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="title"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Tytuł
                                                przepisu</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <input type="text" name="title" id="title"
                                                    autocomplete="given-name"
                                                    class="block w-full max-w-lg rounded-md 
                                                          focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm"
                                                    value="{{ old('title') }}">
                                            </div>
                                        </div>
                                        <br />
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="description"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Opis</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <textarea id="description" name="description" rows="3"
                                                    class="block w-full max-w-lg rounded-md  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">  {{ old('description') }}
                                                </textarea>
                                                <p class="mt-2 text-sm text-gray-500">Write a few sentences about
                                                    yourself.</p>
                                            </div>
                                        </div>
                                        <br />
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="yt_link"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Link do
                                                YouTube</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <input type="text" name="yt_link" id="yt_link"
                                                    class="block w-full max-w-lg rounded-md 
                                                              focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm"
                                                    value="{{ old('yt_link') }}">
                                            </div>
                                        </div>
                                        <br />
                                        

                                        {{ __('Produkty') }}
                                        <br />
                                        <div class="text-black">
                                            <select
                                                class="js-products form-control block w-full px-3 py-1.5 text-base font-normal text-white bg-transparent bg-clip-padding border-0 border-b-2 border-solid border-teal-300  transition ease-in-out m-0   focus:text-gray-700 active:border-teal-300 focus:ring-teal-300 focus:bg-[#e4dcdc59] focus:border-0  focus:border-teal-300 focus:outline-none"
                                                name="products[]" multiple="multiple">
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br />
                                        
                                        <button type="submit" class="mb-10 inline-flex justify-center rounded-md border border-transparent 
                                        bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
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
