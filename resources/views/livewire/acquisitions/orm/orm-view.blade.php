<div class="container mx-auto px-4 py-8">
    @if ($orm)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-800 text-gray-100 px-6 py-4 flex justify-between items-center">
                <h2 class="text-2xl font-bold">Detalles del ORM #{{ $orm->orm }}</h2>
                <div class="flex space-x-2">
                    <button onclick="window.history.back()"
                        class="bg-slate-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                        <x-heroicon-s-arrow-left class="w-4 h-4" />
                        <span>Volver</span>
                    </button>

                    <button
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                        <x-heroicon-s-pencil class="w-4 h-4" />
                        <span>Editar</span>
                    </button>

                    <a href="{{ route('orm.print', $orm->orm) }}" target="_blank"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                        <x-heroicon-s-printer class="w-4 h-4" />
                        <span>Imprimir</span>
                    </a>

                </div>
            </div>

            <div class="p-6">
                <div class="mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-slate-100 p-3 rounded md:col-span-2 lg:col-span-2">
                            <span class="font-bold text-gray-700">Descripción:</span>
                            <p class="text-gray-900">
                                {{ ucfirst(mb_convert_case($orm->descripcion, MB_CASE_LOWER, 'UTF-8')) }}</p>
                        </div>

                        <div class="bg-slate-100 p-3 rounded">
                            <span class="font-bold text-gray-700">OTI/OTM/CDC:</span>
                            <p class="text-gray-900">{{ $orm->cdcRel->cdc ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-slate-100 p-3 rounded">
                            <span class="font-bold text-gray-700">Descripción CDC:</span>
                            <p class="text-gray-900">
                                {{ mb_convert_case($orm->cdcRel->descripcion, MB_CASE_TITLE, 'UTF-8') }}
                            </p>
                        </div>
                        <div class="bg-slate-100 p-3 rounded">
                            <span class="font-bold text-gray-700">Área de Negocio:</span>
                            <p class="text-gray-900">{{ $orm->adnRel->descripcion }}</p>
                        </div>
                        <div class="bg-slate-100 p-3 rounded">
                            <span class="font-bold text-gray-700">Sitio:</span>
                            <p class="text-gray-900">{{ $orm->sitioRel->descripcion }}</p>
                        </div>
                        <div class="bg-slate-100 p-3 rounded">
                            <span class="font-bold text-gray-700">Tipo ORM:</span>
                            <p class="text-gray-900">{{ $orm->tipo }}</p>
                        </div>
                        <div class="bg-slate-100 p-3 rounded">
                            <span class="font-bold text-gray-700">Fecha de solicitud:</span>
                            <p class="text-gray-900">
                                {{ \Carbon\Carbon::parse($orm->created_at)->format('d/m/Y') ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="bg-slate-100 p-3 rounded">
                            <span class="font-bold text-gray-700">Solicitante</span>
                            <p class="text-gray-900">{{ $orm->responsableRel->name }}</p>
                        </div>

                        @if ($orm->patente)
                            <div class="bg-slate-100 p-3 rounded">
                                <span class="font-bold text-gray-700">Patente</span>
                                <p class="text-gray-900">{{ $orm->patente }}</p>
                            </div>
                        @endif
                        @if (!true)
                            <div class="bg-slate-100 p-3 rounded">
                                <span class="font-bold text-gray-700">Comprador</span>
                                <p class="text-gray-900">{{ $orm->buyer ? $orm->buyer : 'Sin asignar' }}</p>
                            </div>
                        @else
                            <div class="bg-slate-100 p-3 rounded">
                                <span class="font-bold text-gray-700">Comprador</span>
                                <select wire:model.live="buyerId" wire:change="updateBuyer" name="buyer"
                                    class="w-full mt-1 px-3 py-2 border rounded-lg text-sm">
                                    <option value="" disabled>Seleccione un comprador</option>
                                    <option value="2" {{ $orm->comprador == 2 ? 'selected' : '' }}>
                                        {{ 'Sin asignar' }} {{ $orm->comprador == 2 ? ' (Actual)' : '' }}</option>

                                    @foreach ($buyers as $buyer)
                                        <option value="{{ $buyer->id }}">
                                            {{ $buyer->name }}
                                            @if ($orm->comprador == $buyer->id)
                                                (Actual)
                                            @endif
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        @endif
                        <div class="bg-slate-100 p-3 rounded flex flex-row gap-4 justify-between">
                            <div>
                                <span class="font-bold text-gray-700">¿Está siendo atendida?</span>
                                <p class="text-gray-900">
                                    <span
                                        class="px-2 py-1 rounded text-sm {{ $orm->status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $orm->status ? 'Sí' : 'No' }}
                                    </span>
                                </p>
                            </div>
                            @if (!$orm->status)
                                <button wire:click="askReview({{ $orm->id }})"
                                    class="bg-indigo-200 hover:bg-indigo-300 p-3 rounded my-2 ">Solicitar
                                    revisión</button>
                            @endif
                        </div>
                        @if (!true)
                            <div class="bg-slate-100 p-3 rounded">
                                <span class="font-bold text-gray-700">Prioridad</span>
                                <p class="text-gray-900">{{ $orm->prioridad }}
                                </p>
                            </div>
                        @else
                            <div class="bg-slate-100 p-3 rounded flex flex-row gap-4 justify-between">
                                <div>
                                    <span class="font-bold text-gray-700">Prioridad</span>
                                    <p class="text-gray-900">
                                        {{ ucfirst($orm->prioridad) }}
                                    </p>
                                </div>
                                <button wire:click="switchPriority({{ $orm->id }})"
                                    class="bg-orange-200 hover:bg-orange-300 px-2 rounded my-2">Alternar
                                    prioridad</button>
                            </div>
                        @endif
                        <div class="bg-slate-100 p-3 rounded flex flex-row gap-4 justify-between">
                            <div>
                                <span class="font-bold text-gray-700">Archivo adjunto</span>
                                <p class="text-gray-900">
                                    <span
                                        class="px-2 py-1 rounded text-sm {{ $orm->archivo ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $orm->archivo ? 'Sí' : 'No' }}
                                    </span>
                                </p>
                            </div>
                            @if ($orm->archivo)
                                <button wire:click="verArchivo({{ $orm->id }})"
                                    class="bg-green-200 hover:bg-green-300 p-3 rounded my-2 ">
                                    Ver Archivo
                                </button>
                                @if ($modalAbierto)
                                    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
                                        role="dialog" aria-modal="true">
                                        <div
                                            class="flex items-center justify-center min-w-full min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                            <!-- Fondo oscuro -->
                                            <div class="fixed inset-0 transition-opacity bg-slate-1000 bg-opacity-75"
                                                wire:click="cerrarModal"></div>

                                            <!-- Centrar modal -->
                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                aria-hidden="true">&#8203;</span>

                                            <!-- Contenido del modal -->
                                            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full"
                                                style="width: 90%; max-width: 1200px;">

                                                <!-- Body -->
                                                <div class="px-6 py-4">
                                                    @if ($archivoUrl)
                                                        @php
                                                            $extension = strtolower(
                                                                pathinfo($archivoUrl, PATHINFO_EXTENSION),
                                                            );
                                                            $tiposImagen = [
                                                                'jpg',
                                                                'jpeg',
                                                                'png',
                                                                'gif',
                                                                'webp',
                                                                'bmp',
                                                                'svg',
                                                            ];
                                                        @endphp

                                                        <div class="text-center">
                                                            <!-- Imágenes -->
                                                            @if (in_array($extension, $tiposImagen))
                                                                <img src="{{ $archivoUrl }}" alt="Archivo"
                                                                    class="max-w-full h-auto mx-auto rounded-lg shadow-lg">

                                                                <!-- PDF -->
                                                            @elseif($extension == 'pdf')
                                                                <embed src="{{ $archivoUrl }}" type="application/pdf"
                                                                    width="100%" height="600px"
                                                                    class="rounded-lg shadow-lg">
                                                            @else
                                                                <div class="p-8 text-center bg-gray-100 rounded-lg">
                                                                    <svg class="w-16 h-16 mx-auto text-gray-400"
                                                                        fill="none" stroke="currentColor"
                                                                        viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                        </path>
                                                                    </svg>
                                                                    <p class="mt-4 text-gray-600">Este tipo de archivo
                                                                        no se puede previsualizar</p>
                                                                    <p class="text-sm text-gray-500">Nombre:
                                                                        {{ basename($archivoUrl) }}</p>
                                                                    <p class="text-sm text-gray-500">Extensión:
                                                                        {{ strtoupper($extension) }}</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="p-8 text-center bg-gray-100 rounded-lg">
                                                            <svg class="w-16 h-16 mx-auto text-gray-400"
                                                                fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                </path>
                                                            </svg>
                                                            <p class="mt-4 text-gray-600">No hay archivo disponible</p>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Footer -->
                                                <div
                                                    class="px-6 py-3 bg-slate-100 border-t flex justify-end space-x-3">
                                                    <button wire:click="cerrarModal"
                                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-slate-100">
                                                        Cerrar
                                                    </button>

                                                    @if ($archivoUrl)
                                                        <a href="{{ $archivoUrl }}" download
                                                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                                            Descargar Archivo
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        {{-- <img src="{{ url('storage/' . $orm->archivo) }}" alt="Archivo"> --}}
                    </div>


                </div>

                <div>
                    <h3 class="text-xl font-semibold text-gray-800 border-b-2 border-gray-300 pb-2 mb-4">
                        Detalle de Items
                    </h3>
                    <div class="overflow-x-auto">
                        <div class="container mx-auto px-4 py-8">

                            <div>
                                <div class="flex justify-between items-center border-b-2 border-gray-300 pb-2 mb-4">
                                    <h3 class="text-xl font-semibold text-gray-800">Detalle de Items</h3>
                                    <div class="flex gap-2 items-center">

                                        @if ($productosSeleccionadosCount > 0)
                                            <button wire:click="generarOC" wire:loading.attr="disabled"
                                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                                                <span wire:loading.remove>Generar OC
                                                    ({{ $productosSeleccionadosCount }})</span>
                                                <span wire:loading>Generando...</span>
                                            </button>
                                        @else
                                            <button disabled
                                                class="disabled:bg-blue-200 text-white font-bold py-2 px-4 rounded transition duration-200 inline-flex items-center gap-2">
                                                <span>Generar OC</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border border-gray-300 text-sm text-center">
                                        <thead>
                                            <tr class="bg-gray-200 text-gray-700">

                                                <th class="px-4 py-2 border">Cant</th>
                                                <th class="px-4 py-2 border">Und</th>
                                                <th class="px-4 py-2 border">Descripción</th>
                                                <th class="px-4 py-2 border">Proc. Costos</th>
                                                <th class="px-4 py-2 border">Bodega</th>
                                                <th class="px-4 py-2 border">Ciudad</th>
                                                <th class="px-4 py-2 border">Fecha Est. llegada</th>
                                                <th class="px-4 py-2 border">Fecha Recepción</th>
                                                <th class="px-4 py-2 border">Recepción</th>
                                                {{-- <th class="px-4 py-2 border">Rel. OC</th> --}}
                                                <th class="px-4 py-2 border w-10">
                                                    <input type="checkbox" wire:model.live="seleccionarTodos"
                                                        @if ($itemsSinOC == 0) disabled @endif
                                                        class="rounded border-gray-300">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($orm->detormRel as $index => $item)
                                                <tr class="hover:bg-slate-100">

                                                    <td class="px-4 py-2 border text-right">{{ $item->cantidad }}</td>
                                                    <td class="px-4 py-2 border">
                                                        {{ $item->productoRel->unidad ?? 'N/A' }}</td>
                                                    <td class="px-2 py-2 border text-left text-sm">
                                                        {{ $item->detalle ? $item->productoRel->nombre . ' (' . $item->detalle . ')' : $item->productoRel->nombre }}
                                                    </td>
                                                    <td class="px-4 py-2 border text-center">
                                                        <select
                                                            wire:change="toggleBool({{ $item['id'] }}, 'procesado', $event.target.value)"
                                                            class="w-full px-2 py-1 border rounded-lg text-xs font-semibold 
                                                            @if ($item['procesado']) bg-green-100 text-green-800 border-green-300 
                                                            @else bg-red-100 text-red-800 border-red-300 @endif
                                                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                            <option value="1"
                                                                {{ $item['procesado'] ? 'selected' : '' }}>PROCESADO
                                                            </option>
                                                            <option value="0"
                                                                {{ !$item['procesado'] ? 'selected' : '' }}>NO
                                                                PROCESADO</option>
                                                        </select>
                                                    </td>

                                                    <td class="px-4 py-2 border text-center">
                                                        <select
                                                            wire:change="toggleBool({{ $item['id'] }}, 'bodega', $event.target.value)"
                                                            class="w-full px-2 py-1 border rounded-lg text-xs font-semibold
                                                            @if ($item['bodega']) bg-blue-100 text-blue-800 border-blue-300 
                                                            @else bg-gray-100 text-gray-800 border-gray-300 @endif
                                                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                            <option value="1"
                                                                {{ $item['bodega'] ? 'selected' : '' }}>En stock
                                                            </option>
                                                            <option value="0"
                                                                {{ !$item['bodega'] ? 'selected' : '' }}>Sin stock
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td class="px-4 py-2 border">
                                                        {{ $item->ciudadRel->nombre ?? 'S/S' }}</td>
                                                    <td class="px-4 py-2 border text-center">
                                                        {{ optional($item->f_estimada)->format('d/m/y') ?? 'N/A' }}
                                                    </td>
                                                    <td class="px-4 py-2 border text-center">
                                                        {{ optional($item->f_recepcion)->format('d/m/y') ?? 'N/A' }}
                                                    </td>
                                                    @if ($item->recepcion == 'total')
                                                        <td class="border text-xs bg-green-100 text-green-800">
                                                            {{ ucfirst($item->recepcion) }}</td>
                                                    @elseif($item->recepcion == 'parcial')
                                                        <td class="border text-xs bg-yellow-100 text-yellow-800">
                                                            Parcial: {{ $item->cantidad_recepcion }}</td>
                                                    @else
                                                        <td class="border text-xs bg-red-100 text-red-800">N/A</td>
                                                    @endif
                                                    <td class="px-2 py-2 border text-xs">
                                                        @if ($item->ocRel)
                                                            <a class="text-blue-600 hover:underline"
                                                                href="{{ route('oc.view', $item->ocRel->oc) }}">
                                                                {{ $item->ocRel->oc }}
                                                            </a>
                                                        @else
                                                            <input type="checkbox"
                                                                wire:model.live="productosSeleccionados"
                                                                value="{{ $item->id }}"
                                                                class="rounded border-gray-300">
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="12"
                                                        class="px-4 py-2 border text-center text-gray-500">
                                                        No hay items disponibles
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <!-- Observaciones... (se mantiene igual) -->
                                </div>
                            </div>
                        </div>
                        <div class="py-4 grid grid-cols-2 gap-4 text-sm">
                            @if ($orm->obs_orm)
                                <div class="bg-gray-200 rounded-xl p-2">
                                    <p class="font-bold">Observación ORM: </p>
                                    <p>{{ $orm->obs_orm }}</p>
                                </div>
                            @endif
                            @if ($orm->obs_costos)
                                <div class="bg-gray-200 rounded-xl p-2">
                                    <p class="font-bold">Observación costos: </p>
                                    <p>{{ $orm->obs_costos }}</p>
                                </div>
                            @endif
                            @if ($orm->obs_bodega)
                                <div class="bg-gray-200 rounded-xl p-2">
                                    <p class="font-bold">Observación bodega: </p>
                                    <p>{{ $orm->obs_bodega }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="p-4 m-24 text-center">
            <x-heroicon-s-exclamation-circle class="text-red-600 w-24 mx-auto" />
            <h1 class="font-bold text-4xl pt-4">No se encontró la ORM</h1>
        </div>
    @endif
</div>
