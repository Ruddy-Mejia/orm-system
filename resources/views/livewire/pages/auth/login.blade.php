<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public $demoAccounts = [
        [
            'name' => 'Admin',
            'email' => 'rmejiam.dev@gmail.com',
            'password' => '12345678',
            'rol' => 'Administrador',
        ],
        [
            'name' => 'Luis Meza',
            'email' => 'comprador@example.com',
            'password' => '12345678',
            'rol' => 'Comprador',
        ],
        [
            'name' => 'Carla López',
            'email' => 'jefebodega@example.com',
            'password' => '12345678',
            'rol' => 'Jefe de Bodega',
        ],
        [
            'name' => 'Daniel Torres',
            'email' => 'user@example.com',
            'password' => '12345678',
            'rol' => 'Perfil básico',
        ],
    ];

    public function fillCredentials($email, $password)
    {
        $this->form->email = $email;
        $this->form->password = $password;
        $this->dispatch('toast', type: 'success', message: 'Credenciales cargadas para: ' . $email);
    }
}; ?>

<div>

    <div>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login">
            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="form.email" class="block mt-1 w-full" required autofocus />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 mt-4">
                <x-primary-button class="flex-1 justify-center">
                    {{ __('Iniciar Sesión') }}
                </x-primary-button>
            </div>
            <div class="mt-4 space-y-2">
                <p class="text-sm text-gray-600 font-medium">Cuentas de prueba:</p>

                @foreach($demoAccounts as $account)
                    <button type="button"
                        wire:click="fillCredentials('{{ $account['email'] }}', '{{ $account['password'] }}')"
                        class="w-full text-left px-4 py-2 text-sm bg-gray-50 hover:bg-gray-100 rounded-lg transition border border-gray-200 flex items-center justify-between">
                        <div>
                            <span class="font-medium text-gray-700">{{ $account['name'] }}</span>
                            <span class="text-xs text-gray-500 ml-2">({{ $account['rol'] }})</span>
                        </div>
                        <span class="text-xs text-gray-400">{{ $account['email'] }}</span>
                    </button>
                @endforeach
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</div>