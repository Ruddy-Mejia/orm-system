<div>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">Listado de Usuarios</h1>
                    <p class="text-gray-300 text-sm">Gestión de usuarios del sistema</p>
                </div>
                <a href="{{ route('users.create') }}" 
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nuevo Usuario
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
                        <input type="text" wire:model.live.debounce.300ms="search" 
                               class="w-full px-3 py-2 border rounded-lg" 
                               placeholder="Email, nombre o RUT...">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select wire:model.live="statusFilter" class="w-full px-3 py-2 border rounded-lg">
                            <option value="">Todos</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
                        <select wire:model.live="rolFilter" class="w-full px-3 py-2 border rounded-lg">
                            <option value="">Todos</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
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

            <!-- Tabla de usuarios -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 border-b text-left">Persona</th>
                            <th class="px-4 py-3 border-b text-left">Email</th>
                            <th class="px-4 py-3 border-b text-center">Rol</th>
                            <th class="px-4 py-3 border-b text-center">Estado</th>
                            <th class="px-4 py-3 border-b text-center">Fecha Registro</th>
                            <th class="px-4 py-3 border-b text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50" wire:key="user-{{ $user->id }}">
                                <td class="px-4 py-3 border-b">
                                    <div class="flex items-center gap-3">
                                        @if($user->foto_perfil)
                                            <img src="{{ Storage::url($user->foto_perfil) }}" 
                                                 class="w-8 h-8 rounded-full object-cover">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-sm font-bold whitespace-nowrap">
                                                {{ $user->personRel ? substr($user->personRel->nombres, 0, 1) : '?' }}
                                            </div>
                                        @endif
                                        <div>
                                            @if($user->personRel)
                                                <p class="font-medium whitespace-nowrap">{{ $user->personRel->nombres }} {{ $user->personRel->apellido_paterno }}</p>
                                                <p class="text-xs text-gray-500">RUT: {{ $user->personRel->rut }}</p>
                                            @else
                                                <p class="text-red-500">Sin persona asociada</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 border-b">{{ $user->email }}</td>
                                <td class="px-4 py-3 border-b text-center">
                                    <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800 whitespace-nowrap">
                                        {{ $user->rolRel->nombre ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 border-b text-center">
                                    <button wire:click="toggleStatus({{ $user->id }})"
                                        class="px-2 py-1 rounded text-xs {{ $user->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $user->status ? 'Activo' : 'Inactivo' }}
                                    </button>
                                </td>
                                <td class="px-4 py-3 border-b text-center text-sm">
                                    {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}
                                </td>
                                <td class="px-4 py-3 border-b text-center">
                                    <div class="flex justify-center gap-2">
                                        <!-- Botón Ver Persona -->
                                        <button wire:click="viewPerson({{ $user->id }})"
                                            class="text-blue-600 hover:text-blue-800 transition"
                                            title="Ver datos de la persona">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <!-- Botón Editar -->
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-yellow-600 hover:text-yellow-800 transition"
                                            title="Editar usuario">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </a>
                                        <!-- Botón Eliminar -->
                                        <button wire:click="deleteUser({{ $user->id }})"
                                            wire:confirm="¿Estás seguro de eliminar este usuario?"
                                            class="text-red-600 hover:text-red-800 transition"
                                            title="Eliminar usuario">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                    No hay usuarios registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="px-4 py-3 border-t">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Modal para ver datos de la persona -->
    @if($showPersonModal && $selectedPerson)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closePersonModal"></div>
                
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Header del Modal -->
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                                Datos de la Persona
                            </h3>
                            <button wire:click="closePersonModal" 
                                    class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Datos de la Persona -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- RUT -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">RUT</p>
                                <p class="font-medium">{{ $selectedPerson->rut }}</p>
                            </div>
                            
                            <!-- Nombre Completo -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Nombre Completo</p>
                                <p class="font-medium">{{ $selectedPerson->nombres }} {{ $selectedPerson->apellido_paterno }} {{ $selectedPerson->apellido_materno }}</p>
                            </div>
                            
                            <!-- Fecha Nacimiento -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Fecha Nacimiento</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($selectedPerson->fecha_nacimiento)->format('d/m/Y') }}</p>
                            </div>
                            
                            <!-- Género -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Género</p>
                                <p class="font-medium">{{ $selectedPerson->genero }}</p>
                            </div>
                            
                            <!-- Estado Civil -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Estado Civil</p>
                                <p class="font-medium">{{ ucfirst($selectedPerson->estado_civil) }}</p>
                            </div>
                            
                            <!-- Nacionalidad -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Nacionalidad</p>
                                <p class="font-medium">{{ $selectedPerson->nacionalidad }}</p>
                            </div>
                            
                            <!-- Email -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Email</p>
                                <p class="font-medium">{{ $selectedPerson->email }}</p>
                            </div>
                            
                            <!-- Teléfono -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Teléfono</p>
                                <p class="font-medium">{{ $selectedPerson->telefono }}</p>
                            </div>
                            
                            <!-- Dirección -->
                            <div class="bg-gray-50 p-3 rounded-lg md:col-span-2">
                                <p class="text-xs text-gray-500">Dirección</p>
                                <p class="font-medium">{{ $selectedPerson->direccion }}</p>
                            </div>
                            
                            <!-- Ciudad -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Ciudad</p>
                                <p class="font-medium">{{ $selectedPerson->ciudad }}</p>
                            </div>
                            
                            <!-- Cargo -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Cargo</p>
                                <p class="font-medium">{{ $selectedPerson->cargo }}</p>
                            </div>
                            
                            <!-- Fecha Ingreso -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Fecha Ingreso</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($selectedPerson->fecha_ingreso)->format('d/m/Y') }}</p>
                            </div>
                            
                            <!-- Empresa -->
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Empresa</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-xs {{ $selectedPerson->empresa === 'Empresa1' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ $selectedPerson->empresa === 'Empresa1' ? 'Empresa1' : 'Empresa2' }}
                                    </span>
                                </p>
                            </div>
                            
                            <!-- Sitio -->
                            <div class="bg-gray-50 p-3 rounded-lg md:col-span-2">
                                <p class="text-xs text-gray-500">Sitio</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-800">
                                        {{ $selectedPerson->sitioRel->descripcion ?? 'N/A' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer del Modal -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" 
                                wire:click="closePersonModal" 
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>