<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Editar Usuario</h1>
                <p class="text-gray-300 text-sm">Actualice los datos del usuario</p>
            </div>
            <a href="{{ route('users.index') }}" 
                class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver al Listado
            </a>
        </div>

        @if(session()->has('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 m-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="update" class="p-6" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Persona Asociada -->
                <div class="md:col-span-2 bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <p class="text-sm font-medium text-gray-700">Persona Asociada</p>
                    @if($personInfo)
                        <p class="font-medium">{{ $personInfo->nombres }} {{ $personInfo->apellido_paterno }} {{ $personInfo->apellido_materno }}</p>
                        <p class="text-sm text-gray-600">RUT: {{ $personInfo->rut }}</p>
                    @else
                        <p class="text-red-500">Persona no encontrada</p>
                    @endif
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" wire:model="email" class="w-full px-3 py-2 border rounded-lg">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Contraseña -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nueva Contraseña</label>
                    <input type="password" wire:model="password" class="w-full px-3 py-2 border rounded-lg" placeholder="Dejar en blanco para mantener">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                    <input type="password" wire:model="password_confirmation" class="w-full px-3 py-2 border rounded-lg" placeholder="Dejar en blanco para mantener">
                </div>

                <!-- Rol -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rol *</label>
                    <select wire:model="rol_id" class="w-full px-3 py-2 border rounded-lg">
                        <option value="">Seleccione un rol</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                        @endforeach
                    </select>
                    @error('rol_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Estado -->
                <div class="flex items-center">
                    <label class="flex items-center">
                        <input type="checkbox" wire:model="status" class="mr-2">
                        <span class="text-sm font-medium text-gray-700">Usuario activo</span>
                    </label>
                </div>

                <!-- Foto Perfil -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto de Perfil</label>
                    <input type="file" wire:model="foto_perfil" class="w-full px-3 py-2 border rounded-lg" accept="image/*">
                    @error('foto_perfil') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    
                    @if($foto_perfil)
                        <div class="mt-2">
                            <img src="{{ $foto_perfil->temporaryUrl() }}" class="w-16 h-16 rounded-full object-cover">
                            <p class="text-xs text-gray-500 mt-1">Nueva imagen</p>
                        </div>
                    @elseif($foto_perfil_actual)
                        <div class="mt-2">
                            <img src="{{ Storage::url($foto_perfil_actual) }}" class="w-16 h-16 rounded-full object-cover">
                            <p class="text-xs text-gray-500 mt-1">Imagen actual</p>
                        </div>
                    @endif
                </div>

                <!-- Firma -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Firma</label>
                    <input type="file" wire:model="firma" class="w-full px-3 py-2 border rounded-lg" accept="image/*">
                    @error('firma') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    
                    @if($firma)
                        <div class="mt-2">
                            <img src="{{ $firma->temporaryUrl() }}" class="w-32 h-16 object-cover border">
                            <p class="text-xs text-gray-500 mt-1">Nueva firma</p>
                        </div>
                    @elseif($firma_actual)
                        <div class="mt-2">
                            <img src="{{ Storage::url($firma_actual) }}" class="w-32 h-16 object-cover border">
                            <p class="text-xs text-gray-500 mt-1">Firma actual</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t pt-6">
                <button type="button" wire:click="cancel" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                    Cancelar
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>