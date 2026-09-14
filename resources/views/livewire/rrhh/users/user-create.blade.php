<form wire:submit.prevent="save" class="p-6" enctype="multipart/form-data">
    <input type="hidden" wire:model="person_id">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Buscar Persona -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Buscar Persona *</label>
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="searchPerson"
                    class="w-full px-3 py-2 border rounded-lg" placeholder="Buscar por RUT, nombres o apellidos...">

                @if (!empty($persons))
                    <div
                        class="absolute z-10 w-full mt-1 bg-white border rounded-lg shadow-lg max-h-60 overflow-y-auto">
                        @foreach ($persons as $person)
                            <div wire:click="selectPerson({{ $person->id }})"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer border-b">
                                <p class="font-medium">{{ $person->nombres }} {{ $person->apellido_paterno }}</p>
                                <p class="text-sm text-gray-500">RUT: {{ $person->rut }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @error('person_id')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
            <!-- Debug: Mostrar el valor de person_id -->
            @if ($person_id)
                <p class="text-xs text-gray-500 mt-1">ID Persona seleccionada: {{ $person_id }}</p>
            @endif
        </div>
        @if ($selectedPerson)
            <div class="md:col-span-2 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium text-green-800">Persona Seleccionada:</p>
                        <p class="font-bold">{{ $selectedPerson->nombres }} {{ $selectedPerson->apellido_paterno }}
                            {{ $selectedPerson->apellido_materno }}</p>
                        <p class="text-sm text-gray-600">RUT: {{ $selectedPerson->rut }}</p>
                    </div>
                    <button type="button" wire:click="clearPerson" class="text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Resto de campos... -->
        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
            <input type="email" wire:model="email" class="w-full px-3 py-2 border rounded-lg">
            @error('email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Contraseña -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña *</label>
            <input type="password" wire:model="password" class="w-full px-3 py-2 border rounded-lg">
            @error('password')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña *</label>
            <input type="password" wire:model="password_confirmation" class="w-full px-3 py-2 border rounded-lg">
        </div>

        <!-- Rol -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Rol *</label>
            <select wire:model="rol_id" class="w-full px-3 py-2 border rounded-lg">
                <option value="">Seleccione un rol</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                @endforeach
            </select>
            @error('rol_id')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
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
            @error('foto_perfil')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
            @if ($foto_perfil)
                <div class="mt-2">
                    <img src="{{ $foto_perfil->temporaryUrl() }}" class="w-16 h-16 rounded-full object-cover">
                </div>
            @endif
        </div>

        <!-- Firma -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Firma</label>
            <input type="file" wire:model="firma" class="w-full px-3 py-2 border rounded-lg" accept="image/*">
            @error('firma')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
            @if ($firma)
                <div class="mt-2">
                    <img src="{{ $firma->temporaryUrl() }}" class="w-32 h-16 object-cover border">
                </div>
            @endif
        </div>
    </div>

    <div class="mt-6 flex justify-end gap-3 border-t pt-6">
        <button type="button" wire:click="cancel"
            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
            Cancelar
        </button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Crear Usuario
        </button>
    </div>
</form>
