<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Przepisy') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container text-center">
                            <table class="table" style="border: 1px solid black;">
                                <thead>
                                    <tr>
                                        <th class="w-[200px]" style="border: 1px solid black;">Title</th>
                                        <th class="w-[400px]" style="border: 1px solid black;">Description</th>
                                        <th  class="w-[200px]" style="border: 1px solid black;">Author</th>
                                        <th  class="w-[200px]" style="border: 1px solid black;">products</th>
                                    </tr>
                                </thead>
                                <tbody>
                        @foreach ($recipes as $recipe)

                                    <tr>
                                        <td style="border: 1px solid black;">
                                            <x-nav-link href="/recipes/{{ $recipe->id }}/show" :active="request()->routeIs('recipes.show')" >
                                                {{ $recipe->title }}
                                            </x-nav-link></td>
                                        <td style="border: 1px solid black;">{{ $recipe->description }}</td>
                                        <td style="border: 1px solid black;">{{ $recipe->user->name }}</td>
                                        <td style="border: 1px solid black;">
                                            @foreach ( $recipe->products as $product)
                                                <li>{{ $product->name }}</li>
                                            @endforeach
                                        </td>
                                    </tr>
                        @endforeach
                                    {{ $recipes->links() }}
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
