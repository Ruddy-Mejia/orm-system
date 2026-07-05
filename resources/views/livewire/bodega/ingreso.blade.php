<div>
    <div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-800 text-white px-6 py-4 flex items-center gap-4">
            <a href="{{ route('bodegas.index') }}" class="text-white hover:text-gray-300 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold">Registro de Ingreso a Bodega</h1>
                <p class="text-gray-300 text-sm">Complete los datos del ingreso de productos</p>
            </div>
        </div>

        <form wire:submit.prevent="save" class="p-6">
            <!-- Mensajes de error generales -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Datos del ingreso -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Información del Ingreso</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Bodega <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="bodega_id"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('bodega_id') border-red-500 @enderror">
                            <option value="">Seleccione una bodega...</option>
                            @foreach ($bodegas as $bodega)
                                <option value="{{ $bodega->id }}">{{ $bodega->sitio }} - {{ $bodega->nombre }}</option>
                            @endforeach
                        </select>
                        @error('bodega_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Documento/Factura
                        </label>
                        <input type="text" wire:model="documento"
                               class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('documento') border-red-500 @enderror"
                               placeholder="N° de factura o guía">
                        @error('documento')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Observación
                    </label>
                    <textarea wire:model="observacion" rows="2"
                              class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('observacion') border-red-500 @enderror"
                              placeholder="Observaciones del ingreso..."></textarea>
                    @error('observacion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Adjuntar Factura -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Adjuntar Factura <span class="text-gray-500 text-xs font-normal">(Opcional)</span>
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="factura"
                                       class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Subir archivo</span>
                                    <input id="factura" type="file" wire:model="factura"
                                           class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                                </label>
                                <p class="pl-1">o arrastrar y soltar</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF, JPG, PNG (Máx 5MB)</p>
                            @if ($factura)
                                <p class="text-sm text-green-600 flex items-center justify-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Archivo seleccionado: {{ $factura->getClientOriginalName() }}
                                </p>
                            @endif
                        </div>
                    </div>
                    @error('factura')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Productos -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold border-b pb-2">Productos</h2>
                    <button type="button" wire:click="agregarProducto"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar Producto
                    </button>
                </div>

                <div class="space-y-4">
                    @foreach ($productos as $index => $producto)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                <!-- Producto -->
                                <div class="md:col-span-7">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Producto <span class="text-red-500">*</span>
                                    </label>

                                    @if (empty($producto['producto_id']))
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                </svg>
                                            </div>
                                            <input type="text"
                                                   wire:model.live.debounce.300ms="producto_busqueda"
                                                   wire:focus="abrirSugerenciasProducto"
                                                   wire:blur="cerrarSugerenciasProducto"
                                                   class="w-full pl-10 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                                   placeholder="Buscar producto (mínimo 2 caracteres)"
                                                   autocomplete="off">

                                            @if ($mostrar_sugerencias_producto)
                                                <div class="absolute z-50 w-full bg-white border border-gray-300 rounded-lg shadow-lg mt-1 max-h-60 overflow-y-auto">
                                                    @forelse ($productos_sugeridos as $sugerencia)
                                                        <div wire:click.prevent="seleccionarProducto({{ $index }}, {{ $sugerencia->id }})"
                                                             class="px-4 py-2 hover:bg-blue-50 cursor-pointer border-b border-gray-100 last:border-b-0 transition-colors duration-150">
                                                            <div class="font-medium text-gray-900">{{ $sugerencia->nombre }}</div>
                                                            <div class="text-sm text-gray-600">
                                                                <span class="inline-block mr-3">
                                                                    <svg class="w-3 h-3 inline text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                                    </svg>
                                                                    Unidad: {{ $sugerencia->unidad ?? 'N/A' }}
                                                                </span>
                                                                @if ($sugerencia->categoria)
                                                                    <span class="inline-block">
                                                                        <svg class="w-3 h-3 inline text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                                        </svg>
                                                                        {{ $sugerencia->categoria }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="px-4 py-3 text-center text-gray-500">
                                                            No se encontraron resultados
                                                        </div>
                                                    @endforelse
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="flex items-center justify-between bg-white border border-green-300 rounded-lg px-3 py-2">
                                            <div>
                                                <span class="font-medium text-gray-900">{{ $producto['nombre_producto'] }}</span>
                                                <span class="text-xs text-gray-500 ml-2">
                                                    <svg class="w-3 h-3 inline text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Seleccionado
                                                </span>
                                            </div>
                                            <button type="button"
                                                    wire:click="quitarProductoSeleccionado({{ $index }})"
                                                    class="text-blue-600 hover:text-blue-800 transition-colors duration-150 text-sm font-medium">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                                </svg>
                                                Cambiar
                                            </button>
                                        </div>
                                        <input type="hidden" wire:model="productos.{{ $index }}.producto_id">
                                    @endif

                                    @error('productos.' . $index . '.producto_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Cantidad -->
                                <div class="md:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Cantidad <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                           wire:model="productos.{{ $index }}.cantidad"
                                           class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('productos.' . $index . '.cantidad') border-red-500 @enderror"
                                           step="0.01" min="0.01" placeholder="0.00">
                                    @error('productos.' . $index . '.cantidad')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Acciones -->
                                <div class="md:col-span-2 flex items-end">
                                    <button type="button"
                                            wire:click="eliminarProducto({{ $index }})"
                                            class="w-full inline-flex justify-center items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Botones -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t">
                <a href="{{ route('bodegas.index') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Cancelar
                </a>
                <button type="submit" wire:loading.attr="disabled"
                        class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 shadow-md shadow-blue-500/25 hover:shadow-lg disabled:opacity-50">
                    <span>
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Registrar Ingreso
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
</div>