<div>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Crear Nueva ORM</h1>
            <p class="text-gray-600">Complete el formulario para generar una nueva Orden de Requerimiento de Materiales
            </p>
        </div>

        {{-- Mensajes --}}
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="save" enctype="multipart/form-data">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gray-800 text-white px-6 py-4">
                    <h2 class="text-xl font-bold">Formulario de Registro ORM</h2>
                </div>

                <div class="p-6">
                    {{-- Grid principal --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Solicitante (readonly) --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Solicitante</label>
                            <input type="text" value="{{ Auth::user()->user ?? Auth::user()->name }}" readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100">
                        </div>

                        {{-- Fecha (readonly) --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Solicitud</label>
                            <input type="text" value="{{ now()->format('d/m/Y') }}" readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100">
                        </div>

                        {{-- Descripción --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Descripción de la ORM <span
                                    class="text-red-500">*</span></label>
                            <textarea wire:model="descrip_orm" rows="3" placeholder="Describa el motivo de la solicitud..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                            @error('descrip_orm')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Área de Negocio --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Área de Negocio <span
                                    class="text-red-500">*</span></label>
                            <select wire:model="id_adn"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Seleccione un área</option>
                                @foreach ($adnList as $adn)
                                    <option value="{{ $adn->id }}">{{ $adn->descripcion }}</option>
                                @endforeach
                            </select>
                            @error('id_adn')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Sitio --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Sitio de entrega<span
                                    class="text-red-500">*</span></label>
                            <select wire:model="id_sitio"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Seleccione un sitio</option>
                                @foreach ($sitioList as $sitio)
                                    <option value="{{ $sitio->id }}">{{ $sitio->descripcion }}</option>
                                @endforeach
                            </select>
                            @error('id_sitio')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Tipo ORM --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tipo ORM <span
                                    class="text-red-500">*</span></label>
                            <select wire:model="tipo"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled>Seleccione un tipo</option>
                                <option value="Administrativa">Administrativa</option>
                                <option value="Faena">Faena</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="OTI">OTI</option>
                            </select>
                            @error('tipo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-bold text-gray-700 mb-2">CDC <span
                                    class="text-red-500">*</span></label>

                            <input type="text" wire:model.live="cdc_busqueda" wire:blur="cerrarSugerenciasCdc"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 uppercase"
                                placeholder="Buscar centro de costo (escriba al menos 2 caracteres)" autocomplete="off">

                            {{-- Sugerencias --}}
                            @if ($mostrar_sugerencias_cdc)
                                <div
                                    class="absolute z-50 w-full bg-white border border-gray-300 rounded-lg shadow-lg mt-1 max-h-60 overflow-y-auto">
                                    @forelse ($cdc_sugerencias as $cdc)
                                        <div wire:click="seleccionarCdc({{ $cdc->id }})"
                                            class="px-4 py-2 hover:bg-blue-100 cursor-pointer border-b border-gray-100 last:border-b-0">
                                            <div class="font-medium">{{ $cdc->cdc }}</div>
                                            <div class="text-sm text-gray-600">
                                                {{ $cdc->descripcion }}
                                            </div>
                                        </div>
                                    @empty
                                        <div
                                            class="px-4 py-2 hover:bg-blue-100 cursor-pointer border-b border-gray-100 last:border-b-0">
                                            <div class="font-medium">{{ 'No se encontraron resultados' }}</div>
                                        </div>
                                    @endforelse
                                </div>
                            @endif

                            @error('cdc_busqueda')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Descripción CDC (readonly) --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Descripción CDC</label>
                            <input type="text" value="{{ Str::ucfirst($descripcion) }}" readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-xs">
                        </div>

                        {{-- Patente --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Patente (opcional)</label>
                            <input type="text" wire:model="patente" placeholder="AB-CD-12"
                                style="text-transform: uppercase;"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                maxlength="8">
                            @error('patente')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Servicio de terceros</label>
                            <input type="checkbox" wire:model="serv3ros" id="serv3ros"
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="serv3ros" class="ml-2 text-sm text-gray-700">
                                Sí, este requerimiento involucra un servicio externo
                            </label>
                        </div>

                        {{-- Adjuntar documento --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Adjuntar documento
                                (opcional)</label>
                            <input type="file" wire:model="archivo_orm"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.tif,.tiff">
                            @error('archivo_orm')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">PDF, Word, Excel, imágenes (máx. 5MB)</p>
                        </div>
                    </div>

                    {{-- Sección de Productos --}}
                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-gray-800 border-b-2 border-gray-300 pb-2 mb-4">
                            Detalle de Materiales <span class="text-red-500">*</span>
                        </h3>

                        {{-- Contenedor del autocomplete Producto --}}                        
                        <div class="relative mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Buscar Producto</label>

                            <input type="text" wire:model.live.debounce.300ms="producto_busqueda"
                                wire:blur="cerrarSugerenciasProducto" autocomplete="off"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                placeholder="Buscar producto (mínimo 3 caracteres)">

                            {{-- Sugerencias --}}
                            @if ($mostrar_sugerencias)
                                <div
                                    class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg shadow-lg mt-1 max-h-60 overflow-y-auto">
                                    @forelse ($productos_sugeridos as $producto)
                                        <div wire:key="prod-{{ $producto->id }}"
                                            wire:click="seleccionarProducto({{ $producto->id }})"
                                            class="px-4 py-2 hover:bg-blue-100 cursor-pointer border-b border-gray-100 last:border-b-0">
                                            <div class="font-medium">{{ $producto->nombre }}</div>
                                            <div class="text-sm text-gray-600">Unidad:
                                                {{ $producto->unidad ?? 'N/A' }}</div>
                                        </div>
                                    @empty
                                        <div
                                            class="px-4 py-2 hover:bg-blue-100 cursor-pointer border-b border-gray-100 last:border-b-0">
                                            <div class="font-medium">{{ "No se encontraron productos" }}</div>
                                        </div>
                                    @endforelse
                                </div>
                            @endif
                        </div>

                        {{-- Tabla de productos agregados --}}
                        @if (count($items) > 0)
                            <div class="overflow-x-auto mt-4">
                                <table class="min-w-full bg-white border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-200 text-gray-700">
                                            <th class="px-4 py-2 border text-left">Producto</th>
                                            <th class="px-4 py-2 border text-left">Especificaciones / Observaciones
                                            </th>
                                            <th class="px-4 py-2 border text-center">Unidad</th>
                                            <th class="px-4 py-2 border text-center">Cantidad</th>
                                            <th class="px-4 py-2 border text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $index => $item)
                                            <tr class="hover:bg-gray-50"
                                                wire:key="item-{{ $item['id'] }}-{{ $index }}">
                                                {{-- Producto --}}
                                                <td class="px-4 py-2 border align-top">
                                                    <div class="font-medium text-gray-800">{{ $item['name'] }}</div>
                                                    <div class="text-xs text-gray-500">ID: {{ $item['id'] }}</div>
                                                </td>

                                                {{-- Especificaciones / Extra --}}
                                                <td class="px-4 py-2 border">
                                                    <textarea wire:model.blur="items.{{ $index }}.extra" rows="2"
                                                        class="w-full px-2 py-1 border rounded focus:ring-2 focus:ring-blue-500 text-sm"
                                                        placeholder="Especificaciones técnicas, marca, modelo, color, etc..."></textarea>
                                                </td>

                                                {{-- Unidad --}}
                                                <td class="px-4 py-2 border text-center align-middle">
                                                    {{ $item['unit'] }}
                                                </td>

                                                {{-- Cantidad --}}
                                                <td class="px-4 py-2 border text-center align-middle">
                                                    <input type="number" step="0.01" min="0.01"
                                                        wire:model.blur="items.{{ $index }}.cantidad"
                                                        class="w-24 px-2 py-1 border rounded text-center">
                                                </td>

                                                {{-- Acciones --}}
                                                <td class="px-4 py-2 border text-center align-middle">
                                                    <button type="button"
                                                        wire:click="eliminarItem({{ $index }})"
                                                        class="text-red-600 hover:text-red-800 transition"
                                                        title="Eliminar producto">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-gray-50">
                                        <tr>
                                            <td colspan="5" class="px-4 py-2 text-right text-sm text-gray-600">
                                                Total de productos: {{ count($items) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            @error('items')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded mt-4">
                                No hay productos agregados. Busque y agregue productos utilizando el campo superior.
                            </div>
                        @endif
                    </div>

                    {{-- Observaciones --}}
                    <div class="mt-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Observaciones para Compras</label>
                        <textarea wire:model="observacion_orm" rows="4"
                            placeholder="MARCAS PREFERIDAS, TIPO DE URGENCIA, ESPECIFICACIONES TÉCNICAS, ETC."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 uppercase"
                            style="text-transform: uppercase;"></textarea>
                        @error('observacion_orm')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Footer con botones --}}
                <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">
                    <a href="{{ route('orm.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded transition">
                        Cancelar
                    </a>
                    <button type="submit" wire:loading.attr="disabled"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition disabled:opacity-50">
                        <span wire:loading.remove>Completar Registro</span>
                        <span wire:loading>Generando ORM...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
