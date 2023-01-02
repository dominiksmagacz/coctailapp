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
                                    <div class="mr-5 mt-5 mb-5 float-right">
                                        <a href="{{ route('admins.create') }}"
                                            class="inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-4 py-2 text-base font-medium 
                                text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            Dodaj uzytkownika</a>
                                    </div>
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Nazwa</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                                    E-mail</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Edytuj</span>
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Usuń</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        <x-nav-link href="/admins/{{ $user->id }}/show"
                                                            :active="request()->routeIs('admins.show')"> {{ $user->name }} </x-nav-link>
                                                    </td>
                                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                                                    <td
                                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                        <a href="{{ route('admins.edit', $user->id) }}"
                                                            class="text-indigo-600 hover:text-indigo-900">Edytuj<span
                                                                class="sr-only"></span></a>
                                                    </td>
                                                    <td
                                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                        <form action="{{ route('admins.destroy', $user->id) }}"
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
                                            <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-5 mt-5">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
