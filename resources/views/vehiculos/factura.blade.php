<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Factura</title>
    <style>
        body {
            font-family: "Montserrat", Helvetica, Arial, serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Estado de Cuenta</h1>

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
                    <th>Fecha de Reserva</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalFinal = 0;
                @endphp
                @foreach ($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->cliente->nombre }}</td>
                        <td>{{ $reserva->vehiculo }}</td>
                        <td>{{ $reserva->dias_renta }}</td>
                        <td>${{ $reserva->precio_dia }}</td>
                        <td>${{ $reserva->comision }}</td>
                        <td>${{ $reserva->comision * $reserva->dias_renta }}</td>
                        <td>{{ $reserva->fecha_salida }}</td>
                        <td>{{ $reserva->fecha_entrada }}</td>
                        <td>{{ $reserva->fecha_reserva }}</td>
                        <td>${{ $reserva->total }}</td>
                    </tr>
                    @php
                        $comisionFinal = $reserva->comision * $reserva->dias_renta;
                        $totalFinal += $reserva->total - $comisionFinal;
                    @endphp
                @endforeach
                <tr class="total">
                    <td colspan="9">Total Final:</td>
                    <td>${{ $totalFinal }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
