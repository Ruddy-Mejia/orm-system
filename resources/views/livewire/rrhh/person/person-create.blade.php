<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Nueva Persona</h1>
                <p class="text-gray-300 text-sm">Ingrese los datos de la nueva persona</p>
            </div>
            <a href="{{ route('personas.index') }}" 
                class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver al Listado
            </a>
        </div>

        <!-- Formulario -->
        <form wire:submit.prevent="save" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- RUT -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">RUT *</label>
                    <input type="text" wire:model="rut" class="w-full px-3 py-2 border rounded-lg" placeholder="Ej: 12345678-9">
                    @error('rut') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Nombres -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombres *</label>
                    <input type="text" wire:model="nombres" class="w-full px-3 py-2 border rounded-lg">
                    @error('nombres') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Apellido Paterno -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Apellido Paterno *</label>
                    <input type="text" wire:model="apellido_paterno" class="w-full px-3 py-2 border rounded-lg">
                    @error('apellido_paterno') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Apellido Materno -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Apellido Materno *</label>
                    <input type="text" wire:model="apellido_materno" class="w-full px-3 py-2 border rounded-lg">
                    @error('apellido_materno') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Fecha Nacimiento -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha Nacimiento *</label>
                    <input type="date" wire:model="fecha_nacimiento" class="w-full px-3 py-2 border rounded-lg">
                    @error('fecha_nacimiento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Género -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Género *</label>
                    <select wire:model="genero" class="w-full px-3 py-2 border rounded-lg">
                        <option value="">Seleccione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                    @error('genero') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Dirección -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dirección *</label>
                    <input type="text" wire:model="direccion" class="w-full px-3 py-2 border rounded-lg">
                    @error('direccion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Ciudad -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ciudad *</label>
                    <input type="text" wire:model="ciudad" class="w-full px-3 py-2 border rounded-lg">
                    @error('ciudad') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Nacionalidad -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nacionalidad *</label>
                    <input type="text" wire:model="nacionalidad" class="w-full px-3 py-2 border rounded-lg" placeholder="Ej: Chilena">
                    @error('nacionalidad') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Estado Civil -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado Civil *</label>
                    <select wire:model="estado_civil" class="w-full px-3 py-2 border rounded-lg">
                        <option value="">Seleccione</option>
                        <option value="casado">Casado</option>
                        <option value="soltero">Soltero</option>
                    </select>
                    @error('estado_civil') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" wire:model="email" class="w-full px-3 py-2 border rounded-lg">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Teléfono -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono *</label>
                    <input type="text" wire:model="telefono" class="w-full px-3 py-2 border rounded-lg">
                    @error('telefono') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Cargo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cargo *</label>
                    <input type="text" wire:model="cargo" class="w-full px-3 py-2 border rounded-lg">
                    @error('cargo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Fecha Ingreso -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha Ingreso *</label>
                    <input type="date" wire:model="fecha_ingreso" class="w-full px-3 py-2 border rounded-lg">
                    @error('fecha_ingreso') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Empresa -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Empresa *</label>
                    <select wire:model="empresa" class="w-full px-3 py-2 border rounded-lg">
                        <option value="">Seleccione</option>
                        <option value="Empresa1">Empresa1</option>
                        <option value="Empresa2">Empresa2</option>
                    </select>
                    @error('empresa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Sitio -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sitio *</label>
                    <select wire:model="sitio" class="w-full px-3 py-2 border rounded-lg">
                        <option value="">Seleccione</option>
                        @foreach($sitios as $sitio)
                            <option value="{{ $sitio->id }}">{{ $sitio->descripcion }}</option>
                        @endforeach
                    </select>
                    @error('sitio') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex justify-end gap-3 border-t pt-6">
                <button type="button" wire:click="cancel" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                    Cancelar
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Guardar Persona
                </button>
            </div>
        </form>
    </div>
</div>