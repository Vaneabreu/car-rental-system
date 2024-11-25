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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <title>Fernandez Rent Car </title>

    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
                        <div class="card-create ">
                            <div class="card-header">{{ __('Registro de Gastos') }}</div>

                            <div class="card-body">


                                <form class="row g-3" method="POST" action="{{ route('gastos.store') }}">
                                    @csrf

                                    <div class="col-md-12 mb-2">
                                        <label for="descripcion">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion" id="descripcion">
                                    </div>

                                    {{--  <div class="col-md-12 mb-2">
                                        <label for="monto">Monto</label>
                                        <input type="number" class="form-control" name="monto" id="monto"
                                            placeholder="$">
                                    </div> --}}

                                    <div class="col-md-12 mb-2">
                                        <label for="monto">Monto</label>
                                        <input type="text" class="form-control" name="monto" id="monto"
                                            placeholder="$" required>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label for="vehiculo" class="form-label">Vehiculo</label>
                                        <details id="vehiculoDetails" class="alternative-select" custom-select
                                            data-target="vehiculo_id">
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

                                    <div class="col-md-12 mb-2">
                                        <label for="fecha_gasto" class="form-label">Fecha</label>
                                        <input type="date" class="form-control" name="fecha_gasto" id="fecha_gasto">
                                    </div>

                                    <div class="col-12 my-2">
                                        <button type="submit" class="btn btn-sm btn-green"
                                            style="border: none !important; box-shadow: none !important;">Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Inicialización de Flatpickr para la fecha de gasto
                flatpickr("#fecha_gasto", {
                    minDate: "2024-01-01",
                    maxDate: "2024-12-31",
                    dateFormat: "d-m-Y"
                });

                // Inicialización de selección personalizada
                const customSelects = document.querySelectorAll("[custom-select]");
                const vehiculoDetails = document.getElementById("vehiculoDetails");
                const vehiculoIdInput = document.getElementById("vehiculo_id");

                customSelects.forEach((select) => {
                    const toggle = select.querySelector("[custom-toggle]");
                    const options = select.querySelector("[custom-options]");
                    const optionsList = options?.querySelectorAll("[custom-option]");

                    options.addEventListener("click", (event) => {
                        const eventTarget = event.target;

                        if (eventTarget && eventTarget.hasAttribute("value")) {
                            const value = eventTarget.getAttribute("value");
                            const text = eventTarget.innerText;

                            optionsList?.forEach((option) => {
                                if (option !== eventTarget) {
                                    option.removeAttribute("selected");
                                }
                            });

                            eventTarget.setAttribute("selected", "");

                            if (toggle) {
                                toggle.innerText = text;
                                toggle.setAttribute("value", String(value));
                            }

                            vehiculoIdInput.value = value; // Corrección del identificador

                            // Ocultar el select después de la selección
                            select.removeAttribute("open");
                        }
                    });
                });

                // Manejo de clics en detalles del vehículo
                vehiculoDetails.addEventListener("click", function(event) {
                    if (event.target.tagName === "LI") {
                        const selectedValue = event.target.getAttribute("value");
                        vehiculoIdInput.value = selectedValue;
                    }
                });

                // Validación de entrada para el monto
                const montoInput = document.getElementById('monto');

                montoInput.addEventListener('input', function(event) {
                    // Permitir solo números y el punto decimal
                    this.value = this.value.replace(/[^0-9.]/g, '');

                    // Que solo haya un punto decimal
                    const parts = this.value.split('.');
                    if (parts.length > 2) {
                        this.value = parts[0] + '.' + parts.slice(1).join('');
                    }
                });

                // Mostrar mensaje de éxito con SweetAlert
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
        </script>
    @endsection
