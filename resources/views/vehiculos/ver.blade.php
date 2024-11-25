{{-- NEW --}}

@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Fernandez Rent Car </title>
        <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        {{-- animations  --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@animxyz/core">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <style>
            body {

                height: 100vh;
                /*  font-family: 'Bricolage Grotesque', sans-serif; */
                font-family: "Montserrat", Helvetica, Arial, serif;
                margin: 0px;
                padding: 0px;

            }

            .card-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }
            .card3 {
                width: 49%;
            }

            .card {
                box-shadow: none;
            }

            .card-kontak {
                width: 50%;
                margin: auto;
            }

            .card:hover {
                opacity: 1.0;
                filter: alpha(opacity=100);
            }

            .jumbotron {
                opacity: 0.8;
                filter: alpha(opacity=20);
            }

            .parallax {
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
                height: 100%;
                position: fixed;
                width: 100%;
            }

            .con-sombra {
                box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            }

            .center-text {
                text-align: center;
            }

            .btn-light-green {
                background-color: #73b95891 !important;
                color: #000000 !important;
                font-weight: bold;
            }

            /* .btn-light-green {
                    color: #000000 !important;
                    font-weight: bold;
                } */


            .grey-bg {
                background-color: #F5F7FA;
            }

            .btn-green {
                background-color: #73b95891 !important;
            }

            .modal-dialog {
                margin: 0 auto;
            }

            .reservas-card {
                font-family: "Montserrat", Helvetica, Arial, serif;
            }

            .reservas-title {
                font-family: "Montserrat", Helvetica, Arial, serif;
            }

            body {
                font-family: "Montserrat", Helvetica, Arial, serif;
                background-color: rgb(2, 2, 2);
                color: white;
            }

            .card {

                background-color: rgb(7, 7, 7);
                border: 1px solid #000;
            }

            table {
                color: white !important;
            }

            .custom-delete-btn {

                background-color: red;
                color: white;
                transition: none !important;
            }

            .custom-delete-btn .bi-trash3 {
                color: white !important;
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

            .swal2-popup {
                background-color: rgb(7, 7, 7) !important;
            }

            .swal2-title,
            .swal2-content {
                color: white;

            }

            <style>* {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .bottom-container {
                display: flex;
                gap: 24px;
                padding: 32px;
                background-color: rgb(7, 7, 7);
            }

            .box {
                background-color: rgb(7, 7, 7);
                border-radius: 10px;
                padding: 24px;
                margin-bottom: 24px;
                border-radius: 8px !important;

            }

            .bottom-container__left {
                width: 70%;
            }

            .bottom-container__right {
                width: 30%;
            }

            .spending-statistics {
                max-height: 338px;
            }

            /* -------------- BAR CHART -------------- */
            .bar-chart {
                max-height: 223px;
                width: 100%;
                display: flex;
                justify-content: center;
            }

            /* -------------- HEADER -------------- */
            .header-container {
                /*  color: #1A202C; */
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 20px;
                border-radius: 8px !important;
                font-weight: 600;
                letter-spacing: -2%;
            }

            .section-header {
                line-height: 24px;
                font-size: 16px;
            }

            .header-container span {
                line-height: 21px;
                font-size: 14px;
                border-radius: 8px !important;
            }

            .total-box {
                display: flex;
            }

            .total-box__left {
                border-right: 1px solid #000000;
                flex: 1;
            }

            .total-box__right {
                flex: 1;
            }

            .up-arrow,
            .total-box__left {
                margin-right: 24px;
            }

            .price {
                line-height: 150%;
                margin-bottom: 14px;
            }

            .price-currency {
                line-height: 21px;
                font-size: 14px;
                font-weight: 600;
                color: #90A3BF;
                margin-left: 8px;
            }

            .total-box p,
            .box p {
                font-weight: 700;
                font-size: 12px;
                line-height: 1px;
                letter-spacing: -0.02em;
            }

            .percentage-increase {
                color: #7FB519;
            }

            .percentage-decrease {
                color: #db1111c2;
            }

            .option {
                border: 1.5px solid rgb(0, 0, 0);
            }

            .option:hover {
                background-color: #050505;
                border: 1.5px solid rgb(3, 87, 3);
                cursor: pointer;

            }

            .btn-light-green {
                background-color: gray;
                color: white;

            }

            .no-hover:hover {
                background-color: #4e85388a !important;
                color: rgb(21, 6, 6) !important;

            }
        </style>
    </head>

    <body>
        <div class="container">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('vehiculos.crear') }}" class="btn btn-sm btn-light-green no-hover" role="button">Agregar
                    Vehiculo</a>
            </div>

            <br>
            {{--  <li class="nav-item mr-3">
                <span id="name" class="mb-0 text-white">{{ $name }}</span>
            </li> --}}

            <div xyz="stagger-6 fade-100% small-50% duration-10" class="row ">
                @foreach ($vehiculos as $vehiculo)
                    <div class="card-deck col-sm xyz-in">
                        <div class="card border-light xyz-in" style="width: 15rem;">
                             <img src="{{ $vehiculo->imagen }}" class="card-img-top"
                            {{-- <img src="{{ Storage::url($vehiculo->imagen) }}" alt="Imagen del vehículo" class="card-img-top"
 --}}
                                alt=" {{ $vehiculo->marca }} {{ $vehiculo->modelo }}" style="width: auto;  height: auto;">
                             {{--    <p>{{ Storage::url($vehiculo->imagen) }}</p> --}}

                            <div class="card-body">
                                <h6 class="text-center" style="font-family: 'Montserrat', Helvetica;">
                                    {{ $vehiculo->marca }} {{ $vehiculo->modelo }} {{ $vehiculo->año_vehiculo }}
                                    @if ($vehiculo->id === $vehiculoConMasReservas->id)
                                        &nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="#73b95891" class="bi bi-star" viewBox="0 0 16 16">
                                            <polygon
                                                points="8 1.5 9.64 5.28 13.57 6.18 10.07 9.22 10.93 13.31 8 11.5 5.07 13.31 5.93 9.22 2.43 6.18 6.36 5.28" />
                                        </svg>
                                    @endif
                                </h6>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Año</th>
                                            <th scope="col">Marca</th>
                                            <th scope="col">Modelo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $vehiculo->año_vehiculo }}</td>
                                            <td>{{ $vehiculo->marca }}</td>
                                            <td>{{ $vehiculo->modelo }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('vehiculos.editar', $vehiculo->id) }} "
                                        class="btn btn-light-green font-weight-bold">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            class="bi bi-pen" viewBox="0 0 16 16">
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                        </svg>

                                    </a>

                                    <form action="{{ route('vehiculos.eliminar', $vehiculo->id) }}" method="POST"
                                        class="m-0 ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" class="btn btn-light-red custom-delete-btn font-weight-bold"
                                            onclick="confirmDelete()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg>
                                        </a>
                                    </form>

                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            <div class="row">
                <div class="col-xl-6 col-md-12 ">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="card-body cleartfix option">
                                <div class="media align-items-stretch">
                                    <div class="align-self-center">
                                        <i class="fas fa-car"
                                            style="color: #73b95891; font-size: 2.5rem; margin-right: 8px;"></i>

                                    </div>

                                    <div class="media-body reservas-card" id="reservas-link">
                                        <h4 class="reservas-title">Reservas</h4>
                                        <span>Total de rentas</span>
                                    </div>
                                    <div class="align-self-center">
                                        @php
                                            $cantidadReservas = \App\Models\Reserva::count();
                                        @endphp
                                        <h1>{{ $cantidadReservas }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-12  ">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="card-body cleartfix option">
                                <div class="media align-items-stretch">
                                    <div class="align-self-center">
                                        <i class="fas fa-user"
                                            style="color: #73b95891; font-size: 2.5rem; margin-right: 8px;"></i>
                                    </div>
                                    <div class="media-body reservas-card" id="clientes-link">
                                        <h4 class="reservas-title">Clientes</h4>
                                        <span>Cantidad de clientes</span>
                                    </div>
                                    <div class="align-self-center">
                                        @php
                                            $cantidadClientes = \App\Models\Cliente::count();
                                        @endphp

                                        <h1><strong>{{ $cantidadClientes }}</strong></h1>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container_card flex gap-1 px-3 justify-between">

                <div class="box total-box">
                    <div class="total-box__left" id="total-box-left">
                        <div class="header-container">
                            <h3 class="section-header">Total de entradas </h3>
                            <svg class="up-arrow" width="42" height="42" viewBox="0 0 42 42" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="42" height="42" rx="8" fill="#F6F7F9" />
                                <path d="M27.0702 18.57L21.0002 12.5L14.9302 18.57" stroke="#7FB519" stroke-width="2"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21 29.5V12.67" stroke="#7FB519" stroke-width="2" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        @php
                            $totalSum = \App\Models\Reserva::where('status', 'Activa')->sum('total');
                        @endphp

                        <h1 class="price">$ {{ $totalSum }}<span class="price-currency">(USD)</span></h1>
                        <p><span class="percentage-increase">100%</span> de las entradas</p>
                    </div>

                    <div class="total-box__right" id="total-box-right">
                        <div class="header-container">
                            <h3 class="section-header">Total de gastos</h3>
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="42" height="42" rx="8" fill="#F6F7F9" />
                                <path d="M27.0702 23.43L21.0002 29.5L14.9302 23.43" stroke="#FF4423" stroke-width="2"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21 12.5V29.33" stroke="#FF4423" stroke-width="2" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        @php
                            $totalGasto = \App\Models\Gasto::where('status', 'Activo')->sum('monto');
                        @endphp

                        <h1 class="price">$ {{ $totalGasto }}<span class="price-currency">(USD)</span></h1>
                        <p><span class="percentage-decrease">100%</span> de los gastos</p>
                    </div>

                </div>

            </div>
            {{--  <div class="box spending-box">
                <div class="header-container">
                    <h3 class="section-header">Spend by category</h3>
                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 10.4166C3.9 10.4166 3 11.3541 3 12.5C3 13.6458 3.9 14.5833 5 14.5833C6.1 14.5833 7 13.6458 7 12.5C7 11.3541 6.1 10.4166 5 10.4166Z" stroke="#1A202C" stroke-width="1.5"/>
                        <path d="M19 10.4166C17.9 10.4166 17 11.3541 17 12.5C17 13.6458 17.9 14.5833 19 14.5833C20.1 14.5833 21 13.6458 21 12.5C21 11.3541 20.1 10.4166 19 10.4166Z" stroke="#1A202C" stroke-width="1.5"/>
                        <path d="M12 10.4166C10.9 10.4166 10 11.3541 10 12.5C10 13.6458 10.9 14.5833 12 14.5833C13.1 14.5833 14 13.6458 14 12.5C14 11.3541 13.1 10.4166 12 10.4166Z" stroke="#1A202C" stroke-width="1.5"/>
                    </svg>
                </div>
                <div class="pie-chart">
                    <canvas id="myChart2" height="220px" width="220px"></canvas>
                </div>
                <div class="overall-spending">
                    <h4>Overall Spending</h4>
                    <span>$19,760,00</span>
                </div>

            </div>
 --}}
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.getElementById("total-box-right").addEventListener("click", function() {
                window.location.href = "/gastos";
            });

            document.getElementById("total-box-left").addEventListener("click", function() {
                window.location.href = "/vehiculos/estado-cuenta";
            });

            document.getElementById("clientes-link").addEventListener("click", function() {
                window.location.href = "/clientes/ver";
            });

            document.getElementById("reservas-link").addEventListener("click", function() {
                window.location.href = "/vehiculos/reservas/por-mes";
            });


            function confirmDelete() {
                Swal.fire({
                    title: '¿Estás seguro de que quieres eliminar este vehiculo?',
                    text: '¡No podrás revertir esto!',
                    showCancelButton: true,
                    confirmButtonColor: '#73b95891',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'El vehículo ha sido eliminado',
                            showConfirmButton: false,
                            timer: 1600
                        }).then(() => {
                            document.querySelector('.delete-btn').form.submit();
                        });
                    }
                });
            }
        </script>
    </body>

    </html>
@endsection
