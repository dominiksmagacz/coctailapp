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
                    @foreach ($posts2 as $post)
                        <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                            <div class="flex-shrink-0">
                                <img class="h-48 w-full object-cover"
                                    src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80"
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
                                            <span class="sr-only">Roel Aufderehar</span>
                                            <img class="h-10 w-10 rounded-full"
                                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">
                                            <a href="#" class="hover:underline">Roel Aufderehar</a>
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
                                        <form action="/posts/search" method="GET" role="search">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="searchInput"
                                                    placeholder="Szukaj artykułu"> <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-default">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mr-5 mt-5 mb-5 float-right">
                                        <a href="{{ route('posts.create') }}"
                                            class="inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-4 py-2 text-base font-medium 
                                text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            Dodaj artykuł</a>
                                    </div>
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Data powstania</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                                    Tytuł</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                                    Treść</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Edytuj</span>
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Usuń</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                        {{ $post->created_at }}</td>
                                                    @if (Auth::user()->hasRole('reader'))
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                            <x-nav-link href="/posts/{{ $post->id }}/show"
                                                                :active="request()->routeIs('posts.show')"> {{ $post->title }} </x-nav-link>
                                                        </td>
                                                    @else
                                                        <td class="px-3 py-4 text-sm text-gray-500">{{ $post->title }}
                                                    @endif
                                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $post->content }}
                                                    </td>
                                                    @if (Auth::user()->hasRole('moderator'))
                                                        <td
                                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                                class="text-indigo-600 hover:text-indigo-900">Edytuj<span
                                                                    class="sr-only"></span></a>
                                                        </td>
                                                        <td
                                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                            <form action="{{ route('posts.destroy', $post->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method ('DELETE')
                                                                <button class="text-red-500 pr-3" type="submit">
                                                                    Usuń
                                                                </button>
                                                            </form>
                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                            <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-5 mt-5">
                                    {{ $posts->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
