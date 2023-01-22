<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artykuły') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-right text-blue-600"><a href="{{ route('posts.index') }}">Powrót</a></div>

                    <div class="container text-center">
                        <h1>
                            {{ $post->title }}
                        </h1>
                        <br>
                        <div class="flex-shrink-0">
                            <img class="h-full w-full object-cover"
                                src="{{ Storage::url(basename($post->image_path)) }}"
                                alt="">
                        </div>
                        <br>
                        <p>
                            {{ $post->content }}
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
