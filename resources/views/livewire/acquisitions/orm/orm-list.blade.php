<div class="p-6">
    {{-- Header --}}
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">ORMs</h1>

        {{-- Filtros --}}
        <div class="relative">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar ORM"
                class="px-10 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <x-heroicon-s-magnifying-glass class="w-5 h-5 text-gray-400" />
            </div>
        </div>
    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th wire:click="sortBy('orm')" class="px-6 py-3 text-left cursor-pointer hover:bg-gray-100">
                        ORM
                        @if ($sortField == 'orm')
                            <span class="ml-1">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left">CDC</th>
                    <th class="px-6 py-3 text-left">Responsable</th>
                    <th wire:click="sortBy('created_at')" class="px-6 py-3 text-left cursor-pointer hover:bg-gray-100">
                        Fecha
                    </th>
                    <th class="px-6 py-3 text-left">¿En atención?</th>
                    <th class="px-6 py-3 text-left">Tipo</th>
                    <th class="px-6 py-3 text-left">Sitio</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($ordenes as $orden)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium"> <a class="text-blue-600"
                                href="{{ route('orm.view', $orden->orm) }}">{{ $orden->orm }}</a></td>
                        <td class="px-6 py-4 text-sm">{{ $orden->cdcRel->cdc }}</td>
                        <td class="px-6 py-4 text-sm">{{ $orden ? $orden->responsableRel->name : "No asignado"}}</td>
                        <td class="px-6 py-4 text-sm">{{ $orden->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 flex justify-center">
                            <span
                                class="px-2 py-1 text-xs rounded-full 
                            {{ $orden->status ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-gray-800' }}">
                                {{ $orden->status ? 'Sí' : 'No' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-200 text-gray-800">
                                {{ strtoupper($orden->tipo) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-200 text-gray-800">
                                {{ strtoupper($orden->sitioRel->descripcion) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            No se encontraron registros
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $ordenes->links() }}
    </div>
</div>
