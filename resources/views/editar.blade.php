
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
        <title>Fernandez Rent Car </title>

        <style>
            .btn-success {
             background-color: #41802a91 !important;
             outline: none;
             box-shadow: none !important;

         }

         .swal2-popup .swal2-styled:focus {
             box-shadow: none !important;
         }

         .btn-light-green {
             background-color: #73b95891 !important;
             color: #ffffff;
         }

         .btn-light-red {
             background-color: #850e0e91 !important;
             color: #ffffff;
         }

         .card {
             background-color: rgb(7, 7, 7) !important;
             color: #ffffff;
         }

         body {
             font-family: "Montserrat", Helvetica, Arial, serif;
             background-color: rgb(2, 2, 2) !important;
             color: white;
         }

         input.form-control {
             background-color: rgb(15, 15, 15) !important;
             color: #ffffff !important;
         }

         select.form-control {
             background-color: rgb(7, 7, 7) !important;
             color: #ffffff !important;
         }

         table {
             color: white !important;

         }

         .btn-light-green {
             color: #ffffff !important;
         }

         .btn-light-red {
             color: #ffffff !important;
         }

         .form-control#mes:focus {
             border-color: #ced4da;
             box-shadow: none;
         }

         table.table {
             border-collapse: collapse;

         }

         table.table th,
         table.table td {
             border: 1px solid rgba(19, 17, 17, 0.712);

         }
         .swal2-popup {
             background-color: rgb(7, 7, 7) !important;
         }

         .swal2-title,
         .swal2-content {
             color: white;
         }
     </style>

    </head>
    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Editar Vehículo') }}</div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('reservas.actualizar', $reserva->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group row">
                                    <label for="año_vehiculo"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Vehiculo') }}</label>

                                    <div class="col-md-6">
                                        <input id="vehiculo" type="text"
                                            class="form-control @error('vehiculo') is-invalid @enderror" name="vehiculo"
                                            value="{{ $reserva->vehiculo }}" required autofocus>

                                        @error('vehiculo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fecha_salida"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Fecha de salida') }}</label>

                                    <div class="col-md-6">
                                        <input id="fecha_salida" type="text"
                                            class="form-control @error('fecha_salida') is-invalid @enderror"
                                            name="fecha_salida" value="{{ $reserva->fecha_salida }}" required>

                                        @error('fecha_salida')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fecha_entrada"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Fecha de entrada') }}</label>

                                    <div class="col-md-6">
                                        <input id="fecha_entrada" type="text"
                                            class="form-control @error('fecha_entrada') is-invalid @enderror"
                                            name="fecha_entrada" value="{{ $reserva->fecha_entrada }}" required>

                                        @error('fecha_entrada')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit"class="btn btn-sm btn-green">Guardar</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
