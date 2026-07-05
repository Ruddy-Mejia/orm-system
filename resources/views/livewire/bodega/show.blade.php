{{-- resources/views/livewire/bodega/show.blade.php --}}
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-800 text-white px-6 py-4">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('bodegas.index') }}" class="text-white hover:text-gray-300 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold">{{ $bodega->nombre }}</h1>
                        <p class="text-gray-300 text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Sitio: {{ $bodega->sitio }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('bodegas.ingreso') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Ingreso
                    </a>
                    <a href="{{ route('bodegas.traspaso') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        Traspaso
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">Productos en stock</p>
                            <p class="text-3xl font-bold">{{ $totalProductos }}</p>
                        </div>
                        <svg class="w-12 h-12 text-blue-200 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm">Total de unidades</p>
                            <p class="text-3xl font-bold">{{ number_format($totalUnidades, 2) }}</p>
                        </div>
                        <svg class="w-12 h-12 text-green-200 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button class="tab-button active border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="productos">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Productos
                    </button>
                    <button class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="movimientos">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Movimientos
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="mt-6">
                <!-- Productos Tab -->
                <div id="tab-productos" class="tab-content">
                    <div class="mb-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.300ms="search" class="w-full pl-10 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Buscar productos...">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                    <th class="px-4 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unidad</th>
                                    <th class="px-4 py-3 border-b text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                    <th class="px-4 py-3 border-b text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($productos as $producto)
                                <tr class="hover:bg-gray-50 transition" wire:key="producto-{{ $producto->id }}">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $producto->nombre }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $producto->unidad ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-sm text-right font-semibold">{{ number_format($producto->pivot->cantidad, 2) }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @if ($producto->pivot->cantidad > 0)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-2 h-2 mr-1 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10" />
                                            </svg>
                                            Disponible
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-2 h-2 mr-1 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10" />
                                            </svg>
                                            Agotado
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        No hay productos en esta bodega
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $productos->links() }}
                    </div>
                </div>

                <!-- Movimientos Tab -->
                <div id="tab-movimientos" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.300ms="search" class="w-full pl-10 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Buscar por producto...">
                        </div>
                        <div>
                            <select wire:model.live="filtroTipo" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Todos los tipos</option>
                                @foreach ($tiposMovimientos as $tipo)
                                <option value="{{ $tipo }}">{{ ucfirst(str_replace('_', ' ', $tipo)) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th class="px-4 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                    <th class="px-4 py-3 border-b text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                    <th class="px-4 py-3 border-b text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                    <th class="px-4 py-3 border-b text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                    <th class="px-4 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                    <th class="px-4 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observación</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($movimientos as $movimiento)
                                <tr class="hover:bg-gray-50 transition" wire:key="movimiento-{{ $movimiento->id }}">
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $movimiento->productoRel->nombre }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @switch($movimiento->tipo)
                                        @case('ingreso')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                            </svg>
                                            Ingreso
                                        </span>
                                        @if ($movimiento->documento_path)
                                        <a href="{{ Storage::url($movimiento->documento_path) }}" target="_blank" class="inline-flex items-center text-xs text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-150">
                                            <i class="fas fa-file-pdf mr-1"></i>
                                            Factura
                                        </a>
                                        @endif
                                        @break

                                        @case('egreso')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                            </svg>
                                            Egreso
                                        </span>
                                        @break
                                        @case('traspaso_salida')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                            Salida Traspaso
                                        </span>
                                        @break
                                        @case('traspaso_entrada')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                            </svg>
                                            Entrada Traspaso
                                        </span>
                                        @break
                                        @default
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $movimiento->tipo }}
                                        </span>
                                        @endswitch
                                    </td>
                                    <td class="px-4 py-3 text-sm text-right font-semibold">{{ number_format($movimiento->cantidad, 2) }}</td>
                                    <td class="px-4 py-3 text-sm text-center">
                                        <span class="text-xs text-gray-500">
                                            {{ number_format($movimiento->stock_anterior, 2) }}
                                            <svg class="w-3 h-3 inline mx-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                            {{ number_format($movimiento->stock_nuevo, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $movimiento->usuarioRel?->name ?? 'Sistema' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $movimiento->observacion ?? 'N/A' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        No hay movimientos registrados
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $movimientos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-button');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                tabs.forEach(t => {
                    t.classList.remove('active', 'border-blue-500', 'text-blue-600');
                    t.classList.add('border-transparent', 'text-gray-500');
                });

                // Add active class to clicked tab
                this.classList.add('active', 'border-blue-500', 'text-blue-600');
                this.classList.remove('border-transparent', 'text-gray-500');

                // Hide all contents
                contents.forEach(c => c.classList.add('hidden'));

                // Show selected content
                const tabId = this.dataset.tab;
                document.getElementById('tab-' + tabId).classList.remove('hidden');
            });
        });
    });

</script>
