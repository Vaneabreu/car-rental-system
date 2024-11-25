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

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <title>Fernandez Rent Car </title>

    </head>

    <body>
        <div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
            <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="container">
                <div class="card-create">

                <div class="card-header" style="font-size: 25px; text-align: left; margin-left: 0;"> {{ __('Lista de Gastos') }} </div>

                <div class="card-body">

                    <form  class="row g-2 mb-2" method="GET" action="{{ route('gastos.index') }}">
                        <div class="form-row" style="display: flex; align-items: center; ">
                            <div class="form-group col-md-6" style="flex: 1; display: flex; align-items: center;">
                                <details id="vehiculoDetails" class="alternative-select" custom-select style="flex: 1; margin-left: 10px;">
                                    <summary custom-toggle>Selecciona un vehiculo</summary>
                                    <ul custom-options>
                                        <li custom-option value="">Todos los vehículos</li>
                                        @foreach ($vehiculos as $vehiculo)
                                            <li custom-option value="{{ $vehiculo->id }}">{{ $vehiculo->marca }} {{ $vehiculo->modelo }} {{ $vehiculo->año_vehiculo }}</li>
                                        @endforeach
                                    </ul>
                                </details>
                                <input type="hidden" name="vehiculo_id" id="vehiculo_id">
                                <button type="submit" style="position: absolute; right: 10px; top: 30%; border: none; background: none; cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#73b958" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.357 1.357l3.847 3.847a1 1 0 0 0 1.414-1.414l-3.847-3.847zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>

                    <br>
                    @if ($gastos->isEmpty())
                        <div class="alert alert-danger" role="alert">
                            No hay gastos asociados con este vehículo.
                        </div>
                    @else
                        <div style="overflow-x: auto; scrollbar-width: thin; max-height: 500px;">

                            <table class="table" style="margin-bottom: 0; ">

                                <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Vehículo</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <div style="overflow-y: auto; scrollbar-width: thin; max-height: 250px;">

                                        @foreach ($gastos as $gasto)
                                            <tr>
                                                <td>{{ $gasto->descripcion }}</td>
                                                <td>
                                                    @if ($gasto->vehiculo)
                                                        {{ $gasto->vehiculo->marca }} {{ $gasto->vehiculo->modelo }}
                                                        {{ $gasto->vehiculo->año_vehiculo }}
                                                    @else
                                                        Sin vehículo asociado
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($gasto->fecha_gasto)) }}</td>
                                                <td>${{ $gasto->monto }}</td>
                                                <td>
                                                    <a href="{{ route('gastos.edit', $gasto->id) }}"
                                                        class="btn btn-sm btn-light-green"
                                                        style="border: none !important; box-shadow: none !important;">Editar</a>

                                                    <form action="{{ route('gastos.destroy', $gasto->id) }}" method="POST"
                                                        style="display: inline;" onsubmit="return confirmDelete(event)">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-light-red">Eliminar</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4">Total:</td>
                                            <td>${{ $total }} dólares</td>

                                        </tr>
                        </div>
                    @endif

            </tbody>
            </table>

            @if (!$gastos->isEmpty())
                <div class="pagination">
                    @if ($gastos->currentPage() > 1)
                        <a href="{{ $gastos->previousPageUrl() }}" class="page-link btn-custom" id="prev-link">Anterior</a>
                    @endif

                    @if ($gastos->hasMorePages())
                        <a href="{{ $gastos->nextPageUrl() }}" class="page-link btn-custom" id="next-link">Siguiente</a>
                    @endif
                </div>

                <div class="page-info">
                    Página {{ $gastos->currentPage() }} de {{ $gastos->lastPage() }}
                </div>
            @endif

        </div>

    </body>

    <!-- Modal para Registrar Gasto -->
    <div class="modal modal-side fade" id="registrarGastoModal" tabindex="-1" role="dialog"
        aria-labelledby="registrarGastoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content black-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrarGastoModalLabel">Registrar Gasto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true" class="white-close-button">&times;</span>
                    </button>

                </div>

                <br>
                <div class="modal-body">
                    <!-- Formulario para registrar el gasto -->
                    <form class="row g-3" method="POST" action="{{ route('gastos.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="monto">Monto</label>
                                <div class="input-group">
                                    <span class="input-group-text black-bg">$</span>
                                    <input type="text" class="form-control" name="precio_dia" id="precio_dia">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <label for="vehiculo" class="form-label">Vehiculo</label>
                                <details id="vehiculoDetails" class="alternative-select" custom-select>
                                    <summary custom-toggle>Seleccione un vehiculo...</summary>
                                    <ul custom-options>
                                        @foreach ($vehiculos as $vehiculo)
                                            <li custom-option value="{{ $vehiculo->id }}">{{ $vehiculo->marca }}
                                                {{ $vehiculo->modelo }} {{ $vehiculo->año_vehiculo }}</li>
                                        @endforeach
                                    </ul>
                                </details>
                                <input type="hidden" name="vehiculo_id" id="vehiculo_id">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="fecha_gasto" class="form-label">Fecha</label>
                                <input type="date" class="form-control" name="fecha_gasto" id="fecha_gasto">
                            </div>
                        </div>
                        <div class="col-12 my-2">

                            <button type="submit" class="btn btn-sm btn-light-green float-end"
                                style="border: none !important; box-shadow: none !important;">Registrar</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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

                        if (toggle) {
                            toggle.innerText = text;
                            toggle.setAttribute("value", String(value));
                        }

                        vehiculoIdInput.value = value;
                    }

                    select.removeAttribute("open");
                });
            });

            vehiculoDetails.addEventListener("click", function(event) {
                if (event.target.tagName === "LI") {
                    const selectedValue = event.target.getAttribute("value");
                    vehiculoIdInput.value = selectedValue;
                }
            });


        });

        function openEditModal(gastoId) {
            // Show the modal
            $('#editModal').modal('show');
        }

        function confirmDelete(event) {

            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro de que quieres eliminar este gasto?',
                text: "¡No podrás revertir esto!",
                showCancelButton: true,
                confirmButtonColor: '#41802a91',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo',

            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
@endsection
