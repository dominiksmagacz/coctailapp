



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artykuły') }}
        </h2>
    </x-slot>

    <form action="/posts/store" method="GET" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="q"
                placeholder="Search users"> <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </form>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($posts as $post)
                    <div style="border: 1px solid black;">
                        <h1>
                            <x-nav-link href="/posts/{{ $post->id }}/show" :active="request()->routeIs('posts.show')" >
                                {{ $post->title }}
                            </x-nav-link>
                        </h1>
                        <p>
                            {{ $post->content }}
                        </p>
                        </br>
                    </div>
                    @endforeach
                    {{ $posts->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
