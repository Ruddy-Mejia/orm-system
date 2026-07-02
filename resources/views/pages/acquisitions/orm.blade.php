<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-6">
                <div class="flex flex-col justify-center">
                    <h1 class="text-2xl font-bold text-gray-800">Listado de ORM</h1>
                    <p class="text-gray-600">Administra y haz el seguimiento de tus requerimientos</p>
                </div>
                <a href="{{ route('create') }}"
                    class=" bg-green-500
                    hover:bg-green-600 text-white font-bold px-4 rounded transition duration-200 inline-flex
                    items-center gap-2">
                    <x-heroicon-s-plus-circle class="w-6 h-6" />
                    <span>Nueva ORM</span>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:acquisitions.orm.orm-list />
            </div>
        </div>
    </div>
</x-app-layout>
