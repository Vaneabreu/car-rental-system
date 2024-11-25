@php
    use Barryvdh\DomPDF\PDF; //Importa la clase PDF del paquete Barryvdh\DomPDF.
    $totalFinal = 0;
    $comisionFinal = 0;
    $total = 0;
    $totalGastos = 0;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Fernandez Rent Car </title>

    <style>
        .container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 4px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .total {
            font-weight: bold;
        }

        .card {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        @if ($mesSeleccionado)
            <h2>Estado de cuenta del mes {{ $mesSeleccionado }}</h2>
        @else
            <h2>Estado de cuenta de todos los meses</h2>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Vehículo</th>
                    <th>Días de Renta</th>
                    <th>Precio por día</th>
                    <th>Comision por dia</th>
                    <th>Comision a recibir</th>
                    <th>Fecha de Salida</th>
                    <th>Fecha de Entrada</th>
                    {{-- <th>Mes de la Reserva</th> --}}
                    <th>Gastos</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservas as $reserva)
                    <tr>
                        <td>
                            @if ($reserva->cliente)
                                {{ $reserva->cliente->nombre }}
                            @endif
                        </td>
                        <td>{{ $reserva->vehiculo }}</td>
                        <td>{{ $reserva->dias_renta }}</td>
                        <td>${{ $reserva->precio_dia }}</td>
                        <td>${{ $reserva->comision }}</td>
                        <td>${{ $reserva->comision * $reserva->dias_renta }}</td>
                        <td>{{ $reserva->fecha_salida }}</td>
                        <td>{{ $reserva->fecha_entrada }}</td>
                        {{-- <td>{{ $reserva->fecha_reserva }}</td> --}}

                        <td>
                            @php
                                $gastoTotal = 0;
                            @endphp

                            @foreach ($vehiculos as $vehiculo)
                                @if ($vehiculo->id == $reserva->vehiculo_id)
                                    @if ($vehiculo->gastos)
                                        @php
                                            $gastoTotal = $vehiculo->gastos->sum('monto');
                                        @endphp
                                    @endif
                                @endif
                            @endforeach

                            ${{ $gastoTotal }}
                        </td>

                        <td>${{ $reserva->total }}</td>
                    </tr>

                    @php

                        $comisionFinal += $reserva->comision * $reserva->dias_renta;
                        $total += $reserva->precio_dia * $reserva->dias_renta;
                    @endphp
                @endforeach

                @php

                    foreach ($gastos as $gasto) {
                        $totalGastos += $gasto->monto;
                    }
                @endphp


                <tr class="total">
                    <td colspan="9">Total:</td>
                    <td>${{ $total }}</td>
                </tr>

                <tr class="total">
                    <td colspan="9">Gastos:</td>
                    <td>${{ $totalGastos }}</td>
                </tr>

                <tr class="total">
                    <td colspan="9">Comision:</td>
                    <td>${{ $comisionFinal }}</td>
                </tr>

                @php
                    $totalFinal = $total - $comisionFinal - $totalGastos;
                @endphp

                <tr class="total">
                    <td colspan="9">Total Final:</td>
                    <td>${{ $totalFinal }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
