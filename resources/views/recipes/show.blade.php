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
                    <div class="text-right text-blue-600"><a href="{{ route('recipes.index') }}">Powrót</a></div>
                    <div class="container text-left">
                        <h1>
                            {{ $recipe->title }}
                        </h1>
                        <br>
                        <p>
                            {{ $recipe->description }}
                        </p>
                        <br>
                        <p>
                            {{ $recipe->user->name}}
                        </p>
                        <br>
                        <br>
                        <div class="flex-shrink-0">
                            <img class="h-full w-full object-cover"
                                src="{{ Storage::url(basename($recipe->image_path)) }}"
                                alt="">
                        </div>
                        <br>

                        <div class="container text-center mb-4 mt-4">
                            <h1>
                                Oglądnij film jak przygotować posiłek
                            </h1>
                            <iframe width="560" height="315" src="{{ $recipe->yt_link }}"
                            title="YouTube video player" frameborder="0" class="m-auto mt-4"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; 
                            gyroscope; picture-in-picture; web-share" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
