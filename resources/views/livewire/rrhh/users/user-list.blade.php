<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Listado de Usuarios</h1>
                <p class="text-gray-300 text-sm">Gestión de usuarios del sistema</p>
            </div>
            <button wire:click="openCreateModal"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nuevo Usuario
            </button>
        </div>

        <!-- Filtros -->
        <div class="p-4 border-b bg-gray-50">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                    <input type="text" wire:model.live.debounce.300ms="search" 
                           class="w-full px-3 py-2 border rounded-lg" 
                           placeholder="Nombre o email...">
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
                        <th class="px-4 py-3 border-b text-left">Usuario</th>
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
                                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium">{{ $user->name }}</p>
                                        @if(auth()->user()->rolRel->nombre === 'admin')
                                            <p class="text-xs text-gray-400">ID: {{ $user->id }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 border-b">{{ $user->email }}</td>
                            <td class="px-4 py-3 border-b text-center">
                                <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">
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
                                    <button wire:click="openEditModal({{ $user->id }})"
                                        class="text-yellow-600 hover:text-yellow-800 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </button>
                                    <button wire:click="deleteUser({{ $user->id }})"
                                        wire:confirm="¿Estás seguro de eliminar este usuario?"
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

    <!-- Modal para crear/editar usuario -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>
                
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form wire:submit.prevent="save">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mb-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $modalTitle }}</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                                    <input type="text" wire:model="name" class="w-full px-3 py-2 border rounded-lg">
                                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                    <input type="email" wire:model="email" class="w-full px-3 py-2 border rounded-lg">
                                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña {{ !$userId ? '*' : '' }}</label>
                                    <input type="password" wire:model="password" class="w-full px-3 py-2 border rounded-lg">
                                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    @if($userId) <p class="text-xs text-gray-400 mt-1">Dejar en blanco para mantener la actual</p> @endif
                                </div>
                                
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
                                
                                <div>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="status" class="mr-2">
                                        <span class="text-sm font-medium text-gray-700">Usuario activo</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                {{ $userId ? 'Actualizar' : 'Crear' }}
                            </button>
                            <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>