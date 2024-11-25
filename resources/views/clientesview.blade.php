@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <title>Fernandez Rent Car </title>
        <style>
            .card {
                background-color: rgb(7, 7, 7) !important;
                color: #ffffff;
                border-radius: 12px !important;
                width: 600px;
            }

            body {
                font-family: "Montserrat", Helvetica, Arial, serif;
                background-color: rgb(2, 2, 2) !important;
                color: white;
            }

            .black-modal .modal-content {
                background-color: rgb(7, 7, 7) !important;
                color: white;
            }

            .black-modal .modal-header {
                color: white;
                box-shadow: none !important;
            }

            /* NEW */

            body {
                background: #676767;
            }

            div {
                box-sizing: border-box;
            }

            .clearfix:after {
                visibility: hidden;
                display: block;
                font-size: 0;
                content: " ";
                clear: both;
                height: 0;
            }

            .ath-card {
                max-width: 580px;
                width: 100%;
                margin: 50px auto;
                background: rgba(7, 7, 7, 0.965) !important;
                font-size: 14px;
                line-height: 18px;
                color: #4d4d4d;
                box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
                border-radius: 5px;
                overflow: hidden;
            }

            .ath-card .content {
                display: inline-block;
                float: left;
                width: 100%;
                padding: 40px;

            }

            .ath-card .content .portrait {
                position: relative;
                float: left;
                display: inline-block;
                width: 30%;
                padding-bottom: 30%;
                overflow: hidden;
                background-image: url(https://images.vexels.com/media/users/3/127916/isolated/preview/0670ce3628278f83bac514e09e1e1b39-green-user-line-icon2-svg.png);
                background-size: cover;
                background-position: center;
            }

            .ath-card .content .portrait .greeting-wrap {
                position: absolute;
                width: 100%;
                height: 100%;
                opacity: 0;
                animation-duration: 300ms;
                text-align: center;
            }

            .ath-card .content .portrait .greeting {
                position: relative;
                margin-top: 95%;
                display: inline-block;
                max-width: 90%;
                background: #fff;
                border-radius: 3px;
                padding: 5px 10px;
                text-align: center;
                transition: 150ms all linear;
                transform: translate(0, -100%);
                line-height: 14px;
                font-size: 12px;
            }

            .ath-card .content .portrait .greeting:after {
                content: '';
                position: absolute;
                top: 0;
                left: 50%;
                width: 0;
                height: 0;
                border: 15px solid transparent;
                border-bottom-color: #fff;
                border-top: 0;
                border-left: 0;
                margin-left: 0;
                margin-top: -15px;
                z-index: 0;
            }

            .ath-card .content .portrait:before {
                content: '';
                position: absolute;
                top: 0;
                bottom: 0;
                right: 0;
                left: 0;
                transition: all 150ms linear;
            }

            .ath-card .content .details {
                float: left;
                display: inline-block;
                width: 70%;
                padding: 0px 15px;
            }

            .ath-card .content .details .name {
                margin: 4px 0px 0px 0px;
                font-size: 20px;
                line-height: 20px;
                color: #01A6AB;
                overflow: ellipsis;
                white-space: nowrap;
            }

            .ath-card .content .details .subtitle {
                color: #737373;
                overflow: ellipsis;
                white-space: nowrap;
            }

            .ath-card .content .details .description {
                border-top: 1px solid rgba(0, 0, 0, 0.1);
                text-align: justify;
                margin: 5px 0px 0px 0px;
                padding: 5px 0px 0px 0px;
            }

            .ath-card .content .details .more {
                border-top: 1px solid rgba(0, 0, 0, 0.1);
                margin: 5px 0px 0px 0px;
                padding: 5px 0px 0px 0px;
                font-size: 12px;
                text-align: left;
            }

            .ath-card .content .details .more a {
                color: #898989;
                text-decoration: none;
            }

            .ath-card .content .details .more a:hover {
                color: #01A6AB;
            }

            .ath-card .content .details .card-row {
                display: inline-block;
                position: relative;
                width: 100%;
                padding-top: 5px;
                float: left;
            }

            .ath-card .content .details .card-row .title-col {
                float: left;
                display: inline-block;
                width: 35%;
                min-width: 80px;
                font-weight: bold;
            }

            .ath-card .content .details .card-row .desc-col {
                float: left;
                display: inline-block;
                width: 65%;
                color: #898989;
            }

            .footer {
                display: inline-block;
                float: left;
                background: #01A6AB;
                background: linear-gradient(45deg, #c632eb 0%, #01A6AB 100%);
                width: 100%;
                font-size: 18px;
                padding: 10px;
                text-align: center;
            }

            .footer a {
                text-decoration: none;
                color: rgba(255, 255, 255, 0.75);
                transition: 150ms all linear;
            }

            .footer a i {
                padding: 0px 5px;
                line-height: 24px;
            }

            .footer a:hover {
                color: rgba(255, 255, 255, 1);
            }

            .ath-card.card-hover .content .portrait .greeting-wrap {
                opacity: 1;
            }

            .ath-card.card-hover .content .portrait:before {
                background: rgba(0, 0, 0, 0.2);
            }
        </style>
    </head>

    </html>

     <div class="container">
        <div class="form-wrap">
            <div class="card-body">
                <h1 class="card-title">Editar Cliente</h1>

                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $cliente->nombre }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $cliente->apellido }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $cliente->telefono }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $cliente->direccion }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cedula">Cedula</label>
                                <input type="text" name="cedula" id="cedula" class="form-control" value="{{ $cliente->cedula }}">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-green">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
@endsection
