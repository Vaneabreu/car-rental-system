<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cotizacion</title>
    <link rel="stylesheet" href="style.scc" media="all"/>
    <style>

        img {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 100px;
            height: 100px;
            border-radius: 100%;
        }
        table {
                font-family: "Montserrat", Helvetica, Arial, serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
            form > h2{
               color: #0094ff;
            }
            form > p:first-child{
                font-size: large;
            }
            .createPDF{
                font-size: 14px;
            }
    </style>
</head>
<body>
    <header class="clearfix">
        <div id="logo">
            <?php
            $nombreImagen = public_path('assets/img/carlogo.jpg');
            $imagenBase64 = "data:image/jpg;base64," . base64_encode(file_get_contents($nombreImagen));
            ?>
        </div>
        <div id="company">
            <h2 class="name">Fernandez Rent A Car</h2>
            <div>La torre, La vega</div>
            <div>(809) 607-7920</div>
            <div><a href="mailto:company@example.com">randy-1994@hotmail.com</a></div>
        </div>
    </header>
    <main>
        <div class="container">

            <div class="container">
                <h4>Cotizacion de {{ $vehiculo->marca }} {{ $vehiculo->modelo }} {{ $vehiculo->año_vehiculo }}</h4>
                <table class="table caption-top">

                    <thead>
                      <tr>
                        <th scope="col">Vehículo</th>
                            <th scope="col">Fecha de salida</th>
                            <th scope="col">Fecha de entrada</th>
                            <th scope="col">Días de renta</th>
                            <th scope="col">Precio por día</th>
                            <th scope="col">Total a pagar</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $vehiculo->marca }} {{ $vehiculo->modelo }} {{ $vehiculo->año_vehiculo }}</td>
                            <td>{{ $fecha_salida }}</td>
                            <td>{{ $fecha_entrada }}</td>
                            <td>{{ $dias_renta }}</td>
                            <td>${{ $precio_dia }} USD</td>
                            <td>${{ $total }} USD</td>

                        </tr>
                    </tbody>
                  </table>
            </div>
        </div>

    </main>
    <img src="<?php echo $imagenBase64 ?>" />
</body>
</html>




