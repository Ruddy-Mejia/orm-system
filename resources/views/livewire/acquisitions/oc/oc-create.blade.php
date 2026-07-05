<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-800 text-white px-6 py-4">
            <h1 class="text-2xl font-bold">Crear Orden de Compra</h1>
            <p class="text-gray-300 text-sm">Complete los precios de los productos y los datos de la OC</p>
        </div>

        <form wire:submit.prevent="save" class="p-6">
            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Productos a Comprar -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Productos a Comprar</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 border text-left">Producto</th>
                                <th class="px-4 py-3 border text-center w-20">Cantidad</th>
                                <th class="px-4 py-3 border text-center w-28">Unidad</th>
                                <th class="px-4 py-3 border text-center w-36">Precio Unitario</th>
                                <th class="px-4 py-3 border text-center w-40">Fecha Estimada</th>
                                <th class="px-4 py-3 border text-center w-40">Ciudad</th>
                                <th class="px-4 py-3 border text-center w-40">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $index => $item)
                                <tr class="hover:bg-gray-50 transition" wire:key="producto-{{ $index }}">
                                    <td class="px-4 py-3 border align-top break-words">
                                        {{ $item['nombre'] }}
                                        <input type="hidden" wire:model="productos.{{ $index }}.id" value="{{ $item['id'] }}">
                                    </td>
                                    <td class="px-4 py-3 border text-center align-middle">
                                        {{ $item['cantidad'] }}
                                    </td>
                                    <td class="px-4 py-3 border text-center align-middle">
                                        {{ $item['unidad'] }}
                                    </td>
                                    <td class="px-4 py-3 border text-center align-middle">
                                        <div class="relative">
                                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                                            <input type="number" 
                                                   wire:model.live="productos.{{ $index }}.precio"
                                                   class="w-full pl-8 pr-3 py-1 border rounded-lg text-right focus:ring-2 focus:ring-blue-500"
                                                   step="0.01" placeholder="0.00">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border text-center align-middle">
                                        <input type="date" 
                                               wire:model.live="productos.{{ $index }}.f_estimada"
                                               class="w-full px-2 py-1 border rounded-lg text-center text-sm focus:ring-2 focus:ring-blue-500"
                                               min="{{ date('Y-m-d') }}">
                                    </td>
                                    <td class="px-4 py-3 border text-center align-middle">
                                        <select wire:model.live="productos.{{ $index }}.ciudad"
                                                class="w-full px-2 py-1 border rounded-lg text-center text-sm focus:ring-2 focus:ring-blue-500">
                                            <option value="">Seleccione...</option>
                                            @foreach ($ciudades as $ciudad)
                                                <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 py-3 border text-right align-middle font-semibold">
                                        $ {{ number_format(($item['precio'] ?? 0) * $item['cantidad'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 border text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        No hay productos seleccionados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="6" class="px-4 py-3 border text-right font-bold">SUBTOTAL PRODUCTOS:</td>
                                <td class="px-4 py-3 border text-right font-bold text-blue-600">
                                    $ {{ number_format($subtotal_productos, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Resumen de la Orden de Compra -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Resumen de la Orden de Compra</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Columna izquierda -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-3 border-b pb-2">Información de la OC</h3>

                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Proveedor <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="proveedor" 
                                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores_list as $prov)
                                        <option value="{{ $prov->id }}">{{ $prov->razon_social }}</option>
                                    @endforeach
                                </select>
                                @error('proveedor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Forma de Pago <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="forma_pago" 
                                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Seleccione forma de pago</option>
                                    @foreach ($forma_pago_list as $fp)
                                        <option value="{{ $fp->id }}">{{ $fp->descripcion }}</option>
                                    @endforeach
                                </select>
                                @error('forma_pago') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Convenio</label>
                                <select wire:model="convenio" 
                                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Seleccione un convenio</option>
                                    @foreach ($convenio_list as $c)
                                        <option value="{{ $c->id }}">{{ $c->convenio }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Plazo de Entrega (días) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" wire:model="plazo_entrega"
                                       class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                       min="1" max="365">
                                @error('plazo_entrega') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Cuotas <span class="text-red-500">*</span>
                                </label>
                                <input type="number" wire:model="cuotas" 
                                       class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                       min="1" max="36">
                                @error('cuotas') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" wire:model="terceros" 
                                       class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                <label class="ml-2 text-sm font-medium text-gray-700">Incluye terceros</label>
                            </div>
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-3 border-b pb-2">Totales</h3>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center pb-2 border-b">
                                <span class="text-gray-600">Subtotal productos:</span>
                                <span class="font-semibold">$ {{ number_format($subtotal_productos, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Descuentos:</span>
                                <div class="relative w-32">
                                    <span class="absolute left-2 top-1 text-gray-500">$</span>
                                    <input type="number" wire:model.live="descuentos"
                                           class="w-full pl-6 pr-2 py-1 border rounded text-right focus:ring-2 focus:ring-blue-500"
                                           step="0.01">
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Impuestos:</span>
                                <div class="relative w-32">
                                    <span class="absolute left-2 top-1 text-gray-500">$</span>
                                    <input type="number" wire:model.live="impuestos"
                                           class="w-full pl-6 pr-2 py-1 border rounded text-right focus:ring-2 focus:ring-blue-500"
                                           step="0.01">
                                </div>
                            </div>

                            <div class="flex justify-between items-center pb-2 border-b">
                                <span class="text-gray-600">Base Imponible:</span>
                                <span class="font-medium">$ {{ number_format($base_imponible, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">IVA (19%):</span>
                                <span class="font-medium">$ {{ number_format($monto_iva, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center pt-2 border-t border-gray-300">
                                <span class="text-lg font-bold text-gray-800">MONTO TOTAL:</span>
                                <span class="text-xl font-bold text-blue-600">$ {{ number_format($monto_total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documentos Adjuntos -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Documentos Adjuntos</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Factura</label>
                        <input type="text" wire:model="factura" 
                               class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                               placeholder="Número de factura">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Archivo Factura</label>
                        <input type="file" wire:model="path_factura" 
                               class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        <div wire:loading wire:target="path_factura" class="text-sm text-blue-600 mt-1">Subiendo...</div>
                        @error('path_factura') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Archivo Pago</label>
                        <input type="file" wire:model="path_pago" 
                               class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        <div wire:loading wire:target="path_pago" class="text-sm text-blue-600 mt-1">Subiendo...</div>
                        @error('path_pago') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Observación -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Observación</h2>
                <textarea wire:model="observacion" rows="3" 
                          class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                          placeholder="Observaciones adicionales..."></textarea>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('orm.index') }}" 
                   class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded transition duration-200">
                    Cancelar
                </a>
                <button type="submit" 
                        wire:loading.attr="disabled"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded transition duration-200 shadow-md shadow-blue-500/25 hover:shadow-lg">
                    <span wire:loading.remove>Crear OC</span>
                    <span wire:loading>Creando...</span>
                </button>
            </div>
        </form>
    </div>
</div>