<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-800 text-white px-6 py-4">
            <h1 class="text-2xl font-bold">Listado de OC</h1>
            <p class="text-gray-300 text-sm">Administra y haz el seguimiento de tus ordenes de compra</p>
        </div>

        <!-- Filtros -->
        <div class="p-4 border-b bg-gray-50">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Buscar OC</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               placeholder="Buscar OC..."
                               class="w-full pl-10 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Tabla de OC -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th wire:click="sortBy('oc')" 
                            class="px-4 py-3 border-b text-left cursor-pointer hover:bg-gray-200 transition">
                            <div class="flex items-center gap-1">
                                OC
                                @if ($sortField == 'oc')
                                    <span class="text-xs">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('orm')" 
                            class="px-4 py-3 border-b text-left cursor-pointer hover:bg-gray-200 transition">
                            <div class="flex items-center gap-1">
                                ORM
                                @if ($sortField == 'orm')
                                    <span class="text-xs">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>
                        </th>
                        <th class="px-4 py-3 border-b text-left">Comprador</th>
                        <th class="px-4 py-3 border-b text-left">Proveedor</th>
                        <th class="px-4 py-3 border-b text-left">CDC</th>
                        <th class="px-4 py-3 border-b text-left">Forma de pago</th>
                        <th wire:click="sortBy('created_at')" 
                            class="px-4 py-3 border-b text-left cursor-pointer hover:bg-gray-200 transition">
                            <div class="flex items-center gap-1">
                                Fecha
                                @if ($sortField == 'created_at')
                                    <span class="text-xs">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>
                        </th>
                        <th class="px-4 py-3 border-b text-left">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ocs as $oc)
                        <tr class="hover:bg-gray-50 transition" wire:key="oc-{{ $oc->id }}">
                            <td class="px-4 py-3 border-b">
                                <a href="{{ route('oc.show', $oc->oc) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                    {{ $oc->oc }}
                                </a>
                            </td>
                            <td class="px-4 py-3 border-b">
                                <a href="{{ route('orm.show', $oc->ormRel->orm) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                    {{ $oc->ormRel->orm }}
                                </a>
                            </td>
                            <td class="px-4 py-3 border-b">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-xs">
                                        {{ $oc->ormRel->compradorRel ? substr($oc->ormRel->compradorRel->name, 0, 1) : 'N' }}
                                    </div>
                                    <span>{{ $oc->ormRel->compradorRel->name ?? 'No asignado' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 border-b">
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">
                                    {{ $oc->proveedorRel->razon_social }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    {{ $oc->ormRel->cdcRel->cdc }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b">
                                <span class="px-2 py-1 bg-gray-200 text-gray-800 rounded-full text-xs">
                                    {{ $oc->formapagoRel->descripcion }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b text-sm">
                                {{ $oc->ormRel->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3 border-b">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                    $ {{ number_format($oc->monto_total, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-500">
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
            {{ $ocs->links() }}
        </div>
    </div>
</div>