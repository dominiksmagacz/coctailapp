<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konto uzytkownika') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="text-right text-blue-600"><a href="{{ route('admins.index') }}">Powrót</a></div>

                    <div class="container text-center">
                        
                        <h1>
                            {{ $user->name }}
                        </h1>
                        <p>
                            {{ $user->email }}
                        </p>
                        <p>
                            Konto utworzone:{{ $user->created_at }}
                        </p>
                        <p>
                            Ostatnia modyfikacja: {{ $user->updated_at }}
                        </p>
                    <h2>
                        Role
                    </h2>
                    @foreach ($roles as $role)
                        <p>
                            {{ $role->name }}
                        </p>
                    @endforeach
                    <h2>
                        Permisions
                    </h2>
                    @foreach ($permissions as $permission)
                        <p>
                            {{ $permission }}
                        </p>
                    @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
