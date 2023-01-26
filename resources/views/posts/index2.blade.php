<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artykuły') }}
        </h2>
    </x-slot>



    @if (session()->has('message'))
        <div class="mx-auto w-4/5 pb-10">
            <div class="Obg-red-500 text-black font-bold rounded-t px-4 py-2"> Warning
            </div>
            <div class="border border-t-1 [border-red-400 rounded-b bg-red-100 px-4 py-3 Otext-red-700">
                {{ session()->get('message') }}
            </div>
        </div>
    @endif


    <div class="relative bg-gray-50 px-4 pt-16 pb-20 sm:px-6 lg:px-8 lg:pt-24 lg:pb-28">
        <div class="absolute inset-0">
            <div class="h-1/3 bg-white sm:h-2/3"></div>
        </div>
        <div class="relative mx-auto max-w-7xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Aktualnośc prozdrowotne</h2>
                <p class="mx-auto mt-3 max-w-2xl text-xl text-gray-500 sm:mt-4">Zapraszamy Cię do śledzenia wszystkich
                    aktualności związanych z prozdrowotnym trybem zycia.</p>
            </div>


            <div class="lg:grid-rows-none mt-5 mb-5">


                <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                            <div class="flex-shrink-0">
                                <img class="h-48 w-full object-cover"
                                    src="{{ Storage::url(basename($post->image_path))  }}"
                                    alt="">
                            </div>
                            <div class="flex flex-1 flex-col justify-between bg-white p-6">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-indigo-600">
                                        <a href="/posts/{{ $post->id }}/show" class="hover:underline">Artykuł</a>
                                    </p>
                                    <a href="/posts/{{ $post->id }}/show" class="mt-2 block">
                                        <p class="text-xl font-semibold text-gray-900">{{ $post->title }}</p>
                                        <p class="mt-3 text-base text-gray-500">{{ $post->content }}</p>
                                    </a>
                                </div>
                                <div class="mt-6 flex items-center">
                                    <div class="flex-shrink-0">
                                        <a href="#">
                                            <span class="sr-only">{{ $post->author_id }}</span>
                                            <img class="h-10 w-10 rounded-full"
                                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">
                                            <a href="#" class="hover:underline">{{ $post->user->name }}</a>
                                        </p>
                                        <div class="flex space-x-1 text-sm text-gray-500">
                                            <time datetime="2020-03-16">{{ $post->created_at }}</time>
                                            <span aria-hidden="true">&middot;</span>
                                            <span>6 min read</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
    <div class="text-center ">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Pozostałe artykuły</h2>
    </div>

    <livewire:/search-posts /> 

</x-app-layout>
