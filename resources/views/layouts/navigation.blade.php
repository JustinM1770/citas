<nav x-data="{ open: false, currentPage: '{{ request()->route()->getName() }}' }" class="bg-black border-b border-black">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo con nombre dinámico -->
                <div class="shrink-0 flex items-center min-w-[240px]">
                    <span class="text-white text-xl font-semibold">
                        <span x-show="currentPage.startsWith('dashboard')">Dashboard</span>
                        <span x-show="currentPage.startsWith('citas')">Gestor de Citas</span>
                        <span x-show="currentPage.startsWith('horarios')">Gestor de Horarios</span>
                        <span x-show="currentPage.startsWith('profesionales')">Gestor de Profesionales</span>
                        <span x-show="currentPage.startsWith('servicios')">Gestor de Servicios</span>
                        <span x-show="!['dashboard', 'citas', 'horarios', 'profesionales', 'servicios'].some(p => currentPage.startsWith(p))">Generador de Citas</span>
                    </span>
                </div>
                
                <!-- Page Heading -->
                @isset($header)
                    <div class="hidden sm:block border-l border-gray-700 pl-8">
                        <h2 class="text-base font-medium text-gray-300">
                            {{ $header }}
                        </h2>
                    </div>
                @endisset

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>
                    
                    <x-nav-link :href="route('citas.index')" :active="request()->routeIs('citas.*')">
                        Citas
                    </x-nav-link>

                    @if(auth()->user()->isAdmin() || auth()->user()->isProfesional())
                        <x-nav-link :href="route('horarios.index')" :active="request()->routeIs('horarios.*')">
                            Horarios
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('profesionales.index')" :active="request()->routeIs('profesionales.*')">
                            Profesionales
                        </x-nav-link>
                        
                        <x-nav-link :href="route('servicios.index')" :active="request()->routeIs('servicios.*')">
                            Servicios
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Cerrar Sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-300 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('citas.index')" :active="request()->routeIs('citas.*')">
                Citas
            </x-responsive-nav-link>
            @if(auth()->user()->isAdmin() || auth()->user()->isProfesional())
                <x-responsive-nav-link :href="route('horarios.index')" :active="request()->routeIs('horarios.*')">
                    Horarios
                </x-responsive-nav-link>
            @endif
            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('profesionales.index')" :active="request()->routeIs('profesionales.*')">
                    Profesionales
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('servicios.index')" :active="request()->routeIs('servicios.*')">
                    Servicios
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Perfil
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Cerrar Sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
