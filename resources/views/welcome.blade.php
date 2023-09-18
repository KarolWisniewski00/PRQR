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
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mt-5">
            <div class="md:flex">
                <div class="md:shrink-0">
                    <img class="h-48 w-full object-cover md:h-full md:w-48" src="{{asset('photo/1932.jpg')}}" alt="Modern building architecture">
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-orange-500 font-semibold">Genie GS-1932</div>
                    <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Wszystko czego potrzebujesz</a>

                    <div class="inline-flex rounded-md shadow-sm mt-2" role="group">
                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-orange-500 dark:focus:text-white">
                            Instrukcja
                        </button>
                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-orange-500 dark:focus:text-white">
                            UDT
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white m-4 dark:bg-gray-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-center">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a href="#" class="hover:underline">Karol Wiśniewski</a>. All Rights Reserved.
            </span>
        </div>
    </footer>

</x-guest-layout>