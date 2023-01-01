<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Przepisy') }}
        </h2>
    </x-slot>


    @if (session()->has('message'))
        <div class="mx-auto w-3/5 pb-10">
            <div class="Obg-red-500 text-black font-bold rounded-t px-4 py-2"> Warning
            </div>
            <div class="border border-t-1 [border-red-400 rounded-b bg-red-100 px-4 py-3 Otext-red-700">
                {{ session()->get('message') }}
            </div>
        </div>
    @endif
    <!-- Table with recipes -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <div class="mt-5 ml-5 float-left">
                                        <!-- Search Bar -->
                                        <form action="/recipes/search" method="GET" role="search">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="searchInput"
                                                    placeholder="Szukaj przepisu"> <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-default">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mr-5 mb-5 mt-5 float-right">
                                        <a href="{{ route('recipes.create') }}"
                                            class="inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-4 py-2 text-base font-medium 
                                    text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            Dodaj przepis</a>
                                    </div>
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Tytuł</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                                    Opis</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Autor</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Produkty</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Edytuj</span>
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Usuń</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @foreach ($recipes as $recipe)
                                                <tr>
                                                    <td class="px-3 py-4 text-sm text-gray-500">
                                                        <x-nav-link href="/recipes/{{ $recipe->id }}/show"
                                                            :active="request()->routeIs('recipes.show')"> {{ $recipe->title }} </x-nav-link>
                                                    </td>
                                                    <td class="px-3 py-4 text-sm text-gray-500">
                                                        {{ $recipe->description }}</td>
                                                    <td
                                                        class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                        {{ $recipe->user->name }}</td>
                                                    <td class="px-3 py-4 text-sm text-gray-500">
                                                        @foreach ($recipe->products as $product)
                                                            <li>{{ $product->name }}</li>
                                                        @endforeach
                                                    </td>
                                                    <td
                                                        class="relative py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                        <a href="{{ route('recipes.edit', $recipe->id) }}"
                                                            class="text-indigo-600 hover:text-indigo-900">Edytuj<span
                                                                class="sr-only"></span></a>
                                                    </td>
                                                    <td
                                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                        <form action="{{ route('recipes.destroy', $recipe->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method ('DELETE')
                                                            <button class="text-red-500 pr-3" type="submit">
                                                                Usuń
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-5 mt-5">
                                    {{ $recipes->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
