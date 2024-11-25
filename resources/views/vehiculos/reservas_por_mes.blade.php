@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integ
            rity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <title>Fernandez Rent Car </title>

    </head>
    <?php setlocale(LC_TIME, 'es_ES.UTF-8'); ?>

    <body>

        <div class="container-fluid" {{-- style="min-height: 80vh; display: flex; flex-direction: column; align-items: center;" --}}>
            {{--
            <div class="d-grid gap-2" style="width: 84%; display: flex; justify-content: flex-end; margin-bottom: 20px;">
                <a href="{{ route('vehiculos.reservar') }}" class="btn btn-sm btn-light-green" role="button"
                    style="border: none !important; box-shadow: none !important;"> Crear Reserva</a>
            </div> --}}

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('vehiculos.reservar') }}" class="btn btn-sm btn-light-green" role="button"
                    style="border: none !important; box-shadow: none !important;"> Crear Reserva</a>
            </div>
            <br>
            <div class="row ">
                <div class="col-md-12">
                    <div class="card-create">
                        <div class="card-body">
                            <h2>Reservas por mes</h2>
                            <form method="GET" action="{{ route('reservas.por-mes') }}">
                                @csrf
                                <div class="form-row" style="display: flex; align-items: center;">
                                    <div class="form-group col-md-6" style="flex: 1; display: flex; align-items: center;">
                                        <!-- Select de Meses -->
                                        <details id="mesDetails" class="alternative-select" custom-select style="flex: 1;">
                                            <summary custom-toggle>Selecciona un mes...</summary>
                                            <ul custom-options>
                                                <li custom-option value="">Todos los meses</li>
                                                @php
                                                    $meses = [
                                                        1 => 'Enero',
                                                        2 => 'Febrero',
                                                        3 => 'Marzo',
                                                        4 => 'Abril',
                                                        5 => 'Mayo',
                                                        6 => 'Junio',
                                                        7 => 'Julio',
                                                        8 => 'Agosto',
                                                        9 => 'Septiembre',
                                                        10 => 'Octubre',
                                                        11 => 'Noviembre',
                                                        12 => 'Diciembre',
                                                    ];
                                                @endphp
                                                @foreach ($meses as $numeroMes => $nombreMes)
                                                    <li custom-option value="{{ $numeroMes }}">{{ $nombreMes }}</li>
                                                @endforeach
                                            </ul>
                                        </details>
                                        <input type="hidden" name="mes" id="mes_id">

                                        <button type="submit" style="border: none; background: none; box-shadow: none; margin-left: 10px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#73b958" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.357 1.357l3.847 3.847a1 1 0 0 0 1.414-1.414l-3.847-3.847zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <br>

                            @if ($reservas->count() > 0)
                                @php
                                    $meses = [
                                        1 => 'Enero',
                                        2 => 'Febrero',
                                        3 => 'Marzo',
                                        4 => 'Abril',
                                        5 => 'Mayo',
                                        6 => 'Junio',
                                        7 => 'Julio',
                                        8 => 'Agosto',
                                        9 => 'Septiembre',
                                        10 => 'Octubre',
                                        11 => 'Noviembre',
                                        12 => 'Diciembre',
                                    ];
                                    $mesSeleccionadoNombre =
                                        isset($mesSeleccionado) && $mesSeleccionado !== ''
                                            ? $meses[$mesSeleccionado]
                                            : 'todos los meses';
                                @endphp
                               {{--  <h4>Reservas para {{ $mesSeleccionadoNombre }}:</h4> --}}
                                <form method="GET" action="{{ route('reservas.por-mes') }}">
                                    @csrf
                                    <input type="hidden" name="mes" value="{{ $mesSeleccionado }}">

                                </form>

                                <div class="table-responsive">
                                    <table class="table">


                                        <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Vehículo</th>
                                                <th>Fecha de Salida</th>
                                                <th>Fecha de Entrada</th>
                                                <th>Días de renta</th>
                                                <th>Precio por día</th>
                                                <th>Comisión por día</th>
                                                <th>Comisión a recibir</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $totalFinal = 0;
                                            @endphp
                                            @foreach ($reservas as $reserva)
                                                <tr>

                                                    <td>
                                                        @if ($reserva->cliente)
                                                            {{ $reserva->cliente->nombre_completo }}
                                                        @else
                                                            Cliente no disponible
                                                        @endif
                                                    </td>

                                                    <td>{{ $reserva->vehiculo }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($reserva->fecha_salida)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($reserva->fecha_entrada)) }}</td>
                                                    <td>{{ $reserva->dias_renta }}</td>
                                                    <td>${{ $reserva->precio_dia }}</td>
                                                    <td>${{ $reserva->comision }}</td>
                                                    <td>${{ $reserva->comision * $reserva->dias_renta }}</td>
                                                    <td>${{ $reserva->total }}</td>

                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-light-green"
                                                            style="border: none !important; box-shadow: none !important;"
                                                            data-toggle="modal"
                                                            data-target="#editarModal{{ $reserva->id }}">Editar</a>

                                                        <form action="{{ route('reservas.eliminar', $reserva->id) }}"
                                                            method="POST" style="display: inline-block;"
                                                            onsubmit="return confirmDelete(event)">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-light-red">Eliminar</button>
                                                        </form>
                                                        <!-- Modal de Edición -->
                                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                                        <!-- Incluir Bootstrap JavaScript -->
                                                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                                                            <div class="modal fade" id="editarModal{{ $reserva->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{ $reserva->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content"
                                                                    style="background: rgb(7, 7, 7); color: white;">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editarModalLabel{{ $reserva->id }}">Editar
                                                                            Reserva</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Formulario de edición -->
                                                                        <form method="POST"
                                                                            action="{{ route('reservas.actualizar', $reserva->id) }}">
                                                                            @csrf
                                                                            @method('PUT')

                                                                            <div class="row">

                                                                                <div class="col-md-6 mb-2">
                                                                                    <label for="vehiculo"
                                                                                        class="form-label">Vehiculo</label>
                                                                                    <select name="vehiculo_id"
                                                                                        id="vehiculo" class="form-control">

                                                                                        <!-- Mostrar vehículo asociado a la reserva primero y seleccionado -->
                                                                                        @php
                                                                                            $vehiculoAsociado =
                                                                                                $reserva->vehiculo_id;
                                                                                        @endphp
                                                                                        @foreach ($vehiculos as $vehiculo)
                                                                                            <option
                                                                                                value="{{ $vehiculo->id }}"
                                                                                                {{ $vehiculo->id == $vehiculoAsociado ? 'selected' : '' }}>
                                                                                                {{ $vehiculo->marca }}
                                                                                                {{ $vehiculo->modelo }}
                                                                                                {{ $vehiculo->año_vehiculo }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>


                                                                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                                                <script>
                                                                                    $(document).ready(function() {

                                                                                    });
                                                                                </script>

                                                                                <div class="col-md-6 mb-2">

                                                                                    <label for="cliente"
                                                                                        class="form-label">Cliente</label>
                                                                                    <select name="cliente_id" id="cliente"
                                                                                        class="form-control">
                                                                                        @foreach ($clientes as $cliente)
                                                                                            <option
                                                                                                value="{{ $cliente->id }}"
                                                                                                {{ $cliente->id == $reserva->cliente_id ? 'selected' : '' }}>
                                                                                                {{ $cliente->nombre_completo }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>


                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="fecha_salida">Fecha de
                                                                                            salida</label>
                                                                                        <input type="date"
                                                                                            name="fecha_salida"
                                                                                            id="fecha_salida"
                                                                                            class="form-control"
                                                                                            value="{{ $reserva->fecha_salida }}">
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="fecha_entrada">Fecha de
                                                                                            entrada</label>
                                                                                        <input type="date"
                                                                                            name="fecha_entrada"
                                                                                            id="fecha_entrada"
                                                                                            class="form-control"
                                                                                            value="{{ $reserva->fecha_entrada }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="precio_dia">Precio por
                                                                                            dia</label>
                                                                                        <input type="text"
                                                                                            name="precio_dia"
                                                                                            id="precio_dia"
                                                                                            class="form-control"
                                                                                            value="{{ $reserva->precio_dia }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="comision">Comision</label>
                                                                                        <input type="text"
                                                                                            name="comision" id="comision"
                                                                                            class="form-control"
                                                                                            value="{{ $reserva->comision }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">

                                                                                <button type="button" class="btn btn-sm btn-light-red" data-dismiss="modal">Cerrar Modal</button>
                                                                                <button type="submit" class="btn btn-sm btn-light-green">Guardar</button>

                                                                                <script>
                                                                                    $(document).ready(function() {

                                                                                        $('.btn-cerrar').on('click', function() {
                                                                                            var targetModal = $(this).data('target');
                                                                                            $(targetModal).modal('hide');
                                                                                        });
                                                                                    });

                                                                                </script>

                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                               {{--  @php
                                                    $comisionFinal = $reserva->comision * $reserva->dias_renta;
                                                    $totalFinal += $reserva->total - $comisionFinal;
                                                @endphp --}}
                                            @endforeach

                                           {{--  @if ($reservas->currentPage() == $reservas->lastPage())
                                                <tr class="total">
                                                    <td colspan="8">Total Final sin comisiones:</td>

                                                    <td>${{ $totalFinal }}</td>
                                                    <td colspan="9"></td>


                                                </tr>
                                            @endif --}}

                                        </tbody>
                                    </table>

                                    <div class="pagination">
                                        @if ($reservas->currentPage() > 1)
                                            <a href="{{ $reservas->previousPageUrl() }}"
                                                class="btn btn-sm btn-light-green" id="prev-link">Anterior</a>
                                        @endif

                                        @if ($reservas->hasMorePages())
                                            <a href="{{ $reservas->nextPageUrl() }}" class="btn btn-sm btn-light-green"
                                                id="next-link">Siguiente</a>
                                        @endif
                                    </div>

                                    <div class="page-info">
                                        Página {{ $reservas->currentPage() }} de {{ $reservas->lastPage() }}
                                    </div>
                                </div>
                            @else
                                <p>No hay reservas para el mes seleccionado.</p>
                            @endif
                            {{-- <a href="{{ route('reservas.editar', $reserva->id) }}" class="btn btn-outline-success">Editar</a> --}}

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <br>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            < script src = "https://code.jquery.com/jquery-3.6.0.min.js" >
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const customSelects = document.querySelectorAll("[custom-select]");
                const mesDetails = document.getElementById("mesDetails");
                const mesIdInput = document.getElementById("mes_id");

                // Manejo de los custom selects
                customSelects.forEach((select) => {
                    const toggle = select.querySelector("[custom-toggle]");
                    const options = select.querySelector("[custom-options]");
                    const optionsList = options?.querySelectorAll("[custom-option]");

                    options.addEventListener("click", (event) => {
                        const eventTarget = event.target;

                        if (eventTarget) {
                            const value = eventTarget.getAttribute("value");
                            const text = eventTarget.innerText;

                            // Desmarcar otras opciones
                            optionsList?.forEach((option) => {
                                if (option !== eventTarget) {
                                    option.removeAttribute("selected");
                                }
                            });

                            // Marcar la opción seleccionada
                            eventTarget.setAttribute("selected", "");

                            // Actualizar el toggle con el valor seleccionado
                            if (toggle) {
                                toggle.innerText = text;
                                toggle.setAttribute("value", String(value));
                            }

                            // Asignar el valor al input correspondiente
                            mesIdInput.value = value;
                        }

                        select.removeAttribute("open");
                    });
                });

                // Manejo del click en mesDetails
                mesDetails.addEventListener("click", function(event) {
                    if (event.target.tagName === "LI") {
                        const selectedValue = event.target.getAttribute("value");
                        mesIdInput.value = selectedValue;
                        mesDetails.removeAttribute("open");
                    }
                });
            });

            $(document).ready(function() {

                // Función para abrir el modal cuando se hace clic en el botón "Editar"
                $('a.btn-light-green').on('click', function() {
                    var targetModal = $(this).data(
                        'target'); // Obtiene el ID del modal desde el atributo data-target
                    $(targetModal).modal('show');
                });

                // Verifica si hay un mensaje de éxito en la sesión y muestra una alerta
                @if (session('success'))
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                @endif
            });

            $(document).ready(function() {
                $('button.btn-cerrar').on('click', function() {
                    var targetModal = $(this).data('target');
                    $(targetModal).modal('hide');

                    // Elimina manualmente el fondo si persiste
                    $('.modal-backdrop').remove();
                });

                $('#myModal').on('hidden.bs.modal', function() {
                    // Elimina manualmente el fondo después de que el modal se haya ocultado
                    $('.modal-backdrop').remove();
                });
            });

            function confirmDelete(event) {
                event.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro de que quieres eliminar esta reserva?',
                    text: "¡No podrás revertir esto!",
                    showCancelButton: true,
                    confirmButtonColor: '#41802a91',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo',
                    background: 'rgb(7, 7, 7)',
                    customClass: {
                        title: 'swal-title',
                        text: 'swal-content',
                        confirmButton: 'swal-confirm-button',
                        cancelButton: 'swal-cancel-button'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });
            }
        </script>
{{--
        @if (session('success'))
            <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500,
                    background: 'rgba(0, 0, 0, 0.426)',
                    color: 'white',
                    customClass: {
                        title: 'swal-success-title',
                        container: 'swal-success-container'
                    }
                });
            </script>
        @endif --}}


    @endsection
