@extends('layouts.app')
@section('content')
    <!doctype html>
    <html lang="en">

    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Appointment Reminder Email Template</title>
        <meta name="description" content="Appointment Reminder Email Template">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>Appointment Reminder Email Template</title>
        <meta name="description" content="Appointment Reminder Email Template">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <title>Fernandez Rent Car </title>

        <style>
            body {
                font-family: "Montserrat", Helvetica, Arial, serif;
                background-color: rgb(2, 2, 2) !important;
                color: white;
            }

            .card {
                background-color: #070707 !important;
                color: #ffffff;
                border-radius: 8px !important;
                max-width: 1000px !important;
                margin: 0 auto;
            }

            /* .btn-success {
                background-color: #73b95891 !important;
                color: #000000 !important;
                font-weight: bold;
            } */

            .btn-light-green {
                background-color: #73b95891 !important;
                color: #000000 !important;
                font-weight: bold;
            }

            .email-title {
                color: #ffffff;
                font-weight: 400;
                margin: 0;
                font-size: 32px;
                font-family: 'Rubik', sans-serif;
                text-align: center;
                padding: 0 15px;
            }

            .email-divider {
                display: inline-block;
                vertical-align: middle;
                margin: 29px 0 26px;
                border-bottom: 1px solid #cecece;
                width: 100px;
            }

            .details-table {
                width: 100%;
                border: 1px solid #ffffff;
            }

            .details-table td {
                padding: 10px;
                border-bottom: 1px solid #ededed;
            }

            .details-table td:first-child {
                border-right: 1px solid #ededed;
                width: 35%;
                font-weight: 500;
                color: #ffffff;
            }

            .details-table td:last-child {
                color: #ffffff;
            }
        </style>

    </head>

    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
        <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
            <div class="card mx-auto"
                style="width: 600px; background-color: #070707; color: #ffffff; border-radius: 8px; padding: 20px;">
                <h1 class="card-title">Cotización</h1>
                <div class="card-text">
                    <table class="details-table" style="color: white;">
                        <tbody>
                            <tr>
                                <td>Vehículo</td>
                                <td>{{ $cotizacion->vehiculo->marca }} {{ $cotizacion->vehiculo->modelo }}
                                    {{ $cotizacion->vehiculo->año_vehiculo }}</td>
                            </tr>
                            <tr>
                                <td>Fecha de salida:</td>
                                <td>{{ $cotizacion->fecha_salida }}</td>
                            </tr>
                            <tr>
                                <td>Fecha de entrada:</td>
                                <td>{{ $cotizacion->fecha_entrada }}</td>
                            </tr>
                            <tr>
                                <td>Días de renta:</td>
                                <td>{{ $cotizacion->dias_renta }} Dias</td>
                            </tr>
                            <tr>
                                <td>Precio por día:</td>
                                <td>${{ $cotizacion->precio_dia }} USD</td>
                            </tr>
                            <tr>
                                <td>Total a pagar:</td>
                                <td>${{ $cotizacion->total }} USD</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <button href="{{ route('cotizaciones.editar', $cotizacion->id) }}" class="btn-light-green">Editar
                        cotización</button>
                    <a href="{{ route('cotizacion.descargar', $cotizacion->id) }}" class="btn-light-green">Descargar PDF
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                        </svg></a>
                </div>
            </div>
        </div>

    </body>

    </html>
@endsection
