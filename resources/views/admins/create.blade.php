<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utwórz nowe konto') }}
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

                                    <form action="{{ route('admins.store') }}" method="POST" id="create_user">
                                        @csrf
                                        {{ __('Dane uzytkownika') }}
                                        <br />
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="name"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Nazwa Uzytkownika</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <input type="text" name="name" id="name"
                                                    autocomplete="given-name"
                                                    class="block w-full max-w-lg rounded-md 
                                                          focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm"
                                                    value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <br />
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">E-mail</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <textarea id="email" name="email" rows="3"
                                                    class="block w-full max-w-lg rounded-md  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">  {{ old('email') }}
                                                </textarea>
                                                <p class="mt-2 text-sm text-gray-500">Podaj maila</p>
                                            </div>
                                        </div>
                                        <br />
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="password"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Utwórz hasło</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <input type="password" name="password" id="password"
                                                    class="block w-full max-w-lg rounded-md 
                                                              focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm"
                                                    value="{{ old('password') }}">
                                            </div>
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
