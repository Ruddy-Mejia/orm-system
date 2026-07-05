<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-800 text-white px-6 py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold">Listado de ORM</h1>
                <p class="text-gray-300 text-sm">Administra y haz el seguimiento de tus requerimientos</p>
            </div>
            <a href="{{ route('orm.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nueva ORM
            </a>
        </div>

        <!-- Filtros -->
        <div class="p-4 border-b bg-gray-50">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Buscar ORM</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               placeholder="Buscar ORM..."
                               class="w-full pl-10 px-3 py-2 border rounded-lg">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de ORM -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th wire:click="sortBy('orm')" class="px-4 py-3 border-b text-left cursor-pointer hover:bg-gray-200 transition">
                            <div class="flex items-center gap-1">
                                ORM
                                @if ($sortField == 'orm')
                                    <span class="text-xs">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>
                        </th>
                        <th class="px-4 py-3 border-b text-left">CDC</th>
                        <th class="px-4 py-3 border-b text-left">Responsable</th>
                        <th wire:click="sortBy('created_at')" class="px-4 py-3 border-b text-left cursor-pointer hover:bg-gray-200 transition">
                            <div class="flex items-center gap-1">
                                Fecha
                                @if ($sortField == 'created_at')
                                    <span class="text-xs">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>
                        </th>
                        <th class="px-4 py-3 border-b text-left">Estado</th>
                        <th class="px-4 py-3 border-b text-left">Tipo</th>
                        <th class="px-4 py-3 border-b text-left">Sitio</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ordenes as $orden)
                        <tr class="hover:bg-gray-50 transition" wire:key="orm-{{ $orden->id }}">
                            <td class="px-4 py-3 border-b">
                                <a href="{{ route('orm.show', $orden->orm) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                    {{ $orden->orm }}
                                </a>
                            </td>
                            <td class="px-4 py-3 border-b">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    {{ $orden->cdcRel->cdc }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-xs">
                                        {{ $orden->responsableRel ? substr($orden->responsableRel->name, 0, 1) : 'N' }}
                                    </div>
                                    <span>{{ $orden->responsableRel->name ?? 'No asignado' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 border-b text-sm">
                                {{ $orden->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3 border-b">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    {{ $orden->status ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $orden->status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b">
                                <span class="px-2 py-1 bg-gray-200 text-gray-800 rounded-full text-xs font-medium">
                                    {{ strtoupper($orden->tipo) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b">
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">
                                    {{ strtoupper($orden->sitioRel->descripcion) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                No se encontraron registros
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="px-4 py-3 border-t">
            {{ $ordenes->links() }}
        </div>
    </div>
</div>