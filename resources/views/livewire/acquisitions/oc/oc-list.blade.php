<div class="py-6 text-sm">
    <div class="w-full px-6 mx-auto">
        <div class="mb-6">
            <div class="flex flex-col justify-center">
                <h1 class="text-2xl font-bold text-gray-800">Listado de OC</h1>
                <p class="text-gray-600">Administra y haz el seguimiento de tus ordenes de compra</p>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


            <div class="p-6">
                {{-- Header --}}
                <div class="mb-6 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">OCs</h1>

                    {{-- Filtros --}}
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar OC"
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
                                <th wire:click="sortBy('oc')"
                                    class="px-6 py-3 text-left cursor-pointer hover:bg-gray-100">
                                    OC
                                    @if ($sortField == 'oc')
                                        <span class="ml-1">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </th>
                                <th wire:click="sortBy('orm')"
                                    class="px-6 py-3 text-left cursor-pointer hover:bg-gray-100">
                                    ORM
                                    @if ($sortField == 'orm')
                                        <span class="ml-1">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </th>
                                <th class="px-6 py-3 text-left">Comprador</th>
                                <th class="px-6 py-3 text-left">Proveedor</th>
                                <th class="px-6 py-3 text-left">CDC</th>
                                <th class="px-6 py-3 text-left">Forma de pago</th>                                
                                <th wire:click="sortBy('created_at')"
                                    class="px-6 py-3 text-left cursor-pointer hover:bg-gray-100">
                                    Fecha
                                </th>
                                <th class="px-6 py-3 text-left">Monto</th>                                
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($ocs as $oc)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium"> <a class="text-blue-600"
                                        href="{{ route('oc.view', $oc->oc) }}">{{ $oc->oc }}</a></td>
                                        <td class="px-6 py-4 font-medium"> <a class="text-blue-600"
                                            href="{{ route('orm.view', $oc->ormRel->orm) }}">{{ $oc->ormRel->orm }}</a></td>

                                    <td class="px-6 py-4 text-sm">{{ $oc->ormRel->compradorRel ? $oc->ormRel->compradorRel->name : "No asignado" }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $oc->proveedorRel->razon_social }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $oc->ormRel->cdcRel->cdc }}</td>
                                    
                                    <td class="px-6 py-4 text-sm">{{ $oc->formapagoRel->descripcion }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        {{ $oc->ormRel->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            {{ "$ " . $oc->monto_total }}
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
                    {{ $ocs->links() }}
                </div>
            </div>





        </div>
    </div>
</div>
