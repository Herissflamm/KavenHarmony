<header>
    <nav class="bg-white border-gray-200 dark:bg-red-50">
        @if (Route::has('login'))
        <div class="flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ url('/home') }}" class="block py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-100 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a> 
            <div class="hidden w-full md:block md:w-auto">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-red-50 dark:border-gray-700">
            @auth
                <li>
                    <a href="{{ url('/sell') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-100 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">+ Vendre</a>
                </li>
                <li>
                    <a href="{{ url('/buy') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-100 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">+ Acheter</a>
                </li>
                <li>
                    <a href="{{ url('/account') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-100 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">{{ Auth::user()->name }}</a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-100 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Déconnexion</a>
                </li>
            @else
                <li>    
                    <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-100 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Log in</a>
                </li>
                @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-100 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register</a>
                    </li>
                @endif
            @endauth
            </ul>
            </div>
        </div>
        @endif
    </nav>
</header>