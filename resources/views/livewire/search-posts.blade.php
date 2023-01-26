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
                                            <input wire:model="search" type="text" placeholder="Search users..."
                                                class="form-control" name="search" />
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-default">
                                                    <span class="glyphicon glyphicon-search">Szukaj</span>
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
