
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
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <title>Fernandez Rent Car </title>


    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
                        <div class="card-create-small ">
                            <div class="card-header">{{ __('Registro de Gastos') }}</div>

                            <div class="card-body">


                                <form class="row g-3" method="POST" action="{{ route('gastos.store') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="descripcion">Descripción</label>
                                            <input type="text" class="form-control" name="descripcion" id="descripcion">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="monto">Monto</label>
                                            <input type="number" class="form-control" name="monto" id="monto"
                                                placeholder="$">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="vehiculo" class="form-label">Vehiculo</label>
                                            <details id="vehiculoDetails" class="alternative-select" custom-select data-target="vehiculo_id">
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


                                        <div class="col-md-6">
                                            <label for="fecha_gasto" class="form-label">Fecha</label>
                                            <input type="date" class="form-control" name="fecha_gasto" id="fecha_gasto">
                                        </div>
                                    </div>

                                    <div class="col-12 my-2">
                                        <button type="submit" class="btn btn-sm btn-green">Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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

                            clienteIdInput.value = value;
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
            document.addEventListener('DOMContentLoaded', function() {
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
