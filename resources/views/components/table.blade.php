@props([
    'headers' => [],
    'rows' => [],
    'sortField' => null,
    'sortDirection' => null,
])

<div class="w-full">
    <div class="mb-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar..."
            class="w-full max-w-sm px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500" />
    </div>

    <div class="overflow-x-auto border border-gray-200 rounded-xl">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    @foreach ($headers as $key => $label)
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            @if ($sortField && $sortField === $key)
                                <button wire:click="sortBy('{{ $key }}')"
                                    class="flex items-center gap-1 hover:text-gray-700">
                                    {{ $label }}
                                    <span>
                                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                    </span>
                                </button>
                            @else
                                {{ $label }}
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($rows as $row)
                    <tr class="hover:bg-gray-50">
                        @foreach ($headers as $key => $label)
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ data_get($row, $key) }}
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headers) }}" class="px-6 py-8 text-center text-sm text-gray-500">
                            No hay registros
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if (method_exists($rows, 'links'))
        <div class="mt-4 flex justify-between items-center">
            <span class="text-sm text-gray-600">
                Mostrando {{ $rows->firstItem() ?? 0 }} - {{ $rows->lastItem() ?? 0 }}
                de {{ $rows->total() }}
            </span>
            {{ $rows->links() }}
        </div>
    @endif
</div>
