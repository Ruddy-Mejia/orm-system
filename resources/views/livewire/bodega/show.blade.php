{{-- resources/views/livewire/bodega/show.blade.php --}}
<div>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">
                                    <i class="fas fa-warehouse text-blue-600"></i>
                                    {{ $bodega->nombre }}
                                </h2>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ 'Sitio: ' . $bodega->sitio }}
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('bodegas.ingreso') }}"
                                class="inline-flex items-center px-3 py-1.5 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                <i class="fas fa-plus mr-1"></i> Ingreso
                            </a>
                            <a href="{{ route('bodegas.traspaso') }}"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                <i class="fas fa-exchange-alt mr-1"></i> Traspaso
                            </a>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm">Productos en stock</p>
                                    <p class="text-3xl font-bold">{{ $totalProductos }}</p>
                                </div>
                                <i class="fas fa-boxes text-4xl text-blue-200 opacity-50"></i>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-100 text-sm">Total de unidades</p>
                                    <p class="text-3xl font-bold">{{ number_format($totalUnidades, 2) }}</p>
                                </div>
                                <i class="fas fa-cubes text-4xl text-green-200 opacity-50"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8">
                            <button
                                class="tab-button active border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                                data-tab="productos">
                                <i class="fas fa-box mr-2"></i>Productos
                            </button>
                            <button
                                class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                                data-tab="movimientos">
                                <i class="fas fa-history mr-2"></i>Movimientos
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
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" wire:model.live.debounce.300ms="search"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        placeholder="Buscar productos...">
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Producto</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Unidad</th>
                                            <th
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Cantidad</th>
                                            <th
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($productos as $producto)
                                            <tr class="hover:bg-gray-50">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $producto->nombre }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $producto->unidad ?? 'N/A' }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold">
                                                    {{ number_format($producto->pivot->cantidad, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    @if ($producto->pivot->cantidad > 0)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <i class="fas fa-circle text-green-400 text-xs mr-1"></i>
                                                            Disponible
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            <i class="fas fa-circle text-red-400 text-xs mr-1"></i>
                                                            Agotado
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
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
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" wire:model.live.debounce.300ms="search"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        placeholder="Buscar por producto...">
                                </div>
                                <div>
                                    <select wire:model.live="filtroTipo"
                                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option value="">Todos los tipos</option>
                                        @foreach ($tiposMovimientos as $tipo)
                                            <option value="{{ $tipo }}">
                                                {{ ucfirst(str_replace('_', ' ', $tipo)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Fecha</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Producto</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tipo</th>
                                            <th
                                                class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Cantidad</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Stock</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Usuario</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Observación</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($movimientos as $movimiento)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $movimiento->created_at->format('d/m/Y H:i') }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $movimiento->productoRel->nombre }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-center">
                                                    @switch($movimiento->tipo)
                                                        @case('ingreso')
                                                            <div class="flex items-center gap-2 flex-wrap">
                                                                {{-- Tipo de movimiento --}}
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                    <i class="fas fa-arrow-down mr-1"></i> Ingreso
                                                                </span>

                                                                {{-- Documento adjunto --}}
                                                                @if ($movimiento->documento_path)
                                                                    <a href="{{ Storage::url($movimiento->documento_path) }}"
                                                                        target="_blank"
                                                                        class="inline-flex items-center text-xs text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-150">
                                                                        <i class="fas fa-file-pdf mr-1"></i>
                                                                        Factura
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        @break

                                                        @case('egreso')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                <i class="fas fa-arrow-up mr-1"></i> Egreso
                                                            </span>
                                                        @break

                                                        @case('traspaso_salida')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                <i class="fas fa-arrow-right mr-1"></i> Salida Traspaso
                                                            </span>
                                                        @break

                                                        @case('traspaso_entrada')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                <i class="fas fa-arrow-left mr-1"></i> Entrada Traspaso
                                                            </span>
                                                        @break

                                                        @default
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                                {{ $movimiento->tipo }}
                                                            </span>
                                                    @endswitch
                                                </td>
                                                <td
                                                    class="px-4 py-3 whitespace-nowrap text-sm text-right font-semibold">
                                                    {{ number_format($movimiento->cantidad, 2) }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-center">
                                                    <span class="text-xs text-gray-500">
                                                        {{ number_format($movimiento->stock_anterior, 2) }}
                                                        <i class="fas fa-arrow-right mx-1 text-gray-400"></i>
                                                        {{ number_format($movimiento->stock_nuevo, 2) }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $movimiento->usuarioRel?->name ?? 'Sistema' }}
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-500">
                                                    {{ $movimiento->observacion ?? 'N/A' }}
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7"
                                                        class="px-4 py-3 text-center text-sm text-gray-500">
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
