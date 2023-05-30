<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coctails') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Na naszej stronie zapytaj AI o dowolną potrawę!") }}
                </div>
            </div>
        </div>
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
                                <div class="overflow-hidden shadow ring-1 mb-5 ring-black ring-opacity-5 md:rounded-lg">
                                    <div class="mt-5 mb-9 ml-5 float-left">
                                        <!-- Search Bar -->
                                        <form action="/gpt3" method="GET" role="chatQuerry">
                                            {{ csrf_field() }}
                                            <div class="input-group mb-4">
                                                <input type="text" class="form-control" name="chatQuerry" id="chatQuerry"
                                                    placeholder="Wpisz zapytanie"> <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-default w-40">
                                                        <span class="glyphicon glyphicon-search"> Zapytaj AI</span>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                   
                                </div>
                                <div class="overflow-hidden shadow ring-1 mb-5 ring-black ring-opacity-5 md:rounded-lg ">
                                    <div class="mt-5 mb-9 ml-5 float-left">
                                       @if ($result == null)
                                       Brak odpowiedzi z ChatGPT
                                       
                                        @else
                                        {{ $result }}
                                        
                                       @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
