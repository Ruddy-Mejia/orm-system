{{-- resources/views/livewire/bodega/traspaso.blade.php --}}
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
                <h1 class="text-2xl font-bold">Traspaso entre Bodegas</h1>
                <p class="text-gray-300 text-sm">Realice el traspaso de productos entre bodegas</p>
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

            <!-- Datos del traspaso -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Información del Traspaso</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Bodega Origen <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="bodega_origen_id"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('bodega_origen_id') border-red-500 @enderror">
                            <option value="">Seleccione bodega origen...</option>
                            @foreach($bodegas as $bodega)
                                <option value="{{ $bodega->id }}">{{ $bodega->sitio }} - {{ $bodega->nombre }}</option>
                            @endforeach
                        </select>
                        @error('bodega_origen_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Bodega Destino <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="bodega_destino_id"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('bodega_destino_id') border-red-500 @enderror">
                            <option value="">Seleccione bodega destino...</option>
                            @foreach($bodegas as $bodega)
                                <option value="{{ $bodega->id }}">{{ $bodega->sitio }} - {{ $bodega->nombre }}</option>
                            @endforeach
                        </select>
                        @error('bodega_destino_id')
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
                              placeholder="Observaciones del traspaso..."></textarea>
                    @error('observacion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @if($bodega_origen_id && !empty($productosOrigen))
                    <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-blue-700">
                                <strong>{{ count($productosOrigen) }}</strong> productos disponibles en la bodega de origen
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Productos -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold border-b pb-2">Productos a Traspasar</h2>
                    <button type="button" wire:click="agregarProducto"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar Producto
                    </button>
                </div>

                <div class="space-y-4">
                    @foreach($productos as $index => $producto)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                <!-- Producto -->
                                <div class="md:col-span-5">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Producto <span class="text-red-500">*</span>
                                    </label>
                                    <select wire:model.live="productos.{{ $index }}.producto_id"
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('productos.'.$index.'.producto_id') border-red-500 @enderror">
                                        <option value="">Seleccione un producto...</option>
                                        @foreach($productosOrigen as $prod)
                                            <option value="{{ $prod['id'] }}">
                                                {{ $prod['nombre'] }} (Stock: {{ number_format($prod['stock'], 2) }} {{ $prod['unidad'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('productos.'.$index.'.producto_id')
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
                                           class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('productos.'.$index.'.cantidad') border-red-500 @enderror"
                                           step="0.01" min="0.01" placeholder="0.00">
                                    @error('productos.'.$index.'.cantidad')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Stock Disponible -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Stock Disponible
                                    </label>
                                    <div class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700">
                                        {{ number_format($producto['stock_disponible'] ?? 0, 2) }}
                                    </div>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        Realizar Traspaso
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>