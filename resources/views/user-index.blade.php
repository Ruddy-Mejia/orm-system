<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Usuarios</h2>
            <p class="text-sm text-gray-600">Lista de usuarios registrados</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <x-table 
                :headers="$headers"
                :rows="$users"
                :sort-field="$sortField"
                :sort-direction="$sortDirection"
            />
        </div>
    </div>
</div>