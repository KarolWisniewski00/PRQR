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
                            Tworzenie maszyny
                        </h1>
                        <a href="{{route('dashboard')}}" class="mt-8 mb-4 text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none"><i class="fa-solid fa-chevron-left me-2"></i>Powrót</span></a>
                    </div>
                    <form action="{{route('dashboard.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(count($dict_machine['genie']) != 0)
                        <div class="mb-6">
                            <h3 class="mb-5 text-lg font-medium text-gray-900">Genie</h3>
                            <ul class="grid w-full gap-6 md:grid-cols-3">
                                @foreach($dict_machine['genie'] as $genie)
                                <li>
                                    <input {{ in_array($genie, old('genie', [])) ? 'checked' : '' }} name="genie[]" type="radio" id="genie-{{$genie}}" value="{{$genie}}" class="hidden peer">
                                    <label for="genie-{{$genie}}" class="h-full inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">{{$genie}}</div>
                                        </div>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                            @error('genie')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                        @if(count($dict_machine['jlg']) != 0)
                        <div class="mb-6">
                            <h3 class="mb-5 text-lg font-medium text-gray-900">JLG</h3>
                            <ul class="grid w-full gap-6 md:grid-cols-3">
                                @foreach($dict_machine['jlg'] as $jlg)
                                <li>
                                    <input {{ in_array($jlg, old('jlg', [])) ? 'checked' : '' }} name="jlg[]" type="radio" id="jlg-{{$jlg}}" value="{{$jlg}}" class="hidden peer">
                                    <label for="jlg-{{$jlg}}" class="h-full inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">{{$jlg}}</div>
                                        </div>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                            @error('jlg')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                        @if(count($dict_machine['magni']) != 0)
                        <div class="mb-6">
                            <h3 class="mb-5 text-lg font-medium text-gray-900">Magni</h3>
                            <ul class="grid w-full gap-6 md:grid-cols-3">
                                @foreach($dict_machine['magni'] as $magni)
                                <li>
                                    <input {{ in_array($magni, old('magni', [])) ? 'checked' : '' }} name="magni[]" type="radio" id="magni-{{$magni}}" value="{{$magni}}" class="hidden peer">
                                    <label for="magni-{{$magni}}" class="h-full inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">{{$magni}}</div>
                                        </div>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                            @error('magni')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                        @if(count($dict_machine['boss']) != 0)
                        <div class="mb-6">
                            <h3 class="mb-5 text-lg font-medium text-gray-900">Boss</h3>
                            <ul class="grid w-full gap-6 md:grid-cols-3">
                                @foreach($dict_machine['boss'] as $boss)
                                <li>
                                    <input {{ in_array($boss, old('boss', [])) ? 'checked' : '' }} name="boss[]" type="radio" id="boss-{{$boss}}" value="{{$boss}}" class="hidden peer">
                                    <label for="boss-{{$boss}}" class="h-full inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">{{$boss}}</div>
                                        </div>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                            @error('boss')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                        @if(count($dict_machine['nifty']) != 0)
                        <div class="mb-6">
                            <h3 class="mb-5 text-lg font-medium text-gray-900">Nifty</h3>
                            <ul class="grid w-full gap-6 md:grid-cols-3">
                                @foreach($dict_machine['nifty'] as $nifty)
                                <li>
                                    <input {{ in_array($nifty, old('nifty', [])) ? 'checked' : '' }} name="nifty[]" type="radio" id="nifty-{{$nifty}}" value="{{$nifty}}" class="hidden peer">
                                    <label for="nifty-{{$nifty}}" class="h-full inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">{{$nifty}}</div>
                                        </div>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                            @error('nifty')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                        @if(count($dict_machine['zoomlion']) != 0)
                        <div class="mb-6">
                            <h3 class="mb-5 text-lg font-medium text-gray-900">Zoomlion</h3>
                            <ul class="grid w-full gap-6 md:grid-cols-3">
                                @foreach($dict_machine['zoomlion'] as $zoomlion)
                                <li>
                                    <input {{ in_array($zoomlion, old('zoomlion', [])) ? 'checked' : '' }} name="zoomlion[]" type="radio" id="zoomlion-{{$zoomlion}}" value="{{$zoomlion}}" class="hidden peer">
                                    <label for="zoomlion-{{$zoomlion}}" class="h-full inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">{{$zoomlion}}</div>
                                        </div>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                            @error('zoomlion')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                        <div class="mb-6">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Numer seryjny</label>
                            <input value="{{ old('serial') ? old('serial') : ''}}" name="serial" type="text" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Numer seryjny" required>
                            @error('serial')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <h3 class="mb-5 text-lg font-medium text-gray-900">UDT do</h3>
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker type="text" value="{{ old('date') }}" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                            </div>
                            @error('date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <div class="mb-3">
                                <label for="formFile" class="mb-2 inline-block text-neutral-700">UDT</label>
                                <input name="file" class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none" type="file" id="formFile" />
                            </div>
                            @error('file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2"><i class="fa-solid fa-floppy-disk mr-2"></i>Zapisz</button>
                        <a href="{{route('dashboard')}}" class="text-red-500 hover:text-white border border-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-x mr-2"></i>Anuluj</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Dodaj jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Dodaj jQuery UI Datepicker -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        // Wybór daty z użyciem Datepicker
        $("input[datepicker]").datepicker({
            dateFormat: "yy-mm-dd", // Format daty (możesz dostosować)
            changeMonth: true, // Pozwala zmieniać miesiąc
            changeYear: true, // Pozwala zmieniać rok
            yearRange: "-100:+100", // Zakres lat
            // Inne opcje i dostosowania, jeśli są potrzebne
        });
    });
</script>