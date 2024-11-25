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
                    <div class="card-create-small">
                        <div class="card-header"><b>{{ __('Editar Cotización') }}</b></div>
                        <div class="card-body">
                            <form action="{{ route('cotizaciones.actualizar', $cotizacion->id) }}" method="POST">
                                {{--  @dd($cotizacion) --}}
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vehiculo_id">Vehículo:</label>
                                            <select name="vehiculo_id" id="vehiculo_id" class="form-control">
                                                @foreach ($vehiculos as $vehiculo)
                                                    <option value="{{ $vehiculo->id }}"
                                                        {{ $cotizacion->vehiculo_id == $vehiculo->id ? 'selected' : '' }}>
                                                        {{ $vehiculo->marca }} {{ $vehiculo->modelo }} {{ $vehiculo->año_vehiculo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_salida">Fecha de salida:</label>
                                            <input type="date" name="fecha_salida" id="fecha_salida" class="form-control"
                                                value="{{ $cotizacion->fecha_salida }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_entrada">Fecha de entrada:</label>
                                            <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control"
                                                value="{{ $cotizacion->fecha_entrada }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dias_renta">Días de renta:</label>
                                            <input type="text" name="dias_renta" id="dias_renta" class="form-control"
                                                value="{{ $cotizacion->dias_renta }}" required disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precio_dia">Precio por día:</label>
                                            <input type="text" name="precio_dia" id="precio_dia" class="form-control"
                                                value="{{ $cotizacion->precio_dia }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total">Total a pagar:</label>
                                            <input type="text" name="total" id="total" class="form-control"
                                                value="{{ $cotizacion->total }}" required disabled>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-sm btn-green">Guardar cambios</button>
                                <button type="button" class="btn btn-sm btn-green" onclick="window.history.back();">Atrás</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                    const fechaSalida = flatpickr("#fecha_salida", {
                    minDate: "2024-01-01",
                    maxDate: "2025-12-31",
                    dateFormat: "d-m-Y",
                    defaultDate: "{{ $cotizacion->fecha_salida }}",
                    onChange: function(selectedDates) {
                        calcularDiasRenta();
                    }
                });

                const fechaEntrada = flatpickr("#fecha_entrada", {
                    minDate: "2024-01-01",
                    maxDate: "2025-12-31",
                    dateFormat: "d-m-Y",
                    defaultDate: "{{ $cotizacion->fecha_entrada }}",
                    onChange: function(selectedDates) {
                        calcularDiasRenta();
                    }
                });

                function validarFechas() {
                    const fechaSalidaValor = fechaSalida.selectedDates[0];
                    const fechaEntradaValor = fechaEntrada.selectedDates[0];

                    if (fechaSalidaValor && fechaEntradaValor) {
                        if (fechaSalidaValor > fechaEntradaValor) {
                            Swal.fire({
                                background: 'rgb(7, 7, 7)',
                                text: 'La fecha de salida no puede ser mayor a la fecha de entrada.',
                                confirmButtonText: 'Aceptar',
                            });
                        }
                    }
                }

                document.getElementById('fecha_salida').addEventListener('change', calcularDiasRenta);
                document.getElementById('fecha_entrada').addEventListener('change', calcularDiasRenta);

                function calcularDiasRenta() {
                    const fechaSalida = new Date(document.getElementById('fecha_salida').value);
                    const fechaEntrada = new Date(document.getElementById('fecha_entrada').value);

                    if (fechaEntrada && fechaSalida && fechaEntrada >= fechaSalida) {
                        const unDia = 24 * 60 * 60 * 1000;
                        const diasRenta = Math.round((fechaEntrada - fechaSalida) / unDia);
                        document.getElementById('dias_renta').value = diasRenta;

                        const precioDia = parseFloat(document.getElementById('precio_dia').value);
                        const total = diasRenta * precioDia;
                        document.getElementById('total').value = total.toFixed(2);
                    } else {
                        document.getElementById('dias_renta').value = '';
                        document.getElementById('total').value = '';
                    }
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
            });
        </script>
    @endsection
