<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('bodegas.index')" :active="request()->routeIs('bodegas.*')" wire:navigate>
                        {{ __('Bodegas') }}
                    </x-nav-link>
                </div>
                <div x-data="{ open: false }" class="relative hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <button @click="open = !open" @click.away="open = false"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">
                        {{ __('Adquisiciones') }}
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute z-50 mt-14 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                        style="display: none;">
                        <div class="py-1">
                            <x-dropdown-link :href="route('orm.index')">
                                {{ __('ORMs') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('oc.index')">
                                {{ __('OCs') }}
                            </x-dropdown-link>
                        </div>
                    </div>
                </div>
                <div x-data="{ open: false }" class="relative hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <button @click="open = !open" @click.away="open = false"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">
                        {{ __('Productos') }}
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute z-50 mt-14 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                        style="display: none;">
                        <div class="py-1">
                            <x-dropdown-link :href="route('products.index')">
                                {{ __('Productos') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('categories.index')">
                                {{ __('Categorias') }}
                            </x-dropdown-link>
                        </div>
                    </div>
                </div>

                <div x-data="{ open: false }" class="relative hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <button @click="open = !open" @click.away="open = false"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">
                        {{ __('RRHH') }}
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute z-50 mt-14 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                        style="display: none;">
                        <div class="py-1">
                            <x-dropdown-link :href="route('users')">
                                {{ __('Usuarios') }}
                            </x-dropdown-link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => ucwords(mb_convert_case(auth()->user()->name, MB_CASE_TITLE, 'UTF-8'))]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('bodegas.index')" :active="request()->routeIs('bodegas.*')" wire:navigate>
                {{ __('Bodegas') }}
            </x-responsive-nav-link>
            
            <!-- Dropdown para Adquisiciones en responsive -->
            <div x-data="{ openAdquisiciones: false }">
                <button @click="openAdquisiciones = !openAdquisiciones" 
                        class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md transition duration-150 ease-in-out">
                    <span>{{ __('Adquisiciones') }}</span>
                    <svg class="ml-2 h-4 w-4 transition-transform duration-200" 
                         :class="{ 'rotate-180': openAdquisiciones }" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div x-show="openAdquisiciones" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-1"
                     class="ml-4 space-y-1 border-l-2 border-gray-600 pl-2">
                    <x-responsive-nav-link :href="route('orm.index')" :active="request()->routeIs('orm.*')" wire:navigate>
                        {{ __('ORMs') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('oc.index')" :active="request()->routeIs('oc.*')" wire:navigate>
                        {{ __('OCs') }}
                    </x-responsive-nav-link>
                </div>
            </div>
            
            <!-- Dropdown para Productos en responsive -->
            <div x-data="{ openProductos: false }">
                <button @click="openProductos = !openProductos" 
                        class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md transition duration-150 ease-in-out">
                    <span>{{ __('Productos') }}</span>
                    <svg class="ml-2 h-4 w-4 transition-transform duration-200" 
                         :class="{ 'rotate-180': openProductos }" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div x-show="openProductos" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-1"
                     class="ml-4 space-y-1 border-l-2 border-gray-600 pl-2">
                    <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" wire:navigate>
                        {{ __('Productos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" wire:navigate>
                        {{ __('Categorias') }}
                    </x-responsive-nav-link>
                </div>
            </div>
            
            <div x-data="{ openRrhh: false }">
                <button @click="openRrhh = !openRrhh" 
                        class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md transition duration-150 ease-in-out">
                    <span>{{ __('RRHH') }}</span>
                    <svg class="ml-2 h-4 w-4 transition-transform duration-200" 
                         :class="{ 'rotate-180': openRrhh }" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div x-show="openRrhh" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-1"
                     class="ml-4 space-y-1 border-l-2 border-gray-600 pl-2">
                    <x-responsive-nav-link :href="route('users')" :active="request()->routeIs('users')" wire:navigate>
                        {{ __('Usuarios') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-white" x-text="name"
                    x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-400">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>