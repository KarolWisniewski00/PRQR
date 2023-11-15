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
        <input type="hidden" value="{{route('dashboard.search')}}" name="url" id="url">
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
                                                    <div class="flex flex-row justify-between items-center w-100 p-4">
                                                        <div>
                                                            ${element.name} | ${element.model} | ${element.serial}
                                                            <span class="ms-2">${element.udt}</span>
                                                        </div>
                                                        <div class="flex flex-row justify-center items-center">
                                                            <div>
                                                                <a href="{{url('${element.serial}')}}" class="m-4 py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-orange-600 focus:z-10 focus:ring-4 focus:ring-gray-200"><i class="fa-solid fa-eye"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    `;
                                        items = items + item;
                                    } else if (days <= 30) {
                                        // Jeśli mniej niż 30 dni pozostało, przypisz klasę "yellow"
                                        var item = `
                                                    <div class="flex flex-row justify-between items-center w-100 p-4">
                                                        <div>
                                                            ${element.name} | ${element.model} | ${element.serial}
                                                            <span class="text-yellow-500 ms-2"><i class="fa-solid fa-exclamation me-2"></i>${element.udt}</span>
                                                        </div>
                                                        <div class="flex flex-row justify-center items-center">
                                                            <div>
                                                                <a href="{{url('${element.serial}')}}" class="m-4 py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-orange-600 focus:z-10 focus:ring-4 focus:ring-gray-200"><i class="fa-solid fa-eye"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    `;
                                        items = items + item;
                                    } else {
                                        // W przeciwnym razie przypisz klasę "green"
                                        var item = `
                                                    <div class="flex flex-row justify-between items-center w-100 p-4">
                                                        <div>
                                                            ${element.name} | ${element.model} | ${element.serial}
                                                            <span class="text-green-500 ms-2"><i class="fa-solid fa-check me-2"></i>${element.udt}</span>
                                                        </div>
                                                        <div class="flex flex-row justify-center items-center">
                                                            <div>
                                                                <a href="{{url('${element.serial}')}}" class="m-4 py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-orange-600 focus:z-10 focus:ring-4 focus:ring-gray-200"><i class="fa-solid fa-eye"></i></a>
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