<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        @include('alerts')
                    </div>
                    <x-application-logo class="block h-12 w-auto" />
                    <div class="flex flex-row justify-between">
                        <h1 class="mt-8 mb-4 text-2xl font-medium text-gray-900">
                            Wszystkie maszyny
                        </h1>
                        <a href="{{route('dashboard.create')}}" class="inline-flex items-center justify-center w-10 h-10 mr-2 text-green-100 transition-colors duration-150 bg-green-500 rounded-full focus:shadow-outline hover:bg-green-600">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>

                    <form class="mb-4">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Szukaj</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" name="serial" id="search-input" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-orange-500 focus:border-orange-500" placeholder="Szukaj po numerze seryjnym" required>
                        </div>
                    </form>
                    <div id="search-results">
                    </div>
                    <script>
                        $(document).ready(function() {
                            var container = `
                            <div class="mb-4">
                                <h2 class="mb-2 text-lg font-semibold text-gray-900">Rezultat:</h2>
                                <div id="list">

                                </div>
                            </div>
                            `;
                            // Nasłuchiwanie na zmiany w polu tekstowym
                            $('#search-input').on("keyup", function() {
                                // Pobierz wartość pola tekstowego
                                var query = $(this).val();
                                var url = $('#url').val();
                                let today = new Date();

                                // Pobierz token CSRF z meta tagu
                                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                                // Wyślij zapytanie Ajax, tylko jeśli długość wprowadzonego tekstu jest większa niż 2 znaki
                                if (query.length >= 2) {
                                    $.ajax({
                                        url: url, // Podaj właściwy URL do obsługi zapytania
                                        method: 'POST', // Lub 'GET', zależnie od Twoich potrzeb
                                        data: {
                                            _token: csrfToken, // Dodaj token CSRF
                                            serial: query
                                        },
                                        success: function(data) {
                                            // Obsłuż otrzymane dane JSON i wyświetl wyniki w divie "search-results"
                                            $('#search-results').html(container);
                                            data = $.parseJSON(data);
                                            var items = '';
                                            data.forEach(element => {
                                                // Pobieramy datę z elementu "element.udt"
                                                let dateUDT = new Date(element.udt);

                                                // Obliczamy różnicę w dniach między datą z elementu a dzisiejszą datą
                                                let days = Math.floor((dateUDT - today) / (1000 * 60 * 60 * 24));
                                                // Przypisujemy odpowiednią klasę CSS w zależności od kryteriów
                                                if (days === NaN || days < 0) {
                                                    // Jeśli data jest przeszła, przypisz klasę "red"
                                                    var item = `
                                                    <div class="flex flex-row justify-between items-center w-100">
                                                        <div>
                                                            ${element.name} ${element.model} ${element.serial}
                                                            <span class="text-red-500 ms-2"><i class="fa-solid fa-xmark me-2"></i>${element.udt}</span>
                                                        </div>
                                                        <div class="flex flex-row justify-center items-center">
                                                            <div>
                                                                <a href="{{url('${element.serial}')}}" class="m-4 py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-orange-600 focus:z-10 focus:ring-4 focus:ring-gray-200"><i class="fa-solid fa-eye"></i></a>
                                                            </div>
                                                            <div>
                                                                <a href="{{url('dashboard/edit/${element.id}')}}" class="m-4 py-2 px-4 text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm focus:outline-none">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <form action="{{url('dashboard/delete/${element.id}')}}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tą maszynę?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="m-4 py-2 px-4 text-red-500 hover:text-white border border-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    `;
                                                    items = items + item;
                                                } else if (days <= 30) {
                                                    // Jeśli mniej niż 30 dni pozostało, przypisz klasę "yellow"
                                                    var item = `
                                                    <div class="flex flex-row justify-between items-center w-100">
                                                        <div>
                                                            ${element.name} ${element.model} ${element.serial}
                                                            <span class="text-yellow-500 ms-2"><i class="fa-solid fa-exclamation me-2"></i>${element.udt}</span>
                                                        </div>
                                                        <div class="flex flex-row justify-center items-center">
                                                            <div>
                                                                <a href="{{url('${element.serial}')}}" class="m-4 py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-orange-600 focus:z-10 focus:ring-4 focus:ring-gray-200"><i class="fa-solid fa-eye"></i></a>
                                                            </div>
                                                            <div>
                                                                <a href="{{url('dashboard/edit/${element.id}')}}" class="m-4 py-2 px-4 text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm focus:outline-none">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <form action="{{url('dashboard/delete/${element.id}')}}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tą maszynę?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="m-4 py-2 px-4 text-red-500 hover:text-white border border-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    `;
                                                    items = items + item;
                                                } else {
                                                    // W przeciwnym razie przypisz klasę "green"
                                                    var item = `
                                                    <div class="flex flex-row justify-between items-center w-100">
                                                        <div>
                                                            ${element.name} ${element.model} ${element.serial}
                                                            <span class="text-green-500 ms-2"><i class="fa-solid fa-check me-2"></i>${element.udt}</span>
                                                        </div>
                                                        <div class="flex flex-row justify-center items-center">
                                                            <div>
                                                                <a href="{{url('${element.serial}')}}" class="m-4 py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-orange-600 focus:z-10 focus:ring-4 focus:ring-gray-200"><i class="fa-solid fa-eye"></i></a>
                                                            </div>
                                                            <div>
                                                                <a href="{{url('dashboard/edit/${element.id}')}}" class="m-4 py-2 px-4 text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm focus:outline-none">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <form action="{{url('dashboard/delete/${element.id}')}}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tą maszynę?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="m-4 py-2 px-4 text-red-500 hover:text-white border border-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    `;
                                                    items = items + item;
                                                }
                                            });
                                            $('#list').html(items);
                                        }
                                    });
                                } else {
                                    // Jeśli długość tekstu jest mniejsza niż 2 znaki, wyczyść wyniki
                                    $('#search-results').html('');
                                }
                            });
                        });
                    </script>

                    <input type="hidden" value="{{route('dashboard.search')}}" name="url" id="url">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nazwa
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Model
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Numer seryjny
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        UDT
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Podgląd
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Edycja
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Usuwanie
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($machines as $key => $machine)
                                <tr>
                                    <td class="px-6 py-4">
                                        {{$key+1}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$machine->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$machine->model}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$machine->serial}}
                                    </td>
                                    @php
                                    $currentDate = date('Y-m-d');
                                    $udtDate = $machine->udt;
                                    $diff = (strtotime($udtDate) - strtotime($currentDate)) / (60 * 60 * 24 * 30);
                                    $textColorClass = 'text-green-500';
                                    if ($diff >= 0 && $diff < 1) { $textColorClass='text-yellow-500' ; }elseif($diff < 0){$textColorClass='text-red-500' ;} @endphp <td class="px-6 py-4 {{$textColorClass}}">
                                        {{$machine->udt}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{route('index', $machine->serial)}}" class="m-4 py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-orange-600 focus:z-10 focus:ring-4 focus:ring-gray-200"><i class="fa-solid fa-eye"></i></a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{route('dashboard.edit', $machine->id)}}" class="m-4 py-2 px-4 text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm focus:outline-none">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{route('dashboard.delete', $machine->id)}}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tą maszynę?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="m-4 py-2 px-4 text-red-500 hover:text-white border border-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-4 py-2">
                            {{ $machines->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>