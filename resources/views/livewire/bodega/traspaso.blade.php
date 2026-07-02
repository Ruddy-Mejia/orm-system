{{-- resources/views/livewire/bodega/traspaso.blade.php --}}
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
                            <i class="fas fa-exchange-alt text-blue-600 mr-2"></i>Traspaso entre Bodegas
                        </h2>
                    </div>

                    <form wire:submit.prevent="save">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Bodega Origen <span class="text-red-600">*</span>
                                </label>
                                <select wire:model.live="bodega_origen_id" 
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md @error('bodega_origen_id') border-red-300 @enderror">
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
                                    Bodega Destino <span class="text-red-600">*</span>
                                </label>
                                <select wire:model.live="bodega_destino_id" 
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md @error('bodega_destino_id') border-red-300 @enderror">
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
                            <textarea wire:model="observacion" 
                                      rows="2" 
                                      class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('observacion') border-red-300 @enderror"
                                      placeholder="Observaciones del traspaso..."></textarea>
                            @error('observacion') 
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @if($bodega_origen_id && !empty($productosOrigen))
                            <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-info-circle text-blue-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            <strong>{{ count($productosOrigen) }}</strong> productos disponibles en la bodega de origen
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <hr class="my-6">

                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-arrows-alt-h mr-2"></i>Productos a Traspasar
                            </h3>
                            <button type="button" 
                                    wire:click="agregarProducto" 
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="fas fa-plus mr-1"></i> Agregar Producto
                            </button>
                        </div>

                        <div class="space-y-4">
                            @foreach($productos as $index => $producto)
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                        <div class="md:col-span-5">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Producto <span class="text-red-600">*</span>
                                            </label>
                                            <select wire:model.live="productos.{{ $index }}.producto_id" 
                                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md @error('productos.'.$index.'.producto_id') border-red-300 @enderror">
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
                                        <div class="md:col-span-3">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Cantidad <span class="text-red-600">*</span>
                                            </label>
                                            <input type="number" 
                                                   wire:model="productos.{{ $index }}.cantidad" 
                                                   class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('productos.'.$index.'.cantidad') border-red-300 @enderror"
                                                   step="0.01" min="0.01" placeholder="0.00">
                                            @error('productos.'.$index.'.cantidad') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Stock Disponible
                                            </label>
                                            <input type="text" 
                                                   class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-100 text-gray-700"
                                                   value="{{ number_format($producto['stock_disponible'] ?? 0, 2) }}" 
                                                   readonly>
                                        </div>
                                        <div class="md:col-span-2 flex items-end">
                                            <button type="button" 
                                                    wire:click="eliminarProducto({{ $index }})" 
                                                    class="w-full inline-flex justify-center items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <i class="fas fa-trash mr-1"></i> Eliminar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 flex items-center space-x-3">
                            <button type="submit" 
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <span wire:loading.remove>
                                    <i class="fas fa-exchange-alt mr-1"></i> Realizar Traspaso
                                </span>
                                <span wire:loading>
                                    <i class="fas fa-spinner fa-spin mr-1"></i> Procesando...
                                </span>
                            </button>
                            <a href="{{ route('bodegas.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="fas fa-times mr-1"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>