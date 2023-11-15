<x-guest-layout>

    <nav class="bg-white border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-center mx-auto p-4">
            <a href="https://podesty-rentals.pl/" class="flex items-center">
                <img src="{{asset('logo.png')}}" class="h-20" alt="Logo" />
            </a>
        </div>
    </nav>
    <hr>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mt-5 px-4 py-2">
        @include('alerts')
        @include('search')

    </div>

    <footer class="bg-white m-4">
        <div class="w-full mx-auto max-w-screen-xl p-4 flex items-center justify-center">
            <span class="text-sm text-gray-500 sm:text-center">© {{ date('Y') }} <a href="#" class="hover:underline">Karol Wiśniewski</a>. All Rights Reserved.
            </span>
        </div>
    </footer>

</x-guest-layout>