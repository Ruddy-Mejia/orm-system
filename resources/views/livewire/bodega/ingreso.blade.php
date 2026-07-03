<div>
    <div>
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center mb-6">
                            <a href="{{ route('bodegas.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                <i class="fas fa-arrow-left text-xl"></i>
                            </a>
                            <h2 class="text-2xl font-bold text-gray-800">
                                <i class="fas fa-arrow-down text-green-600 mr-2"></i>Registro de Ingreso a Bodega
                            </h2>
                        </div>

                        <form wire:submit.prevent="save">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Bodega <span class="text-red-600">*</span>
                                    </label>
                                    <select wire:model="bodega_id"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md @error('bodega_id') border-red-300 @enderror">
                                        <option value="">Seleccione una bodega...</option>
                                        @foreach ($bodegas as $bodega)
                                            <option value="{{ $bodega->id }}">{{ $bodega->sitio }} -
                                                {{ $bodega->nombre }}</option>
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
                                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('documento') border-red-300 @enderror"
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
                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('observacion') border-red-300 @enderror"
                                    placeholder="Observaciones del ingreso..."></textarea>
                                @error('observacion')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Adjuntar Factura <span class="text-gray-500 text-xs font-normal">(Opcional)</span>
                                </label>
                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                        <div class="flex text-sm text-gray-600">
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
                                            <p class="text-sm text-green-600">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Archivo seleccionado: {{ $factura->getClientOriginalName() }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                @error('factura')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <hr class="my-6">

                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">
                                    <i class="fas fa-boxes mr-2"></i>Productos
                                </h3>
                                <button type="button" wire:click="agregarProducto"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    <i class="fas fa-plus mr-1"></i> Agregar Producto
                                </button>
                            </div>

                            <div class="space-y-4">
                                @foreach ($productos as $index => $producto)
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                            {{-- Autocomplete de Producto --}}
                                            <div class="md:col-span-7">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    Producto <span class="text-red-600">*</span>
                                                </label>

                                                @if (empty($producto['producto_id']))
                                                    {{-- Input de búsqueda --}}
                                                    <div class="relative">
                                                        <input type="text"
                                                            wire:model.live.debounce.300ms="producto_busqueda"
                                                            wire:focus="abrirSugerenciasProducto"
                                                            wire:blur="cerrarSugerenciasProducto"
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                            placeholder="Buscar producto (mínimo 2 caracteres)"
                                                            autocomplete="off">

                                                        {{-- Sugerencias --}}
                                                        @if ($mostrar_sugerencias_producto)
                                                            <div
                                                                class="absolute z-50 w-full bg-white border border-gray-300 rounded-lg shadow-lg mt-1 max-h-60 overflow-y-auto">
                                                                @forelse ($productos_sugeridos as $sugerencia)
                                                                    <div wire:click.prevent="seleccionarProducto({{ $index }}, {{ $sugerencia->id }})"
                                                                        class="px-4 py-2 hover:bg-blue-50 cursor-pointer border-b border-gray-100 last:border-b-0 transition-colors duration-150">
                                                                        <div class="font-medium text-gray-900">
                                                                            {{ $sugerencia->nombre }}</div>
                                                                        <div class="text-sm text-gray-600">
                                                                            <span class="inline-block mr-3">
                                                                                <i
                                                                                    class="fas fa-cube text-gray-400 mr-1"></i>
                                                                                Unidad:
                                                                                {{ $sugerencia->unidad ?? 'N/A' }}
                                                                            </span>
                                                                            @if ($sugerencia->categoria)
                                                                                <span class="inline-block">
                                                                                    <i
                                                                                        class="fas fa-tag text-gray-400 mr-1"></i>
                                                                                    {{ $sugerencia->categoria }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div
                                                                        class="px-4 py-2 hover:bg-blue-50 cursor-pointer border-b border-gray-100 last:border-b-0 transition-colors duration-150">
                                                                        <div class="font-medium text-gray-900">
                                                                            {{ "No se encontraron resultados" }}</div>                                                                        
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        @endif
                                                    </div>
                                                @else
                                                    {{-- Producto seleccionado --}}
                                                    <div
                                                        class="flex items-center justify-between bg-white border border-green-300 rounded-lg px-3 py-2">
                                                        <div>
                                                            <span
                                                                class="font-medium text-gray-900">{{ $producto['nombre_producto'] }}</span>
                                                            <span class="text-xs text-gray-500 ml-2">
                                                                <i class="fas fa-check-circle text-green-500 mr-1"></i>
                                                                Seleccionado
                                                            </span>
                                                        </div>
                                                        <button type="button"
                                                            wire:click="quitarProductoSeleccionado({{ $index }})"
                                                            class="text-blue-600 hover:text-blue-800 transition-colors duration-150 text-sm font-medium">
                                                            <i class="fas fa-exchange-alt mr-1"></i> Cambiar
                                                        </button>
                                                    </div>
                                                    <input type="hidden"
                                                        wire:model="productos.{{ $index }}.producto_id">
                                                @endif

                                                @error('productos.' . $index . '.producto_id')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            {{-- Cantidad --}}
                                            <div class="md:col-span-3">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    Cantidad <span class="text-red-600">*</span>
                                                </label>
                                                <input type="number"
                                                    wire:model="productos.{{ $index }}.cantidad"
                                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('productos.' . $index . '.cantidad') border-red-300 @enderror"
                                                    step="0.01" min="0.01" placeholder="0.00">
                                                @error('productos.' . $index . '.cantidad')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            {{-- Acciones --}}
                                            <div class="md:col-span-2 flex items-end pb-2">
                                                <button type="button"
                                                    wire:click="eliminarProducto({{ $index }})"
                                                    class="w-full inline-flex justify-center items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150">
                                                    <i class="fas fa-trash mr-1"></i> Eliminar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 flex items-center space-x-3">
                                <button type="submit" wire:loading.attr="disabled"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150 disabled:opacity-50">
                                    <span wire:loading.remove>
                                        <i class="fas fa-save mr-1"></i> Registrar Ingreso
                                    </span>
                                    <span wire:loading>
                                        <i class="fas fa-spinner fa-spin mr-1"></i> Procesando...
                                    </span>
                                </button>
                                <a href="{{ route('bodegas.index') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                                    <i class="fas fa-times mr-1"></i> Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</div>
