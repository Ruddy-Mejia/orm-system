<div class="container mx-auto p-8">
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

            <!-- Tabla de productos -->
            {{-- <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Productos a Comprar</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border text-left">Producto</th>
                                <th class="px-4 py-2 border text-center w-24">Cantidad</th>
                                <th class="px-4 py-2 border text-center w-32">Unidad</th>
                                <th class="px-4 py-2 border text-center w-40">Precio Unitario</th>
                                <th class="px-4 py-2 border text-center w-32">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">
                                        {{ $item['nombre'] . " (" . $item['nombre'] . ")" }}
                                        <input type="hidden" wire:model="productos.{{ $index }}.id" value="{{ $item['id'] }}">
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        {{ $item['cantidad'] }}
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        {{ $item['unidad'] }}
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        <div class="relative">
                                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                                            <input type="number" 
                                                   wire:model.live="productos.{{ $index }}.precio"
                                                   class="w-full pl-8 pr-3 py-1 border rounded-lg text-right"
                                                   step="0.01"
                                                   placeholder="0.00">
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 border text-right">
                                        $ {{ number_format(($item['precio'] ?? 0) * $item['cantidad'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 border text-center text-gray-500">
                                        No hay productos seleccionados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="4" class="px-4 py-2 border text-right font-bold">SUBTOTAL PRODUCTOS:</td>
                                <td class="px-4 py-2 border text-right font-bold">$ {{ number_format($subtotal_productos, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div> --}}
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Productos a Comprar</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border text-left ">Producto</th>
                                <th class="px-4 py-2 border text-center w-20">Cantidad</th>
                                <th class="px-4 py-2 border text-center w-28">Unidad</th>
                                <th class="px-4 py-2 border text-center w-36">Precio Unitario</th>
                                <th class="px-4 py-2 border text-center w-40">Fecha Estimada</th>
                                <th class="px-4 py-2 border text-center w-40">Ciudad</th>
                                <th class="px-4 py-2 border text-center w-40">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    {{-- Producto con ajuste de texto --}}
                                    <td class="px-4 py-2 border align-top break-words">
                                        {{ $item['nombre'] }}
                                        <input type="hidden" wire:model="productos.{{ $index }}.id"
                                            value="{{ $item['id'] }}">
                                    </td>

                                    {{-- Cantidad --}}
                                    <td class="px-4 py-2 border text-center align-middle">
                                        {{ $item['cantidad'] }}
                                    </td>

                                    {{-- Unidad --}}
                                    <td class="px-4 py-2 border text-center align-middle">
                                        {{ $item['unidad'] }}
                                    </td>

                                    {{-- Precio Unitario --}}
                                    <td class="px-4 py-2 border text-center align-middle">
                                        <div class="relative">
                                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                                            <input type="number" wire:model.live="productos.{{ $index }}.precio"
                                                class="w-full pl-8 pr-3 py-1 border rounded-lg text-right"
                                                step="0.01" placeholder="0.00">
                                        </div>
                                    </td>

                                    {{-- Fecha Estimada --}}
                                    <td class="px-4 py-2 border text-center align-middle">
                                        <input type="date" wire:model.live="productos.{{ $index }}.f_estimada"
                                            class="w-full px-2 py-1 border rounded-lg text-center text-sm"
                                            min="{{ date('Y-m-d') }}">
                                    </td>

                                    {{-- Ciudad (Select) --}}
                                    <td class="px-4 py-2 border text-center align-middle">
                                        <select wire:model.live="productos.{{ $index }}.ciudad"
                                            class="w-full px-2 py-1 border rounded-lg text-center text-sm">
                                            <option value="">Seleccione...</option>
                                            @foreach ($ciudades as $ciudad)
                                                <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    {{-- Subtotal --}}
                                    <td class="px-4 py-2 border text-right align-middle font-semibold">
                                        $ {{ number_format(($item['precio'] ?? 0) * $item['cantidad'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-2 border text-center text-gray-500">
                                        No hay productos seleccionados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="6" class="px-4 py-2 border text-right font-bold">SUBTOTAL PRODUCTOS:
                                </td>
                                <td class="px-4 py-2 border text-right font-bold">$
                                    {{ number_format($subtotal_productos, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Resumen de factura -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Resumen de la Orden de Compra</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Columna izquierda -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-3 border-b pb-2">Información de la OC</h3>

                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Proveedor <span
                                        class="text-red-500">*</span></label>
                                <select wire:model="proveedor" class="w-full px-3 py-2 border rounded-lg">
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores_list as $prov)
                                        <option value="{{ $prov->id }}">{{ $prov->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Forma de Pago <span
                                        class="text-red-500">*</span></label>
                                <select wire:model="forma_pago" class="w-full px-3 py-2 border rounded-lg">
                                    <option value="">Seleccione forma de pago</option>
                                    @foreach ($forma_pago_list as $fp)
                                        <option value="{{ $fp->id }}">{{ $fp->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Convenio</label>
                                <select wire:model="convenio" class="w-full px-3 py-2 border rounded-lg">
                                    <option value="">Seleccione un convenio</option>
                                    @foreach ($convenio_list as $c)
                                        <option value="{{ $c->id }}">{{ $c->convenio }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Plazo de Entrega (días)
                                    <span class="text-red-500">*</span></label>
                                <input type="number" wire:model="plazo_entrega"
                                    class="w-full px-3 py-2 border rounded-lg" min="1" max="365">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Cuotas <span
                                        class="text-red-500">*</span></label>
                                <input type="number" wire:model="cuotas" class="w-full px-3 py-2 border rounded-lg"
                                    min="1" max="36">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" wire:model="terceros" class="mr-2">
                                <label class="text-sm font-medium text-gray-700">Incluye terceros</label>
                            </div>
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-3 border-b pb-2">Totales</h3>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center pb-2 border-b">
                                <span class="text-gray-600">Subtotal productos:</span>
                                <span class="font-semibold">$
                                    {{ number_format($subtotal_productos, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Descuentos:</span>
                                <div class="relative w-32">
                                    <span class="absolute left-2 top-1 text-gray-500">$</span>
                                    <input type="number" wire:model.live="descuentos"
                                        class="w-full pl-6 pr-2 py-1 border rounded text-right" step="0.01">
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Impuestos:</span>
                                <div class="relative w-32">
                                    <span class="absolute left-2 top-1 text-gray-500">$</span>
                                    <input type="number" wire:model.live="impuestos"
                                        class="w-full pl-6 pr-2 py-1 border rounded text-right" step="0.01">
                                </div>
                            </div>

                            <div class="flex justify-between items-center pb-2 border-b">
                                <span class="text-gray-600">Base Imponible:</span>
                                <span>$ {{ number_format($base_imponible, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">IVA (19%):</span>
                                <span>$ {{ number_format($monto_iva, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center pt-2 border-t">
                                <span class="text-lg font-bold text-gray-800">MONTO TOTAL:</span>
                                <span class="text-xl font-bold text-blue-600">$
                                    {{ number_format($monto_total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documentos adjuntos -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Documentos Adjuntos</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Factura</label>
                        <input type="text" wire:model="factura" class="w-full px-3 py-2 border rounded-lg"
                            placeholder="Número de factura">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Archivo Factura</label>
                        <input type="file" wire:model="path_factura" class="w-full">
                        <div wire:loading wire:target="path_factura" class="text-sm text-gray-500">Subiendo...</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Archivo Pago</label>
                        <input type="file" wire:model="path_pago" class="w-full">
                        <div wire:loading wire:target="path_pago" class="text-sm text-gray-500">Subiendo...</div>
                    </div>
                </div>
            </div>

            <!-- Observación -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Observación</h2>
                <textarea wire:model="observacion" rows="3" class="w-full px-3 py-2 border rounded-lg"
                    placeholder="Observaciones adicionales..."></textarea>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('orm') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancelar
                </a>
                <button type="submit" wire:loading.attr="disabled"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    <span wire:loading.remove>Crear OC</span>
                    <span wire:loading>Creando...</span>
                </button>
            </div>
        </form>
    </div>
</div>
