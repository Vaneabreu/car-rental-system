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
        <div class="container-edit">
            <div class="card" style="max-width: 600px;">
                <div class="card-header">
                    <h5>Editar Gasto</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('gastos.update', $gasto->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control"
                                value="{{ $gasto->descripcion }}">
                        </div>

                        <div class="form-group">
                            <label for="monto" class="form-label">Monto</label>
                            <div class="input-group">
                                <span class="input-group-text black-bg">$</span>
                                <input type="text" class="form-control" name="monto" id="monto"
                                    value="{{ $gasto->monto }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fecha_gasto" class="form-label">Fecha del gasto</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="fecha_gasto" id="fecha_gasto"
                                    value="{{ $gasto->fecha_gasto }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vehiculo" class="form-label">Vehiculo</label>
                            <details id="vehiculoDetails" class="alternative-select" custom-select
                                data-target="vehiculo_id">
                                <summary custom-toggle>
                                    @foreach ($vehiculos as $vehiculo)
                                        @if ($vehiculo->id == $gasto->vehiculo_id)
                                            {{ $vehiculo->marca }} {{ $vehiculo->modelo }} {{ $vehiculo->año_vehiculo }}
                                        @endif
                                    @endforeach
                                </summary>
                                <ul custom-options>
                                    @foreach ($vehiculos as $vehiculo)
                                        <li class="custom-option" data-value="{{ $vehiculo->id }}">
                                            {{ $vehiculo->marca }} {{ $vehiculo->modelo }} {{ $vehiculo->año_vehiculo }}
                                        </li>
                                    @endforeach
                                </ul>
                            </details>
                            <input type="hidden" name="vehiculo_id" id="vehiculo_id" value="{{ $gasto->vehiculo_id }}">
                        </div>

                        <button type="submit" class="btn btn-sm btn-green"
                            style="border: none !important; box-shadow: none !important;">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const customSelects = document.querySelectorAll("[custom-select]");

                customSelects.forEach((select) => {
                    const toggle = select.querySelector("[custom-toggle]");
                    const options = select.querySelector("[custom-options]");
                    const optionsList = options?.querySelectorAll("[custom-option]");
                    const inputField = document.getElementById("vehiculo_id");

                    options.addEventListener("click", (event) => {
                        const eventTarget = event.target;

                        if (eventTarget) {
                            const value = eventTarget.getAttribute("data-value");
                            const text = eventTarget.innerText;

                            // Actualiza la opción seleccionada
                            optionsList?.forEach((option) => {
                                option !== eventTarget && option.removeAttribute("selected");
                            });

                            eventTarget.setAttribute("selected", "");

                            // Actualiza el texto y valor del toggle
                            if (toggle) {
                                toggle.innerText = text;
                                toggle.setAttribute("data-value", value);
                            }

                            // Establece el valor del campo de entrada
                            inputField.value = value;
                        }

                        select.removeAttribute("open");
                    });
                });
            });

            vehiculoDetails.addEventListener("click", function(event) {
            if (event.target.tagName === "LI") {
                const selectedValue = event.target.getAttribute("value");
                vehiculoIdInput.value = selectedValue;
            }
            });

            document.addEventListener('DOMContentLoaded', function() {
                const montoInput = document.getElementById('monto');

                montoInput.addEventListener('input', function(event) {
                    //Permitir solo números y el punto decimal
                    this.value = this.value.replace(/[^0-9.]/g, '');

                    //Que solo haya un punto decimal
                    const parts = this.value.split('.');
                    if (parts.length > 2) {
                        this.value = parts[0] + '.' + parts.slice(1).join('');
                    }
                });
            });

        </script>
    @endsection
