<x-guest-layout>

    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-center mx-auto p-4">
            <a href="https://podesty-rentals.pl/" class="flex items-center">
                <img src="{{asset('logo.png')}}" class="h-20" alt="Logo" />
            </a>
        </div>
    </nav>
    <hr>
    <div class="p-2">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mt-4">
            <div class="md:flex">
                <div class="md:shrink-0 flex items-center justify-center">
                    <img class="h-48 w-full object-cover md:h-full md:w-48" src="{{asset($machine->photo_path)}}" alt="{{asset($machine->photo_path)}}" onerror="this.onerror=null; this.src=`{{ asset('empty.svg') }}`; this.classList.remove('object-cover', 'md:h-full', 'md:w-48')">
                </div>
                <div class="p-8">
                    <div class="uppercase my-2 block mt-2 text-orange-500 h3">{{$machine->name}} {{$machine->model}}</div>
                    <div class="my-2 block mt-2 text-slate-500 h3">Numer seryjny: {{$machine->serial}}</div>
                    @php
                    $currentDate = date('Y-m-d');
                    $udtDate = $machine->udt;
                    $diff = (strtotime($udtDate) - strtotime($currentDate)) / (60 * 60 * 24 * 30);
                    $textColorClass = 'text-green-500';
                    if ($diff >= 0 && $diff < 1) { $textColorClass='text-yellow-500' ; }elseif($diff < 0){$textColorClass='text-red-500' ;} @endphp <p class="{{$textColorClass}} block my-2 h3">Ważność UDT do: {{$machine->udt}}</p>
                        <div class="block my-2 font-medium text-black h3">Pobieranie</div>

                        <div class="inline-flex rounded-md shadow-sm mt-2" role="group">
                            @if($machine->instruction_path == '' || $machine->instruction_path == null)
                            <button disabled class="disabled:cursor-not-allowed px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-orange-500 dark:focus:text-white">
                                Instrukcja
                            </button>
                            @else
                            <a href="{{ asset($machine->instruction_path) }}" download class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-orange-500 dark:focus:text-white">
                                Instrukcja
                            </a>
                            @endif
                            @if($machine->udt_path == '' || $machine->udt_path == null)
                            <button disabled class="disabled:cursor-not-allowed px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-orange-500 dark:focus:text-white">
                                UDT
                            </button>
                            @else
                            <a href="{{ asset('storage/'.$machine->udt_path) }}" download class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-orange-500 dark:focus:text-white">
                                UDT
                            </a>
                            @endif
                        </div>

                        <div class="block my-2 font-medium text-black mt-4 h3">Otwórz w nowej karcie</div>

                        <div class="inline-flex rounded-md shadow-sm mt-2" role="group">
                            @if($machine->instruction_path == '' || $machine->instruction_path == null)
                            <button disabled class="disabled:cursor-not-allowed px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-orange-500 dark:focus:text-white">
                                Instrukcja
                            </button>
                            @else
                            <a href="{{ asset($machine->instruction_path) }}" target="_blank" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-orange-500 dark:focus:text-white">
                                Instrukcja
                            </a>
                            @endif
                            @if($machine->udt_path == '' || $machine->udt_path == null)
                            <button disabled class="disabled:cursor-not-allowed px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-orange-500 dark:focus:text-white">
                                UDT
                            </button>
                            @else
                            <a href="{{ asset('storage/'.$machine->udt_path) }}" target="_blank" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-orange-500 dark:focus:text-white">
                                UDT
                            </a>
                            @endif

                        </div>

                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white m-4 dark:bg-gray-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 flex items-center justify-center">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a href="#" class="hover:underline">Karol Wiśniewski</a>. All Rights Reserved.
            </span>
        </div>
    </footer>

</x-guest-layout>