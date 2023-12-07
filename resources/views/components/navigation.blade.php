  {{-- navbar --}}
<div class="nav-jumbo">
    <nav class="bg-white shadow hidden sm:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{route('welcome')}}">
                            <h2 class="text-2xl font-bold">Facilitair</h2>
                        </a>

                    </div>
                    <div class="sm:-my-px sm:ml-6 sm:flex sm:space-x-8 flex items-center">
                        <a href="{{route('welcome')}}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                            Home
                        </a>
                        @auth
                        <a href="{{route('pin.userpins')}}"  class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            Mijn Pins
                            @auth
                            <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                {{\Auth::user()->pins->count()}}
                            </span>
                            @endauth
                        </a>
                        @endauth
                        <a href="{{route('pin.favorites')}}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            Favoriete Pins
                            @auth
                            <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                {{\Auth::user()->favorites->count()}}
                            </span>
                            @endauth
                        </a>
                        <a href="{{route('pin.create')}}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            + Nieuw
                        </a>
                        @auth
                            @if(\Auth::user()->hasRole('admin'))
                            <a href="{{route('dashboard')}}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <b> Dashboard </b>
                            </a>
                            @endif
                        @endauth
                        {{-- search field --}}

                    </div>
                </div>

                @auth
                   <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                @else
                    <div class="py-2 inline-flex items-center">
                        <a href="{{route('login')}}" class="items-center bg-pink-400 p-2 px-4 font-bold"> login of registreer</a>
                    </div>
                @endauth

        </div>
    </nav>
    <nav class="bg-white shadow sm:hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-4 cursor-pointer" x-data="{showMenu: false}">
                <div class="space-y-2 " x-on:click="showMenu = !showMenu">
                    <div class="w-8 h-0.5 bg-gray-600"></div>
                    <div class="w-8 h-0.5 bg-gray-600"></div>
                    <div class="w-8 h-0.5 bg-gray-600"></div>
                </div>

                <div x-show="showMenu" class="pt-2 mt-2 pb-3 space-y-1">
                    <a href="{{route('welcome')}}" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
                    @auth
                    <a href="{{route('pin.userpins')}}" class="hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                        Mijn Pins <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">{{\Auth::user()->pins->count()}}</span>
                    </a>
                    <a href="{{route('pin.favorites')}}" class="hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                        Favoriete Pins <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">{{\Auth::user()->favorites->count()}}</span>
                    </a>
                    @endauth
                    <a href="{{route('pin.create')}}" class=" hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">+ Nieuw</a>
                    @auth
                    <a class="hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endauth
                    @guest
                    <a href="{{route('login')}}" class="hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Login</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</div>
