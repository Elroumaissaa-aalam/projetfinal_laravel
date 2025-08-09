<nav x-data="{ open: false }" class="bg-white/90 dark:bg-sky-800 border-b border-gray-100 dark:border-gray-700 shadow-lg sticky top-0 z-50 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-3">
               
                <div class="flex flex-col">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-bold bg-gradient-to-r from-black to-blue-950 bg-clip-text text-transparent">CLINIVIE</a>
                    <div class="text-sm text-gray-600">
                     
                    </div>
                </div>
            </div>
            <div class="hidden md:flex space-x-8">
                @php
                    $dashboardRoute = match(auth()->user()->role) {
                        'admin' => 'admin.dashboard',
                        'doctor' => 'doctor.dashboard', 
                        'nurse' => 'nurse.dashboard',
                        default => 'patient.dashboard'
                    };
                @endphp
                
                <x-nav-link :href="route($dashboardRoute)" :active="request()->routeIs($dashboardRoute)" class="text-black hover:text-blue-600 font-medium transition-colors">
                    {{ __('Dashboard') }}
                </x-nav-link>
            </div>
            <div class="flex items-center space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white/50 dark:bg-gray-800/50 hover:bg-sky-50 dark:hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-sky-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-sky-50">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="hover:bg-red-50 text-red-600"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                <div class="md:hidden">
                    <button @click="open = ! open" class="text-gray-700 hover:text-sky-600 p-2 rounded-lg hover:bg-sky-50 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden pb-4">
            <div class="space-y-2 pt-4 border-t border-gray-200">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-700 hover:text-sky-600 font-medium">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="text-gray-700 hover:text-sky-600 font-medium">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="text-red-600 hover:text-red-800"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

