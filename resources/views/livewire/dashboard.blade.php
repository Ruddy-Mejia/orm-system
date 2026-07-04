{{-- resources/views/livewire/dashboard.blade.php --}}

<div>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                    <p class="text-gray-600">Resumen general del sistema</p>
                </div>
            </div>

            {{-- Cards de resumen --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Productos</p>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalProductos) }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <i class="fas fa-boxes text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Bodegas</p>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalBodegas) }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <i class="fas fa-warehouse text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total ORM</p>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalOrm) }}</p>
                            <p class="text-xs text-gray-400">Monto total: ${{ number_format($montoTotalOrm, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-3">
                            <i class="fas fa-file-alt text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total OC</p>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalOc) }}</p>
                            <p class="text-xs text-gray-400">Monto total: ${{ number_format($montoTotalOc, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-yellow-100 rounded-full p-3">
                            <i class="fas fa-shopping-cart text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cards adicionales --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Proveedores</p>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalProveedores) }}</p>
                        </div>
                        <div class="bg-indigo-100 rounded-full p-3">
                            <i class="fas fa-truck text-indigo-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Categorías</p>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalCategorias) }}</p>
                        </div>
                        <div class="bg-pink-100 rounded-full p-3">
                            <i class="fas fa-tags text-pink-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Promedio OC</p>
                            <p class="text-2xl font-bold text-gray-800">${{ number_format($promedioOc, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-teal-100 rounded-full p-3">
                            <i class="fas fa-calculator text-teal-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Movimientos Totales</p>
                            <p class="text-2xl font-bold text-gray-800">{{ array_sum($movimientosPorTipo) }}</p>
                        </div>
                        <div class="bg-orange-100 rounded-full p-3">
                            <i class="fas fa-exchange-alt text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Gráficos principales --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Movimientos por Tipo</h3>
                    <div style="position: relative; height: 250px; width: 100%;">
                        <canvas id="movimientosChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Productos por Bodega</h3>
                    <div style="position: relative; height: 250px; width: 100%;">
                        <canvas id="bodegasChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Gráfico de tendencia --}}
            <div class="grid grid-cols-1 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Evolución Mensual</h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 mb-2">Movimientos</p>
                            <div style="position: relative; height: 200px; width: 100%;">
                                <canvas id="tendenciaChart"></canvas>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-2">Monto OC ($)</p>
                            <div style="position: relative; height: 200px; width: 100%;">
                                <canvas id="ocChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Gráficos secundarios --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Estado de Órdenes de Compra</h3>
                    <div style="position: relative; height: 250px; width: 100%;">
                        <canvas id="ocStatusChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Estado de ORM</h3>
                    <div style="position: relative; height: 250px; width: 100%;">
                        <canvas id="ormStatusChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Top proveedores y productos --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Top 5 Proveedores</h3>
                    <div class="space-y-3">
                        @forelse($topProveedores as $proveedor)
                            <div>
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium text-gray-700">{{ $proveedor['nombre'] }}</span>
                                    <span class="text-gray-600">${{ number_format($proveedor['total_monto'], 0, ',', '.') }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    @php
                                        $maxMonto = max(array_column($topProveedores, 'total_monto'));
                                        $porcentaje = $maxMonto > 0 ? ($proveedor['total_monto'] / $maxMonto) * 100 : 0;
                                    @endphp
                                    <div class="bg-blue-600 rounded-full h-2" style="width: {{ $porcentaje }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No hay datos de proveedores</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Top 10 Productos Más Movidos</h3>
                    <div class="space-y-3">
                        @forelse($topProductos as $producto)
                            <div>
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium text-gray-700">{{ $producto['nombre'] }}</span>
                                    <span class="text-gray-600">{{ number_format($producto['total_movido']) }} unidades</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    @php
                                        $maxMovido = max(array_column($topProductos, 'total_movido'));
                                        $porcentaje = $maxMovido > 0 ? ($producto['total_movido'] / $maxMovido) * 100 : 0;
                                    @endphp
                                    <div class="bg-green-600 rounded-full h-2" style="width: {{ $porcentaje }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No hay datos de productos</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Productos por categoría --}}
            <div class="grid grid-cols-1 gap-6">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Productos por Categoría</h3>
                    <div style="position: relative; height: 250px; width: 100%;">
                        <canvas id="categoriaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var graficasInicializadas = false;
    var charts = {};
    var dashboardInterval = null;

    function destruirGraficas() {
        for (var key in charts) {
            if (charts[key]) {
                try {
                    charts[key].destroy();
                } catch(e) {}
                charts[key] = null;
            }
        }
        charts = {};
        graficasInicializadas = false;
    }

    function esperarElementos() {
        const canvas = {
            movimientos: document.getElementById('movimientosChart'),
            bodegas: document.getElementById('bodegasChart'),
            ocStatus: document.getElementById('ocStatusChart'),
            ormStatus: document.getElementById('ormStatusChart'),
            tendencia: document.getElementById('tendenciaChart'),
            oc: document.getElementById('ocChart'),
            categoria: document.getElementById('categoriaChart')
        };
        
        const existentes = Object.values(canvas).filter(el => el !== null);
        
        if (existentes.length === 7) {
            if (graficasInicializadas) {
                destruirGraficas();
            }
            iniciarGraficas(canvas);
            return true;
        }
        return false;
    }

    function iniciarGraficas(canvas) {
        if (typeof Chart === 'undefined') {
            console.warn('Chart.js no está cargado');
            return;
        }

        try {
            // 1. MOVIMIENTOS POR TIPO
            if (canvas.movimientos) {
                const data = [
                    {{ $movimientosPorTipo['ingreso'] ?? 0 }},
                    {{ $movimientosPorTipo['egreso'] ?? 0 }},
                    {{ ($movimientosPorTipo['traspaso_salida'] ?? 0) + ($movimientosPorTipo['traspaso_entrada'] ?? 0) }}
                ];
                
                if (data.some(v => v > 0)) {
                    charts.movimientos = new Chart(canvas.movimientos.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: ['Ingresos', 'Egresos', 'Traspasos'],
                            datasets: [{
                                data: data,
                                backgroundColor: ['#10b981', '#ef4444', '#3b82f6'],
                                borderWidth: 2,
                                borderColor: '#ffffff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 20,
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                }
                            },
                            cutout: '60%'
                        }
                    });
                }
            }

            // 2. PRODUCTOS POR BODEGA
            if (canvas.bodegas) {
                const labels = {!! json_encode($bodegasLabels) !!};
                const data = {!! json_encode($bodegasData) !!};
                
                if (data.length > 0 && data.some(v => v > 0)) {
                    charts.bodegas = new Chart(canvas.bodegas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Productos en stock',
                                data: data,
                                backgroundColor: '#3b82f6',
                                borderRadius: 5,
                                borderColor: '#2563eb',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                }
            }

            // 3. ESTADO DE OC
            if (canvas.ocStatus) {
                const labels = {!! json_encode(array_keys($ocPorStatus)) !!};
                const data = {!! json_encode(array_values($ocPorStatus)) !!};
                
                if (data.length > 0 && data.some(v => v > 0)) {
                    charts.ocStatus = new Chart(canvas.ocStatus.getContext('2d'), {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#3b82f6', '#8b5cf6', '#ec4899'],
                                borderWidth: 2,
                                borderColor: '#ffffff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 20,
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                }
                            },
                            cutout: '50%'
                        }
                    });
                }
            }

            // 4. ESTADO DE ORM
            if (canvas.ormStatus) {
                const labels = {!! json_encode(array_keys($ormPorStatus)) !!};
                const data = {!! json_encode(array_values($ormPorStatus)) !!};
                
                if (data.length > 0 && data.some(v => v > 0)) {
                    charts.ormStatus = new Chart(canvas.ormStatus.getContext('2d'), {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#3b82f6', '#8b5cf6', '#ec4899'],
                                borderWidth: 2,
                                borderColor: '#ffffff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 20,
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                }
                            },
                            cutout: '50%'
                        }
                    });
                }
            }

            // 5. TENDENCIA
            if (canvas.tendencia) {
                const labels = {!! json_encode($mesesLabels) !!};
                const data = {!! json_encode($movimientosMensuales) !!};
                
                if (data.length > 0 && data.some(v => v > 0)) {
                    charts.tendencia = new Chart(canvas.tendencia.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Movimientos',
                                data: data,
                                borderColor: '#6366f1',
                                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#6366f1',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                }
            }

            // 6. EVOLUCIÓN OC
            if (canvas.oc) {
                const labels = {!! json_encode($mesesLabels) !!};
                const data = {!! json_encode($ocMensual) !!};
                
                if (data.length > 0 && data.some(v => v > 0)) {
                    charts.oc = new Chart(canvas.oc.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Monto OC ($)',
                                data: data,
                                borderColor: '#f59e0b',
                                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#f59e0b',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return '$' + context.parsed.y.toLocaleString();
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return '$' + value.toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }

            // 7. CATEGORÍAS
            if (canvas.categoria) {
                const labels = {!! json_encode(array_column($productosPorCategoria, 'nombre')) !!};
                const data = {!! json_encode(array_column($productosPorCategoria, 'total')) !!};
                
                if (data.length > 0 && data.some(v => v > 0)) {
                    const colores = ['#8b5cf6', '#ec4899', '#f59e0b', '#10b981', '#3b82f6', '#ef4444', '#6366f1', '#14b8a6', '#f97316', '#8b5cf6'];
                    charts.categoria = new Chart(canvas.categoria.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Productos',
                                data: data,
                                backgroundColor: colores.slice(0, data.length),
                                borderRadius: 5,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                }
            }

            graficasInicializadas = true;
        } catch (error) {
            console.error('Error al iniciar gráficas:', error);
        }
    }

    function iniciarGraficasConRetraso() {
        // Limpiar intervalos anteriores
        if (dashboardInterval) {
            clearInterval(dashboardInterval);
            dashboardInterval = null;
        }

        // Destruir gráficas existentes
        destruirGraficas();

        let intentos = 0;
        const maxIntentos = 15;
        
        dashboardInterval = setInterval(function() {
            intentos++;
            const listo = esperarElementos();
            
            if (listo || intentos >= maxIntentos) {
                clearInterval(dashboardInterval);
                dashboardInterval = null;
            }
        }, 200);
    }

    // INICIALIZACIÓN PRINCIPAL
    document.addEventListener('livewire:initialized', function() {
        setTimeout(iniciarGraficasConRetraso, 100);
    });

    // Cuando Livewire actualiza el DOM (navegación, updates)
    document.addEventListener('livewire:navigated', function() {
        iniciarGraficasConRetraso();
    });

    // Cuando Livewire hace un update del componente
    document.addEventListener('livewire:update', function() {
        iniciarGraficasConRetraso();
    });

    // Cuando se completa un request de Livewire
    document.addEventListener('livewire:request-finished', function() {
        setTimeout(iniciarGraficasConRetraso, 100);
    });

    // DOMContentLoaded (fallback)
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(iniciarGraficasConRetraso, 100);
    });

    // MutationObserver para detectar cambios en el DOM
    if (window.MutationObserver) {
        const observer = new MutationObserver(function(mutations) {
            const canvas = document.getElementById('movimientosChart');
            if (canvas && !graficasInicializadas) {
                iniciarGraficasConRetraso();
            }
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }
</script>