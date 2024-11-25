@extends('layouts.app')
@php
    use Barryvdh\DomPDF\PDF;
@endphp

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
        <div class="container-fluid"{{--  style="display: flex; justify-content: center; align-items: center; min-height: 80vh;" --}}>
            {{-- <div class="row justify-content-center"> --}}
                <div class="row ">
                <div class="col-md-12">
                    <div class="card-create">
                        <div class="card-body">
                            <h2>Estado de cuenta</h2>

                            <form method="GET" action="{{ route('vehiculos.estado-cuenta') }}">
                                @csrf

                                <div class="form-row" style="display: flex; align-items: center;">
                                    <div class="form-group col-md-6" style="flex: 1; display: flex; align-items: center;">
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

                                    <button type="submit"
                                        style="border: none; background: none; box-shadow: none; margin-left: 2px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#73b958"
                                            class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.357 1.357l3.847 3.847a1 1 0 0 0 1.414-1.414l-3.847-3.847zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </button>
                                </div>
                                </div>
                            </form>

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
                               {{--  <h4>Estado de cuenta de {{ $mesSeleccionadoNombre }}:</h4> --}}
                                <form method="POST" action="{{ route('vehiculos.estado-cuenta.pdf') }}">
                                    @csrf
                                    <input type="hidden" name="mes" value="{{ $mesSeleccionado }}">
                                    <button type="submit" class="btn btn-sm btn-green"
                                        style="border: none !important; box-shadow: none !important; margin-bottom: 20px;">Descargar
                                       {{--  estado de cuenta en PDF --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                        </svg>
                                    </button>

                                </form>


                                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
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
                                                <th>Mes de la Reserva</th>
                                                <th>Gastos</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $comisionActual = 0;
                                                $totalActual = 0;
                                                $gastoActual = 0;
                                            @endphp

                                            @foreach ($reservas as $reserva)
                                                <tr>
                                                    <td>
                                                        @if ($reserva->cliente)
                                                            {{ $reserva->cliente->nombre }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $reserva->vehiculo }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($reserva->fecha_salida)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($reserva->fecha_entrada)) }}</td>
                                                    <td>{{ $reserva->dias_renta }}</td>
                                                    <td>${{ $reserva->precio_dia }}</td>
                                                    <td>${{ $reserva->comision }}</td>
                                                    <td>${{ $reserva->comision * $reserva->dias_renta }}</td>
                                                    <td>{{ $reserva->fecha_reserva }}</td>

                                                    <td>
                                                        @foreach ($vehiculos as $vehiculo)
                                                            @if ($vehiculo->id == $reserva->vehiculo_id)
                                                                @foreach ($vehiculo->gastos as $gasto)
                                                                    @php
                                                                        $gastoActual += floatval($gasto->monto);
                                                                    @endphp
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                        ${{ $gastoActual }}
                                                    </td>

                                                    <td>${{ $reserva->total }}</td>
                                                </tr>

                                                @php
                                                    $comisionActual += $reserva->comision * $reserva->dias_renta;
                                                    $totalActual += $reserva->precio_dia * $reserva->dias_renta;
                                                @endphp
                                            @endforeach

                                            <tr class="total">
                                                <td colspan="10">Comisión:</td>
                                                <td>${{ $comisionActual }}</td>
                                            </tr>

                                            <tr class="total">
                                                <td colspan="10">Gastos:</td>
                                                <td>${{ $gastoActual }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="totales pr-5" >
                                    <table class="table">
                                        <tr class="total">
                                            <td colspan="10">Total:</td>
                                            <td class="text-right text-align-right">${{ $totalActual }}</td>
                                        </tr>

                                        <tr class="total">
                                            <td colspan="10">Total Final:</td>
                                            <td class="text-right text-align-right">${{ $totalFinal }}</td>
                                        </tr>
                                    </table>
                                </div>

                            @else
                                <p>No hay reservas para el mes seleccionado.</p>

                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <br>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const customSelects = document.querySelectorAll("[custom-select]");
                const mesDetails = document.getElementById("mesDetails");
                const mesIdInput = document.getElementById("mes_id");


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

                mesDetails.addEventListener("click", function(event) {
                    if (event.target.tagName === "LI") {
                        const selectedValue = event.target.getAttribute("value");
                        mesIdInput.value = selectedValue;
                        mesDetails.removeAttribute("open");
                    }
                });

            });
        </script>
    @endsection
