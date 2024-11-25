@extends('layouts.app')

@section('content')

<head>
    <title>Fernandez Rent Car</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
        <div class="row justify-content-center">
       <!--  <div class="row "> -->
            <div class="col-md-12">
            <div class="container">
                <div class="card-create">
                <div class="card-header" style="font-size: 25px; text-align: left; margin-left: 0;"><b>{{ __('Cotizaciones') }}</b></div>

                    <div class="card-body">
                      <!--   <h2>Cotizaciones</h2> -->

                        <form  class="row g-2 mb-2" method="GET" action="{{ route('cotizacion.index') }}">
                            @csrf

                            <div class="form-row" style="display: flex; align-items: center;">
                                <div class="form-group col-md-6" style="flex: 1; display: flex; align-items: center;">
                                    <details id="mesDetails" class="alternative-select" custom-select style="flex: 1; margin-left: 10px;">

                                        <summary custom-toggle>Todos los vehículos</summary>
                                        <ul custom-options>
                                            <li custom-option value="">Todos los vehículos</li>
                                            @foreach ($vehiculos as $vehiculo)
                                            <li custom-option value="{{ $vehiculo->id }}">{{ $vehiculo->marca }}
                                                {{ $vehiculo->modelo }} {{ $vehiculo->año_vehiculo }}
                                            </li>
                                            @endforeach
                                        </ul>

                                    </details>
                                    <input type="hidden" name="vehiculo_id" id="vehiculo_id">

                                    <button type="submit"
                                        style="border: none; background: none; box-shadow: none; margin-left: 2px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="#73b958" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.357 1.357l3.847 3.847a1 1 0 0 0 1.414-1.414l-3.847-3.847zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <br>

                        <!-- Tabla de Cotizaciones -->
                        <div>
                            <table class="table" style="margin-bottom: 0;">
                                <thead>
                                    <tr>
                                        <th>Vehículo</th>
                                        <th>Fecha de salida</th>
                                        <th>Fecha de entrada</th>
                                        <th>Días de renta</th>
                                        <th>Precio por día</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cotizaciones as $cotizacion)
                                    <tr>
                                        <td>
                                            @if ($cotizacion->vehiculo)
                                            {{ $cotizacion->vehiculo->marca }}
                                            {{ $cotizacion->vehiculo->modelo }}
                                            {{ $cotizacion->vehiculo->año_vehiculo }}
                                            @else
                                            Sin vehículo asociado
                                            @endif
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($cotizacion->fecha_salida)) }}</td>
                                        <td>{{ date('d/m/Y', strtotime($cotizacion->fecha_entrada)) }}</td>
                                        <td>{{ $cotizacion->dias_renta }}</td>
                                        <td>${{ $cotizacion->precio_dia }}</td>
                                        <td>${{ $cotizacion->total }}</td>
                                        <td>
                                            <a href="{{ route('cotizaciones.editar', $cotizacion->id) }}"
                                                class="btn btn-sm btn-light-green"
                                                style="border: none !important; box-shadow: none !important;">Editar</a>
                                            <form action="{{ route('cotizacion.destroy', $cotizacion->id) }}"
                                                method="POST" style="display: inline;"
                                                onsubmit="return confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-light-red">Eliminar</button>
                                            </form>
                                            <a href="{{ route('cotizacion.descargar', $cotizacion->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" fill="#73b95891" class="bi bi-filetype-pdf"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if (!$cotizaciones->isEmpty())
                            <div class="pagination">
                                @if ($cotizaciones->currentPage() > 1)
                                <a href="{{ $cotizaciones->previousPageUrl() }}"
                                    class="btn btn-sm btn-light-green" id="prev-link">Anterior</a>
                                @endif
                                @if ($cotizaciones->hasMorePages())
                                <a href="{{ $cotizaciones->nextPageUrl() }}" class="btn btn-sm btn-light-green"
                                    id="next-link">Siguiente</a>
                                @endif
                            </div>
                            <div class="page-info">
                                Página {{ $cotizaciones->currentPage() }} de {{ $cotizaciones->lastPage() }}
                            </div>
                            @endif
                        </div>
                        <br>
                    </div>

                    <!-- Script para confirmación de eliminación -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
                    <script>
                        function confirmDelete(event) {
                            event.preventDefault();
                            Swal.fire({
                                title: '¿Estás seguro?',
                                text: "¡No podrás revertir esto!",
                                showCancelButton: true,
                                confirmButtonColor: '#73b95891',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Sí, eliminarlo'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    event.target.submit();
                                }
                            });
                        }

                        document.addEventListener("DOMContentLoaded", function() {
                            const customSelects = document.querySelectorAll("[custom-select]");
                            const vehiculoDetails = document.getElementById("vehiculoDetails");
                            const vehiculoIdInput = document.getElementById("vehiculo_id");

                            customSelects.forEach((select) => {
                                const toggle = select.querySelector("[custom-toggle]");
                                const options = select.querySelector("[custom-options]");
                                const optionsList = options?.querySelectorAll("[custom-option]");

                                options.addEventListener("click", (event) => {
                                    const eventTarget = event.target;

                                    if (eventTarget) {
                                        const value = eventTarget.getAttribute("value");
                                        const text = eventTarget.innerText;

                                        optionsList?.forEach((option) => {
                                            option != eventTarget && option.removeAttribute("selected");
                                        });

                                        eventTarget.setAttribute("selected", "");
                                        toggle.innerText = text;
                                        toggle.setAttribute("value", String(value));
                                        vehiculoIdInput.value = value;
                                    }

                                    select.removeAttribute("open");
                                });
                            });

                            vehiculoDetails.addEventListener("click", function(event) {
                                if (event.target.tagName === "LI") {
                                    vehiculoIdInput.value = event.target.getAttribute("value");
                                }
                            });
                        });

                        @if(session('success'))
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: '{{ session('
                            success ') }}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        @endif
                    </script>
</body>
@endsection
