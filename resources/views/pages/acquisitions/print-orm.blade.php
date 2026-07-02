{{-- resources/views/pages/acquisitions/print-orm.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        ORM N° {{ $orm->orm }}
    </title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            padding: 30px;

        }

        .print-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .print-header {
            background: #f8f9fa;
            padding: 10px 30px;
            border-bottom: 2px solid #dee2e6;
        }



        .info-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 12px;
            color: #212529;
            font-weight: 500;
            word-break: break-word;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .items-table th {
            background: #f8f9fa;
            border: 1px solid #212529;
            padding: 5px 5px;
            font-weight: 600;
            text-align: center;
            font-size: 11px;
            color: #495057;
        }

        .items-table td {
            border: 1px solid #212529;
            padding: 5px 5px;
            vertical-align: top;
        }

        .observations-section {
            padding: 24px;
            background: #fefefe;
            border-top: 1px solid #e9ecef;
        }

        .observation-item {
            padding: 10px 10px;
            margin-bottom: 16px;
            background: #fefefe;
        }

        .observation-text {
            color: #212529;
            font-size: 13px;
            line-height: 1.5;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-secondary {
            background: #e2e3e5;
            color: #383d41;
        }

        .signature-section {
            padding: 24px;
            border-top: 1px solid #e9ecef;
            background: #fefefe;
        }

        .print-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .print-button:hover {
            background: #5a6268;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .font-bold {
            font-weight: 700;
        }

        .empty-field {
            color: #adb5bd;
            font-style: italic;
            font-size: 12px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .print-container {
                box-shadow: none;
                border-radius: 0;
            }

            .print-button {
                display: none;
            }

            .items-table th {
                background: #f1f3f5 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #dee2e6;
        }

        .table-wrapper {
            padding: 0 24px 24px 24px;
        }

        .header-subtitle {
            font-size: 12px;
            color: #6c757d;
        }

        .header-code {
            font-size: 12px;
            font-weight: 600;
            color: #495057;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .title1 {
            text-align: center;
            color: #212529;
            font-size: 12px;
        }

        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px 16px;
            margin: 16px 0;
            padding: 0 30px;
        }

        .info-row {
            display: flex;
            align-items: baseline;
            border-bottom: 1px solid #e9ecef;
            padding: 1px 0;
        }

        .info-label {
            width: 130px;
            flex-shrink: 0;
            font-size: 11px;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .info-value {
            flex: 1;
            font-size: 13px;
            color: #212529;
            font-weight: 500;
        }

        .info-value.empty {
            color: #adb5bd;
            font-style: italic;
            font-weight: normal;
        }
    </style>
</head>

<body style="padding: 20px 20px">
    <button class="print-button" onclick="window.print()">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M6 9V3h12v6M6 21h12v-6H6zM21 9H3v8h4v-4h10v4h4V9z" />
        </svg>
        Imprimir
    </button>

    <div class="print-container">
        {{-- Header --}}
        <div class="print-header">
            <div class="flex-between">
                <div>
                    <img src="{{ asset('storage/logo.png') }}" alt="Imagen" width="100px">
                    <p class="header-subtitle">{{ config('app.company') }}</p>
                    <p class="header-subtitle" style="font-size: 10px"> {{"DIRECCIÓN: " .  config('app.address') }}<br>
                        {{ config('app.email') }}</p>
                </div>
                <div>
                    <p class="title1">
                        <br><br>{{ config('app.giro') }}<br><br>R.U.T.: {{ config('app.rut') }}
                    </p>
                    <br>
                    <div style="font-size: 15px; font-style: italic; text-align: center;" class="font-bold">ORDEN DE
                        REQUERIMIENTO DE
                        MATERIALES
                    </div>
                </div>
                <div>
                    <div style="display: flex; align-items: center; height: 125px; text-decoration: underline; font-style: italic; color:#d33c43"
                        class="font-bold">
                        {{ $orm->orm }}
                    </div>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="info-row">
                <div class="info-label">OTI / CDC</div>
                <div class="info-value">
                    {{ $orm->cdcRel->cdc }}
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Descripción CDC</div>
                <div class="info-value">
                    {{ mb_convert_case($orm->cdcRel->descripcion, MB_CASE_TITLE, 'UTF-8') }}
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Descripción</div>
                <div class="info-value">
                    {{ $orm->descripcion ?? 'No registrado' }}
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Área de Negocio</div>
                <div class="info-value">
                    {{ $orm->adnRel->descripcion ?? 'No registrado' }}
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Fecha Solicitud</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($orm->created_at)->format('d/m/Y') }}
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Solicitante</div>
                <div class="info-value">
                    {{ $orm->responsableRel->name ?? 'No registrado' }}
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Tipo ORM</div>
                <div class="info-value">
                    {{ $orm->tipo ?? 'No registrado' }}
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Sitio</div>
                <div class="info-value">
                    {{ $orm->sitioRel->descripcion ?? 'No registrado' }}
                </div>
            </div>
        </div>
        {{-- Tabla de items --}}
        @if (isset($detalles) && count($detalles) > 0)
            <div class="table-wrapper">
                <div class="section-title">Detalle de Materiales</div>

                <table class="items-table">
                    <thead>
                        <tr>
                            <th width="5%">CANT/UND</th>
                            {{-- <th width="8%">UND</th> --}}
                            <th width="30%">DESCRIPCIÓN</th>
                            <th width="12%">COSTOS</th>
                            <th>BODEGA</th>
                            <th>CIUDAD</th>
                            <th width="10%">LLEGADA EST.</th>
                            <th width="10%">LLEGADA</th>
                            <th>RECEPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orm->detormRel as $index => $item)
                            <tr>
                                <td class="text-center">
                                    {{ $item->cantidad . ' ' . $item->productoRel->unidad }}
                                </td>
                                {{-- <td class="text-center">{{ !empty($item->und) ? $item->und : '—' }}</td> --}}
                                <td>
                                    {{ $item->productoRel->nombre ?? 'Sin descripción' }}
                                    @if (!empty($item->detalle))
                                        <br><small class="text-muted">({{ $item->detalle }})</small>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->procesado ? 'PROCESADO' : 'NO PROCESADO' }}</td>
                                <td class="text-center">
                                    {{ $item->bodega ? "EN STOCK" : 'SIN STOCK' }}</td>
                                <td class="text-center">{{ $item->ciudadRel->nombre ?? 'S/S' }}</td>
                                <td class="text-center">
                                    @if (!empty($item->f_estimada) && $item->f_estimada != '0000-00-00')
                                        {{ \Carbon\Carbon::parse($item->f_estimada)->format('d/m/Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (!empty($item->f_recepcion) && $item->f_recepcion != '0000-00-00')
                                        {{ \Carbon\Carbon::parse($item->f_recepcion)->format('d/m/Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->recepcion == 'total')
                                        <span
                                            class="badge badge-success">{{ ucfirst($item->recepcion)}}</span>
                                    @elseif ($item->recepcion == 'parcial')
                                        <span
                                            class="badge badge-secondary">{{ ucfirst($item->recepcion) . ': ' . $item->cantidad_recepcion }}</span>
                                    @else
                                        <span
                                            class="badge badge-secondary">{{ ucfirst($item->recepcion) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if ($orm->obs_orm || $orm->obs_costos || $orm->obs_bodega)
            <div class="observations-section">
                <div class="section-title" style="display: flex; align-items: center; gap: 8px;">
                    Observaciones
                </div>
                @if ($orm->obs_orm)
                    <div class="observation-item">
                        <p class="observation-text"><b>Observación ORM: </b>{{ ucfirst($orm->obs_orm) }}</p>
                    </div>
                @endif
                @if ($orm->obs_costos)
                    <div class="observation-item">
                        <p class="observation-text"><b>Observación costos: </b>{{ ucfirst($orm->obs_costos) }}</p>
                    </div>
                @endif
                @if ($orm->obs_bodega)
                    <div class="observation-item">
                        <p class="observation-text"><b>Observación bodega: </b>{{ ucfirst($orm->obs_bodega) }}</p>
                    </div>
                @endif
            </div>
        @endif

        {{-- Footer --}}
        <div
            style="background: #f8f9fa; padding: 12px 24px; font-size: 10px; color: #6c757d; text-align: center; border-top: 1px solid #e9ecef;">
            Documento generado el {{ now()->format('d/m/Y H:i:s') }} por {{ auth()->user()->name }}
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
