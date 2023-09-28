<x-guest-layout>

    <nav class="bg-white border-gray-200">
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
                <div class="p-8">
                    <div class="uppercase my-2 block mt-2 text-orange-500 h3">Strona główna</div>
                    <div class="my-2 block mt-2 text-slate-500 h3">Wpisz numer maszyny w url np. podnosnikikatowice.pl/123</div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white m-4">
        <div class="w-full mx-auto max-w-screen-xl p-4 flex items-center justify-center">
            <span class="text-sm text-gray-500 sm:text-center">© {{ date('Y') }} <a href="#" class="hover:underline">Karol Wiśniewski</a>. All Rights Reserved.
            </span>
        </div>
    </footer>

</x-guest-layout>