<div>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">Listado de Trabajadores</h1>
                    <p class="text-gray-300 text-sm">Gestión de trabajadores del sistema</p>
                </div>
                <a href="{{ route('personas.create') }}" 
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nueva Persona
                </a>
            </div>

            <!-- Mensaje de éxito -->
            @if(session()->has('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 m-4 rounded">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Filtros -->
            <div class="p-4 border-b bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                        <input type="text" wire:model.live="search" 
                               class="w-full px-3 py-2 border rounded-lg" 
                               placeholder="Nombre, RUT o email...">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Empresa</label>
                        <select wire:model.live="companyFilter" class="w-full px-3 py-2 border rounded-lg">
                            <option value="">Todas</option>
                            <option value="Empresa1">Empresa1</option>
                            <option value="Empresa2">Empresa2</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sitio</label>
                        <select wire:model.live="siteFilter" class="w-full px-3 py-2 border rounded-lg">
                            <option value="">Todos</option>
                            @foreach($sitios as $sitio)
                                <option value="{{ $sitio->id }}">{{ $sitio->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Registros por página</label>
                        <select wire:model.live="perPage" class="w-full px-3 py-2 border rounded-lg">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tabla de trabajadores -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 border-b text-left">RUT</th>
                            <th class="px-4 py-3 border-b text-left">Nombre Completo</th>
                            <th class="px-4 py-3 border-b text-left">Email</th>
                            <th class="px-4 py-3 border-b text-center">Empresa</th>
                            <th class="px-4 py-3 border-b text-center">Sitio</th>
                            <th class="px-4 py-3 border-b text-center">Cargo</th>
                            <th class="px-4 py-3 border-b text-center">Estado Civil</th>
                            <th class="px-4 py-3 border-b text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($persons as $person)
                            <tr class="hover:bg-gray-50" wire:key="person-{{ $person->id }}">
                                <td class="px-4 py-3 border-b font-medium whitespace-nowrap">
                                    {{ $person->rut }}
                                </td>
                                <td class="px-4 py-3 border-b">
                                    <div>
                                        <p class="font-medium whitespace-nowrap">{{ $person->nombres }} {{ $person->apellido_paterno }} {{ $person->apellido_materno }}</p>
                                        <p class="text-xs text-gray-400">ID: {{ $person->id }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3 border-b">{{ $person->email }}</td>
                                <td class="px-4 py-3 border-b text-center">
                                    <span class="px-2 py-1 rounded text-xs {{ $person->empresa === 'Empresa1' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ $person->empresa === 'Empresa1' ? 'Empresa1' : 'Empresa2' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 border-b text-center">
                                    <span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-800 whitespace-nowrap">
                                        {{ $person->sitioRel ? $person->sitioRel->descripcion : 'N/A' }}                                        
                                    </span>
                                </td>
                                <td class="px-4 py-3 border-b text-sm whitespace-nowrap">
                                    {{ $person->cargo }}
                                </td>
                                <td class="px-4 py-3 border-b text-center">
                                    <span class="px-2 py-1 rounded text-xs {{ $person->estado_civil === 'casado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($person->estado_civil) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 border-b text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('personas.edit', $person->id) }}"
                                            class="text-yellow-600 hover:text-yellow-800 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </a>
                                        <button wire:click="deletePerson({{ $person->id }})"
                                            wire:confirm="¿Estás seguro de eliminar esta persona?"
                                            class="text-red-600 hover:text-red-800 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                    No hay trabajadores registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="px-4 py-3 border-t">
                {{ $persons->links() }}
            </div>
        </div>
    </div>
</div>