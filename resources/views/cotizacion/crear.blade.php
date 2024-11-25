@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <title>Fernandez Rent Car</title>
    </head>
    <body>
        <div class="container centered-container ">
            <div class= "max-width-container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    {{-- <div class="d-flex align-items-center justify-content-center" style="height: 80vh;"> --}}
                        <div class="card-create-small ">
                            <div class="card-header"  style="font-weight: bold;">{{ __('Generar Cotización') }} </div>

                            <div class="card-body">
                                <form {{-- class="row g-3" --}} action="{{ route('cotizacion.generar') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="vehiculo" {{-- class="form-label" --}}>Vehiculo</label>
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
                                        <div class="col-md-6">
                                            <label for="fecha_salida" class="form-label">Fecha de salida</label>
                                            <input type="date" class="form-control" name="fecha_salida" id="fecha_salida" placeholder="04-10-2024">
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="fecha_entrada" class="form-label">Fecha de entrada</label>
                                            <input type="date" class="form-control" name="fecha_entrada" id="fecha_entrada" placeholder="20-10-2024">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="dias_renta" class="form-label">Días de renta</label>
                                            <input type="text" class="form-control" name="dias_renta" id="dias_renta"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="precio_dia" class="form-label">Precio por día</label>
                                            <div class="input-group">
                                                <span class="input-group-text black-bg">$</span>
                                                <input type="text" class="form-control" name="precio_dia" id="precio_dia">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="total" class="form-label">Total a pagar</label>
                                            <div class="input-group">
                                                <span class="input-group-text black-bg">$</span>
                                                <input type="text" class="form-control" name="total" id="total"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <button type="submit" class="btn btn-sm btn-green"> Generar Cotización</button>

                                </form>
                            </div>
                        </div>

                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>

            document.addEventListener('DOMContentLoaded', function() {
                const fechaSalida = flatpickr("#fecha_salida", {
                    minDate: "2024-01-01",
                    maxDate: "2024-12-31",
                    dateFormat: "d-m-Y",
                    onChange: validarFechas
                });

                const fechaEntrada = flatpickr("#fecha_entrada", {
                    minDate: "2024-01-01",
                    maxDate: "2025-12-31",
                    dateFormat: "d-m-Y",
                    onChange: validarFechas
                });


                function validarFechas() {
                    const fechaSalidaValor = fechaSalida.selectedDates[0];
                    const fechaEntradaValor = fechaEntrada.selectedDates[0];

                    if (fechaSalidaValor && fechaEntradaValor && fechaSalidaValor > fechaEntradaValor) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'La fecha de salida no puede ser mayor a la fecha de entrada.',
                            confirmButtonText: 'Aceptar'
                        });
                        // fechaSalida.clear();
                    }

                    calcularDiasRenta();
                }

                function calcularDiasRenta() {
                    const fechaSalida = new Date(document.getElementById('fecha_salida').value.split('-').reverse()
                        .join('-'));
                    const fechaEntrada = new Date(document.getElementById('fecha_entrada').value.split('-').reverse()
                        .join('-'));

                    if (fechaEntrada && fechaSalida && fechaEntrada >= fechaSalida) {
                        const unDia = 24 * 60 * 60 * 1000;
                        const diasRenta = Math.round((fechaEntrada - fechaSalida) / unDia);
                        document.getElementById('dias_renta').value = diasRenta > 0 ? diasRenta : '';

                        calcularTotal();
                    } else {
                        document.getElementById('dias_renta').value = '';
                        document.getElementById('total').value = '';
                    }
                }

                function calcularTotal() {
                    const diasRenta = parseInt(document.getElementById('dias_renta').value);
                    const precioDia = parseFloat(document.getElementById('precio_dia').value);

                    if (!isNaN(diasRenta) && !isNaN(precioDia)) {
                        const total = diasRenta * precioDia;
                        document.getElementById('total').value = total.toFixed(2);
                    } else {
                        document.getElementById('total').value = '';
                    }
                }

                document.getElementById('precio_dia').addEventListener('input', function(event) {

                    this.value = this.value.replace(/[^0-9.]/g, '');

                    const parts = this.value.split('.');
                    if (parts.length > 2) {
                        this.value = parts[0] + '.' + parts.slice(1).join('');
                    }

                    calcularTotal();
                });

                const customSelects = document.querySelectorAll("[custom-select]");
                customSelects.forEach((select) => {
                    const options = select.querySelector("[custom-options]");
                    const optionsList = options?.querySelectorAll("[custom-option]");
                    const summary = select.querySelector("summary");
                    const targetInputId = select.dataset.target;
                    const targetInput = document.getElementById(targetInputId);

                    options.addEventListener("click", (event) => {
                        const eventTarget = event.target;

                        if (eventTarget) {
                            const value = eventTarget.getAttribute("value");
                            const text = eventTarget.innerText;

                            optionsList?.forEach((option) => {
                                option != eventTarget && option.removeAttribute("selected");
                            });

                            eventTarget.setAttribute("selected", "");
                            targetInput.value = value;
                            summary.innerText =
                                text;
                        }

                        select.removeAttribute("open");
                    });
                });

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
