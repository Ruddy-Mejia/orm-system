<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    // Variable para controlar si se muestran las credenciales de demo
    public $showDemo = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Auto-fill with demo credentials
     */
    public function fillDemoCredentials(): void
    {
        $this->form->email = 'rmejiam.dev@gmail.com';
        $this->form->password = '12345678';
        $this->showDemo = true;
    }
}; ?>

<div>
    <!-- ... (mismo código PHP) ... -->

<div>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                wire:model="form.email" 
                id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
                required 
                autofocus 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input 
                wire:model="form.password" 
                id="password" 
                class="block mt-1 w-full"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input 
                    wire:model="form.remember" 
                    id="remember" 
                    type="checkbox" 
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Botón de rellenar y Login juntos -->
        <div class="flex flex-col sm:flex-row gap-3 mt-4">
            

            <x-secondary-button class="flex-1 justify-center" wire:click="fillDemoCredentials">
                {{ __('Rellenar') }}
            </x-secondary-button>

            <x-primary-button class="flex-1 justify-center">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>

        <!-- Indicador de credenciales cargadas -->
        @if($showDemo)
            <div class="mt-3 text-xs text-emerald-600 bg-emerald-50 border border-emerald-200 rounded-lg p-2.5 flex items-center gap-2 animate-fadeIn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="break-all">
                    <strong>correo@example.com</strong> / <strong>••••••••</strong>
                </span>
            </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>
</div>