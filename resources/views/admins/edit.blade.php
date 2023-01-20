<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edytuj konto') }}
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
                                    <div class="pb-8 mb-5">
                                        <div class="text-right text-blue-600"><a href="{{ route('admins.index') }}">Powrót</a></div>
                                        @if ($errors->any())
                                            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                                                Dane są nieprawidłowo wprowadzone...
                                            </div>
                                            <ul
                                                class="'border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py- text-red-700">
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        {{ $error }} 
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <form action="{{ route('admins.update', $user->id) }}"
                                        method="POST" id="edit_user"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method ('PUT')
                                        {{ __('Edycja danych') }}
                                        <br />
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="name"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Nazwa uzytkownika</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <input type="text" name="name" id="name"
                                                    autocomplete="given-name" value="{{ $user->name }}"
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
                                                <textarea id="email" name="email" rows="1"
                                                    class="block w-full max-w-lg rounded-md  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">  {{ $user->email }}
                                                </textarea>
                                                <p class="mt-2 text-sm text-gray-500">Podaj maila</p>
                                            </div>
                                        </div>
                                        <br />

                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-5">
                                            <label for="yt_link"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Hasło</label>
                                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                                <input type="password" name="password" id="password"
                                                    class="block w-full max-w-lg rounded-md focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm"
                                                    value="">
                                            </div>
                                        </div>
                                        <br />
                                        <button type="submit" class="mb-10 inline-flex justify-center rounded-md border border-transparent 
                                        bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                                    </form>

                                    <form action="{{ route('roles.user', $user->id) }}" 
                                        method="POST" id="add_role_to_user">
                                        @csrf
                                        @method ('POST')
                                        {{ __('Dodanie roli') }}
                                        <br />
                                        <div class="sm:col-span-6">
                                            <label for="role" class="block text-sm font-medium text-gray-700">Wybierz role</label> 
                                            <select id="role" name="role" autocomplete="role-name" class="mt-1 block w-full py-2 px-3 border bg-gray-300">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach 
                                            </select>
                                        </div>


                                        <button type="submit" class="mb-10 mt-5 inline-flex justify-center rounded-md border border-transparent 
                                        bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Przypisz role</button>
                                        </div>
                                    </form>



                                    <form action="{{ route('roles.remove', $user->id) }}" 
                                        method="POST" id="remove_role_to_user">
                                        @csrf
                                        @method ('POST')
                                        {{ __('Usunięcie roli') }}
                                        <br />
                                        <div class="sm:col-span-6">
                                            <label for="role" class="block text-sm font-medium text-gray-700">Wybierz role</label> 
                                            <select id="role" name="role" autocomplete="role-name" class="mt-1 block w-full py-2 px-3 border bg-gray-300">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach 
                                            </select>
                                        </div>
                                        <button type="submit" class="mb-10 mt-5 inline-flex justify-center rounded-md border border-transparent 
                                        bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Usuń role</button>
                                        </div>
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
