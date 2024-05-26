<header>
    <nav class="bg-black-50 border-gray-200">
        @if (Route::has('login'))
        <div class="md:flex md:flex-wrap md:items-center md:justify-between md:mx-auto md:p-4">
            <div class="md:flex md:justify-between md:items-center">
                <a href="{{ url('/home') }}"> <img src="/logo/logoytpeblanc.png" class="w-24 m-auto md:m-0" alt="KavenHarmony Logo"/></a>
                <div class="pl-1 md:pl-0 md:ml-56">
                    <form method="get" action="{{ url('/search') }}">   
                        <label for="default-search" class="md:mb-2 md:text-sm md:font-medium text-gray-900 sr-only">Rechercher</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="default-search" name="searchValue" class="block w-full p-1 ps-10 text-sm text-gray-900 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500" placeholder="Rechercher">
                        </div>
                    </form>
                </div>
            </div>
            <ul class="pl-1 md:pl-0 font-medium flex flex-row border border-gray-100 rounded-lg md:space-x-8 space-x-2 border-0 md:pb-0 pb-2 md:pt-0 pt-2">
            @auth
                @if(Auth::user()->seller != null)
                    <li>
                        <a href="{{ url('/sell') }}" class="bg-white text-sm block font-medium py-1 md:px-3 px-2 pr-2 text-gray-900 rounded-xl md:pr-16">+Annonces</a>
                    </li>
                @endif
                
                <li>
                    <a href="{{ url('/partition') }}" class="bg-white text-sm flex items-center font-medium py-1 px-2 pr-2 md:px-3 text-gray-900 rounded-xl md:pr-16">
                        <svg class="w-[22px] h-[20px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11 4.7C8.7 4.1 6.8 4 4 4a2 2 0 0 0-2 2v11c0 1.1 1 2 2 2 2.8 0 4.5.2 7 .8v-15Zm2 15.1c2.5-.6 4.2-.8 7-.8a2 2 0 0 0 2-2V6c0-1-.9-2-2-2-2.8 0-4.7.1-7 .7v15.1Z" clip-rule="evenodd"/>
                        </svg>
                        <p class="pl-2">Cours</p>
                    </a>
                </li>
                    @if(Auth::user() != null)
                        @if(Auth::user()->customer != null)
                            <li>
                                <div class="rounded-full  bg-white flex justify-center items-center p-1">
                                    <a href="{{ url('/myBasket') }}">
                                        <div class="relative text-purple-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="file: h-6 w-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        @endif
                    @endif
                    <div class="rounded-full w-8 h-8 flex justify-center items-center">
                        <a href="{{ url('/account') }}" >
                            @if (Auth::user()->image != null)
                                <div class="relative w-8 h-8 overflow-hidden bg-white rounded-full">
                                    <img src="/images/{{Auth::user()->image->path}}" class="w-full h-full rounded" alt="Photo de profil">
                                </div>
                            @else
                                <div class="relative w-8 h-8 overflow-hidden bg-white rounded-full">
                                    <svg class="w-8 h-8 text-yellow-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif
                        </a>
                    </div>
                </li>              
                <li>
                    <a href="{{ url('/logout') }}" class="rounded-full flex justify-center items-center text-white">
                        <svg class="h-8 w-8 text-white"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                    </a>
                </li>
            @else
                <li class="m-auto flex items-center">    
                    <a href="{{ route('login') }}" class="rounded-full flex justify-center items-center text-white">Se connecter</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="pl-5 rounded-full flex justify-center items-center text-white">S'inscrire</a>
                    @endif
                </li>                
            @endauth
            </ul>
        </div>
        @endif
    </nav>
</header>