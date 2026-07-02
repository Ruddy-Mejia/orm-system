<div class="container mx-auto px-4 py-8">
    @if ($oc)
        <!-- Header -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold">Orden de Compra: {{ $oc->oc }}</h1>
                <span class="px-3 py-1 rounded text-sm font-semibold {{ $oc->status ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ $oc->status ? 'Activa' : 'Anulada' }}
                </span>
            </div>

            <div class="p-6">
                <!-- Información General -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 mb-8">
                    <div class="bg-slate-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 uppercase font-bold">Número OC</label>
                        <p class="text-lg font-semibold">{{ $oc->oc }}</p>
                    </div>

                    <div class="bg-slate-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 uppercase font-bold">Responsable</label>
                        <p class="text-lg font-semibold">{{ $oc->ormRel->responsableRel->name ?? 'N/A' }}</p>
                    </div>

                    <div class="bg-slate-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 uppercase font-bold">Proveedor</label>
                        <p class="text-lg font-semibold">{{ $oc->proveedorRel->rut . " | " . $oc->proveedorRel->razon_social ?? 'N/A' }}</p>
                    </div>

                    <div class="bg-slate-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 uppercase font-bold">ADN</label>
                        <p class="text-lg font-semibold">{{ $oc->ormRel->adnRel->descripcion ?? 'N/A' }}</p>
                    </div>

                    <div class="bg-slate-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 uppercase font-bold">CDC</label>                        
                        <p class="text-lg font-semibold">{{ $oc->ormRel->cdcRel->descripcion ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="bg-slate-100 p-4 rounded-lg">
                        <label class="text-xs text-gray-500 uppercase font-bold">ORM Asociada</label>
                        <p class="text-lg font-semibold">{{ $oc->ormRel->orm ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Finanzas -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-4 border-b pb-2">Información Financiera</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">Subtotal</label>
                            <p class="text-xl font-bold text-green-700">
                                ${{ number_format($oc->monto_parcial, 0, ',', '.') }}</p>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">IVA (19%)</label>
                            <p class="text-xl font-bold text-blue-700">
                                ${{ number_format($oc->monto_iva, 0, ',', '.') }}</p>
                        </div>

                        <div class="bg-purple-50 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">Monto Total</label>
                            <p class="text-xl font-bold text-purple-700">
                                ${{ number_format($oc->monto_total, 0, ',', '.') }}</p>
                        </div>

                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">Presupuesto</label>
                            <p class="text-xl font-bold text-yellow-700">
                                ${{ number_format($oc->presupuesto ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <div class="bg-red-50 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">Descuentos</label>
                            <p class="text-lg font-semibold text-red-700">
                                ${{ number_format($oc->descuentos, 0, ',', '.') }}</p>
                        </div>

                        <div class="bg-orange-50 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">Impuestos</label>
                            <p class="text-lg font-semibold {{ $oc->impuestos >= 0 ? 'text-orange-700' : 'text-red-600' }}">
                                ${{ number_format($oc->impuestos, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="bg-slate-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">Forma de Pago</label>
                            <p class="text-lg font-semibold">{{ $oc->formapagoRel->descripcion ?? 'N/A' }}</p>
                        </div>

                        <div class="bg-slate-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">Cuotas</label>
                            <p class="text-lg font-semibold">{{ $oc->cuotas }}</p>
                        </div>
                    </div>
                </div>

                <!-- Detalles adicionales -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-4 border-b pb-2">Detalles de la Orden</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div class="bg-slate-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">Plazo de Entrega</label>
                            <p class="text-lg font-semibold">{{ $oc->plazo_entrega }} días</p>
                        </div>

                        <div class="bg-slate-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">Convenio</label>
                            <p class="text-lg font-semibold">{{ $oc->convenioRel->convenio ?? 'N/A' }}</p>
                        </div>

                        <div class="bg-slate-100 p-4 rounded-lg">
                            <label class="text-xs text-gray-500 uppercase font-bold">Factura</label>
                            <p class="text-lg font-semibold">{{ $oc->factura ?? 'No registrada' }}</p>
                        </div>

                        @if ($oc->terceros)
                            <div class="bg-slate-100 p-4 rounded-lg">
                                <label class="text-xs text-gray-500 uppercase font-bold">Terceros</label>
                                <p class="text-lg font-semibold">
                                    <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">
                                        Incluye terceros
                                    </span>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Productos de la OC -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-4 border-b pb-2">Productos de la Orden de Compra</h2>
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
                                @forelse($productos as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">
                                            {{ $item->productoRel->nombre ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-2 border text-center">
                                            {{ $item->cantidad }}
                                        </td>
                                        <td class="px-4 py-2 border text-center">
                                            {{ $item->productoRel->unidad ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-2 border text-right">
                                            $ {{ number_format($item->costo ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-2 border text-right">
                                            $ {{ number_format(($item->costo ?? 0) * $item->cantidad, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-2 border text-center text-gray-500">
                                            No hay productos asociados a esta OC
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="4" class="px-4 py-2 border text-right font-bold">Subtotal:</td>
                                    <td class="px-4 py-2 border text-right font-bold">
                                        $ {{ number_format($productos->sum(function($item) { 
                                            return ($item->costo ?? 0) * $item->cantidad; 
                                        }), 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Autorizaciones -->
                @php 
                    $autorizaciones = is_array($oc->autorizaciones) ? $oc->autorizaciones : json_decode($oc->autorizaciones, true);
                    $autorizaciones = $autorizaciones ?? [0, 0, 0];
                    $keys = ['Gerencia', 'Jefe de costos', 'Adquisiciones'];
                @endphp
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-4 border-b pb-2">Autorizaciones</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($autorizaciones as $index => $valor)
                            <div class="flex items-center gap-2 px-4 py-2 rounded-lg {{ $valor ? 'bg-green-100' : 'bg-red-100' }}">
                                <span class="font-semibold">{{ $keys[$index] ?? 'Nivel ' . ($index + 1) }}:</span>
                                <span class="{{ $valor ? 'text-green-700' : 'text-red-700' }}">
                                    {{ $valor ? 'Autorizado' : 'Pendiente' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Observación -->
                @if ($oc->observacion)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold mb-4 border-b pb-2">Observación</h2>
                        <div class="bg-slate-100 p-4 rounded-lg">
                            <p class="text-gray-700">{{ $oc->observacion }}</p>
                        </div>
                    </div>
                @endif

                <!-- Archivos -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-4 border-b pb-2">Documentos Adjuntos</h2>
                    <div class="flex gap-2">
                        @if ($oc->path_factura)
                            <a href="{{ Storage::url($oc->path_factura) }}" target="_blank"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Ver Factura
                            </a>
                        @else
                            <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded">Sin factura</span>
                        @endif

                        @if ($oc->path_pago)
                            <a href="{{ Storage::url($oc->path_pago) }}" target="_blank"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Ver Comprobante de Pago
                            </a>
                        @else
                            <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded">Sin comprobante de pago</span>
                        @endif
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end gap-2 pt-4 border-t">
                    <a href="{{ url()->previous() }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 flex flex-row items-center gap-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver
                    </a>
                    <a class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 flex flex-row items-center gap-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        Editar
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
            <p class="font-bold">Error</p>
            <p>No se encontró la Orden de Compra #{{ $ocId }}</p>
            <a href="{{ url()->previous() }}"
                class="mt-2 inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                ← Volver
            </a>
        </div>
    @endif
</div>