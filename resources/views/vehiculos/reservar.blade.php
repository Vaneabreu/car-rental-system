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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@animxyz/core">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <title>Fernandez Rent Car </title>

        <style>
            .btn-success {
                background-color: #41802a91 !important;
            }

            .btn-light-green {
                background-color: #73b95891 !important;
                color: #ffffff;
                float: right;
            }

            .btn-light-red {
                background-color: #f0000091 !important;
                color: #ffffff;
            }

            input.form-control {
                background-color: rgb(0, 0, 0) !important;
                color: #ffffff !important;
            }

            select.form-control {
                background-color: rgb(7, 7, 7) !important;
                color: #ffffff !important;
            }

            select.form-control:focus {
                background-color: rgb(7, 7, 7) !important color: #ffffff !important;
                outline: none;
                /* Esto elimina el borde azul del enfoque */
            }


            .form-control#search:focus {
                border-color: #ced4da;
                box-shadow: none;

            }

            .btn-light-green:focus {
                box-shadow: none;

            }

            .swal2-popup .swal2-styled:focus {
                box-shadow: none !important;
            }

            .card {
                background-color: rgb(7, 7, 7) !important;
                color: #ffffff;
                border-radius: 8px !important;
            }

            body {
                font-family: "Montserrat", Helvetica, Arial, serif;
                background-color: rgb(2, 2, 2) !important;
                color: white;
            }

            details.alternative-select {
                display: block;
                height: max-content;
                position: relative;

                &>summary {
                    background-color: black;
                    border-radius: 0.25rem;
                    display: flex;
                    height: max-content;
                    list-style-type: none;
                    outline: solid 1px #ced4da;
                    outline-offset: -1px;
                    position: relative;
                    padding: 0.375rem 0.75rem;
                    width: 100%;
                    z-index: 1;

                    &:focus {
                        outline-color: #41802a91;
                    }

                    &::after {
                        display: none;
                    }
                }

                &>ul {
                    background-color: black;
                    border-radius: 0.25rem;
                    color: white;
                    display: flex;
                    flex-direction: column;
                    height: max-content;
                    inset: 100% 0 0 0;
                    list-style-type: none;
                    margin: 0.5rem 0 0 0;
                    min-width: max-width;
                    outline: solid 1px #41802a64;
                    outline-offset: -1px;
                    overflow: hidden;
                    padding: 6px 0;
                    position: absolute;
                    width: 100%;
                    z-index: 2;

                    &>li {
                        padding: 6px 12px;
                        cursor: pointer;

                        &:hover {
                            background-color: #41802a5c;
                        }
                    }
                }
            }

            .dropdown.dropdown-select {
                .dropdown-toggle {
                    background-color: black;
                    border-radius: 0.25rem;
                    border: solid 1px #ced4da;
                    color: white;
                    padding: 6px 12px;

                    &:focus {
                        outline-color: #41802a91;
                    }

                    &::after {
                        display: none;
                    }
                }
            }


            table {
                color: white !important;

            }

            .btn-light-green {
                color: #000000 !important;
                font-weight: bold;
            }

            .btn-light-red {
                color: #ffffff !important;
            }

            .form-control#mes:focus {
                border-color: #ced4da;
                box-shadow: none;
            }

            .black-modal .modal-content {
                background-color: rgb(7, 7, 7) !important;
                color: white;

            }

            .black-modal .modal-header {
                color: white;

            }

            .form-control#input:focus {
                border-color: #ced4da;
                box-shadow: none;

            }

            .form-control:focus {
                border-color: #41802a91 !important;
                box-shadow: none !important;

            }

            .swal2-popup {
                background-color: rgb(7, 7, 7) !important;
            }

            .swal2-title,
            .swal2-content {
                color: white;

            }

            .required-asterisk::after {
                content: " *";
                color: red;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            p {
                margin: 0;
                line-height: 1;
                text-align: center;
                letter-spacing: 1px;
                pointer-events: none;
            }

            /* Calendario */
            /* Assign Variables */
            :root {
                --bg-color: hsla(0, 0%, 0%, 0.315);
                --calendar-bg-color: hsla(0, 1%, 26%, 0.281);
                --shade-color: hsla(150, 50%, 20%, 0.1);
                --text-color: hsl(130, 32%, 11%);
                --headline-color: hsl(0, 0%, 0%);
                --rule-color: hsla(0, 0%, 50%, 0);
                --primary-color: #73b95891;
                --secondary-color: hsl(129, 60%, 11%);
            }

            .clearfix:after {
                content: ".";
                display: block;
                height: 0;
                clear: both;
                visibility: hidden;
            }

            *,
            *:before,
            *:after {
                box-sizing: border-box;
            }

            html {
                height: 100%;
            }

            body {
                height: 100%;
                display: flex;
                flex-direction: column;
                background: var(--bg-color);
                color: var(--text-color);
                /*  font-family: 'Bricolage Grotesque', sans-serif; */
            }

            .calendar {
                position: relative;
                margin: 3rem;
                overflow: hidden;
                max-width: 100%;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                border-radius: 0.5rem;
                background: var(--calendar-bg-color);
                box-shadow: 0.25rem 0.25rem 2rem var(--shade-color), -1rem -1rem 2rem var(--bg-color);
            }

            .calendar ol {
                list-style: none;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
            }

            .calendar li {
                width: calc(100% / 7);
                padding: 1rem;
                background: linear-gradient(-145deg, transparent, hsla(0, 0%, 0%, 0.025));
            }

            .calendar .days {
                flex-grow: 1;
            }

            .calendar .day-names {
                background: linear-gradient(70deg, var(--primary-color), var(--secondary-color));
                color: var(--headline-color);
                flex-shrink: 0;
                flex-grow: 0;
                /*  text-transform: uppercase; */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                font-weight: bold;
                line-height: 1;
            }

            .calendar .date {
                margin-bottom: 0.25em;
                font-size: 0.875em;
                font-weight: bold;
            }

            .calendar .outside .date {
                opacity: 0.5;
            }

            .calendar .event {
                --dot-color: var(--primary-color);
                box-shadow: 0.25em 0.25em 1em 0 hsla(0, 0%, 0%, 0.05) inset;
                font-size: 0.75rem;
                padding: 0 0.75em;
                line-height: 2em;
                white-space: nowrap;
                overflow: hidden;
                border-radius: 1em;
                display: flex;
                align-items: center;
            }

            .calendar .event::before {
                content: '';
                width: 0.5em;
                height: 0.5em;
                margin-right: 0.5em;
                background: var(--dot-color);
                border-radius: 100%;
                flex-shrink: 0;
            }

            .calendar .event.span-2 {
                width: calc(200% + 2rem);
            }

            .calendar .event.begin {
                border-radius: 1em 0 0 1em;
            }

            .calendar .event.end {
                border-radius: 0 1em 1em 0;
            }

            .calendar .event.all-day {
                background: var(--shade-color);
            }

            .calendar .event.clear {
                visibility: hidden;
            }

            /* Cuadro de información al hacer hover */
            .calendar .event-info {
                display: none;
                position: absolute;
                background-color: rgba(0, 0, 0, 0.705);
                padding: 10px;
                border-radius: 1px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                z-index: 2;
                white-space: nowrap;
                color: white;
                font-family: "Montserrat", Helvetica, Arial, serif;
            }

            .calendar .day-has-reservation:hover .event-info {
                display: block;
                position: absolute;
                background-color: rgb(0, 0, 0);
                padding: 10px;
                border-radius: 2px;
                box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
                top: 50%;
                /* Centra verticalmente */
                left: 50%;
                /* Centra horizontalmente */
                transform: translate(-50%, -50%);
                /* Centra el cuadro de información */
            }

            select.form-control option:hover {
                background-color: green;
                color: white;
            }

            .black-bg {
                background-color: black;
                color: white;

            }

            /* Estilo personalizado para el campo de búsqueda del Select2 */
            .select2-container--default .select2-search--dropdown .select2-search__field {
                background-color: black;
                color: white;
            }

            /* Estilo para el contenedor de resultados de búsqueda */
            #resultadosBusqueda {
                background-color: black;
                color: white;
                border: 1px solid #fff;
                position: absolute;
                z-index: 9999;
                width: 89%;
                margin-top: 38px;
                max-height: 100px;
                overflow-y: auto;
            }

            /* Estilo para los elementos de la lista de resultados */
            #resultadosBusqueda .list-group-item {
                background-color: black;
                color: white;
                border: none;
                cursor: pointer;

            }

            /* Estilo para los elementos de la lista de resultados al pasar el cursor */
            #resultadosBusqueda .list-group-item:hover {
                background-color: #333;
            }

            /* Estilo para el contenedor de resultados cuando hay solo un elemento */
            #resultadosBusqueda:only-child {
                max-height: 40px;
                overflow-y: hidden;

            }

        </style>
    </head>

    <body>
        <div class="container user-select-none">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
                        <div xyz="fade down duration-8" class="card xyz-in " style="width: 90rem; height: 26rem;">
                            <div class="card-header">{{ __('Crear Reserva') }} <svg xmlns="http://www.w3.org/2000/svg"
                                    width="18" height="18" fill="currentColor" class="bi bi-calendar-date"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg></div>

                            <div class="card-body">

                                <form class="row g-3" method="POST" action="{{ route('vehiculos.guardarReserva') }}">
                                    @csrf

                                    <div class="col-md-6 mb-2">
                                        <label for="cliente" class="form-label">Cliente</label>
                                        <details id="clienteDetails" class="alternative-select" custom-select
                                            data-target="cliente_id">
                                            <summary custom-toggle>Seleccione un cliente...</summary>
                                            <ul custom-options id="clienteList"
                                                style="max-height: calc(5 * 40px); overflow-y: auto; margin: 0; padding: 0; list-style-type: none;">
                                                @foreach ($clientes as $cliente)
                                                    <li custom-option value="{{ $cliente->id }}" style="height: 40px;">
                                                        {{ $cliente->nombre_completo }}</li>
                                                @endforeach
                                            </ul>
                                        </details>
                                        <input type="hidden" name="cliente_id" id="cliente_id">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="vehiculo" class="form-label">Vehiculo</label>
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

                                    <div class="col-md-6 mb-2">
                                        <label for="precio_dia" class="form-label">Precio por dia<span
                                                class="required-asterisk"></span></label>
                                        <div class="input-group">
                                            <span class="input-group-text black-bg">$</span>
                                            <input type="text" class="form-control" name="precio_dia" id="precio_dia">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="comision" class="form-label">Comision<span
                                                class="required-asterisk"></span></label>
                                        <div class="input-group">
                                            <span class="input-group-text black-bg">$</span>
                                            <input type="text" class="form-control" name="comision" id="comision">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="fecha_salida" class="form-label">Fecha de salida<span
                                                class="required-asterisk"></span></label>
                                        <input type="date" class="form-control" name="fecha_salida" id="fecha_salida"
                                            placeholder="03/09/2024">
                                    </div>

                                    <div class="col-6 mb-2">
                                        <label for="fecha_entrada" class="form-label">Fecha de entrada<span
                                                class="required-asterisk"></span></label>
                                        <input type="date" class="form-control" name="fecha_entrada" id="fecha_entrada"
                                            placeholder="15/09/2024">
                                    </div>

                                    <input type="hidden" name="fecha_reserva" id="fecha_reserva">

                                    <script>
                                        // Obtiene el campo de fecha de entrada
                                        const fechaSalida = document.getElementById('fecha_salida');

                                        // Escucha el evento de cambio en la fecha de entrada
                                        fechaSalida.addEventListener('change', function() {
                                            // Obtiene la fecha de entrada seleccionada

                                            const fechaSeleccionada = new Date(this.value);

                                            // Obtiene el nombre del mes de la fecha de entrada
                                            const nombreMesSeleccionado = fechaSeleccionada.toLocaleString('default', {
                                                month: 'long'
                                            });

                                            // Actualiza el valor del campo oculto de fecha_reserva con el nombre del mes seleccionado
                                            document.getElementById('fecha_reserva').value = nombreMesSeleccionado;

                                        });
                                    </script>
                                    <br>
                                    <div class="col-12 my-2">
                                        <button type="submit" class="btn btn-sm btn-light-green"
                                            style="border: none !important; box-shadow: none !important;">Guardar
                                            Reserva</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Columna para el calendario -->
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
                        <div class="calendar">
                            <ol class="day-names">
                                <li>Do</li>
                                <li>Lu</li>
                                <li>Ma</li>
                                <li>Mi</li>
                                <li>Ju</li>
                                <li>Vi</li>
                                <li>Sá</li>
                            </ol>
                            <ol class="days">
                                @php
                                    $mesActual = date('n');
                                    $añoActual = date('Y');
                                    $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $mesActual, $añoActual);
                                    $primerDiaDelMes = \Carbon\Carbon::create($añoActual, $mesActual, 1);
                                    $primerDiaSemana = $primerDiaDelMes->dayOfWeek;

                                    //Arreglo de días con reservas para este mes
                                    $diasConReserva = [];

                                    foreach ($reservas as $reserva) {
                                        $fechaReserva = \Carbon\Carbon::parse($reserva->fecha_salida);
                                        $mesReserva = $fechaReserva->month;
                                        $añoReserva = $fechaReserva->year;
                                        $diaReserva = $fechaReserva->day;

                                        if ($mesReserva == $mesActual && $añoReserva == $añoActual) {
                                            $diasConReserva[] = $diaReserva;
                                        }
                                    }
                                @endphp
                                @for ($dia = 1 - $primerDiaSemana; $dia <= $diasEnMes; $dia++)
                                    <li class="day-has-reservation">
                                        @if ($dia > 0)
                                            <div class="date">{{ $dia }}</div>
                                            @if (in_array($dia, $diasConReserva))
                                                @foreach ($reservas as $reserva)
                                                    @php
                                                        $fechaReserva = \Carbon\Carbon::parse($reserva->fecha_salida);
                                                        $mesReserva = $fechaReserva->month;
                                                        $añoReserva = $fechaReserva->year;
                                                        $diaReserva = $fechaReserva->day;
                                                    @endphp
                                                    @if ($mesReserva == $mesActual && $añoReserva == $añoActual && $diaReserva == $dia)
                                                        <div class="event">{{-- {{ $reserva->vehiculo }} --}} </div>
                                                        <div class="event-info">
                                                            Vehículo: {{ $reserva->vehiculo }}<br>
                                                            Fecha de reserva:
                                                            {{-- {{ str_replace('00:00:00', '', $reserva->fecha_salida) }}<br> --}}

                                                            {{ date('d/m/Y', strtotime($reserva->fecha_salida)) }}<br>
                                                            Dias de renta: {{ $reserva->dias_renta }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    </li>
                                @endfor

                            </ol>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if (session('success'))
            <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'La reserva se ha guardado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const fechaSalida = flatpickr("#fecha_salida", {
                    minDate: "2024-01-01",
                    maxDate: "2024-12-31",
                    dateFormat: "d-m-Y",
                    onChange: function(selectedDates, dateStr, instance) {
                        validarFechas();
                    }
                });

                const fechaEntrada = flatpickr("#fecha_entrada", {
                    minDate: "2024-01-01",
                    maxDate: "2025-12-31",
                    dateFormat: "d-m-Y",
                    onChange: function(selectedDates, dateStr, instance) {
                        validarFechas();
                    }
                });

                // Función para validar que la fecha de salida no sea mayor a la fecha de entrada
                function validarFechas() {
                    const fechaSalidaValor = fechaSalida.selectedDates[0];
                    const fechaEntradaValor = fechaEntrada.selectedDates[0];

                    if (fechaSalidaValor && fechaEntradaValor) {
                        if (fechaSalidaValor > fechaEntradaValor) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'La fecha de salida no puede ser mayor a la fecha de entrada.',
                                confirmButtonText: 'Aceptar'
                            });
                            /* fechaSalida.clear(); */
                        }
                    }
                }

                // Inicializa los select personalizados
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
                            summary.innerText = text;
                        }

                        select.removeAttribute("open");
                    });
                });

                // Limpia los campos de entrada de precio y comisión
                const precioDiaInput = document.getElementById('precio_dia');
                const comisionInput = document.getElementById('comision');

                function limpiarInput(event) {
                    this.value = this.value.replace(/[^0-9.]/g, '');
                    const parts = this.value.split('.');
                    if (parts.length > 2) {
                        this.value = parts[0] + '.' + parts.slice(1).join('');
                    }
                }

                precioDiaInput.addEventListener('input', limpiarInput);
                comisionInput.addEventListener('input', limpiarInput);

                // Funciones para el color picker y la fecha actual
                const lang = navigator.language;
                const $colorPicker = document.getElementById("colorPicker");
                /*
                                const getActualDate = (lang) => {
                                    const date = new Date();
                                    return {
                                        dayNumber: date.getDate(),
                                        month: date.getMonth(),
                                        dayName: date.toLocaleString(lang, {
                                            weekday: "long"
                                        }),
                                        monthName: date.toLocaleString(lang, {
                                            month: "long"
                                        }),
                                        year: date.getFullYear()
                                    };
                                };

                                const innerText = (el, text) => {
                                    document.querySelector(el).innerText = text;
                                };

                                const {
                                    dayNumber,
                                    month,
                                    dayName,
                                    monthName,
                                    year
                                } = getActualDate(lang);
                                innerText("#monthName", monthName);
                                innerText("#dayName", dayName);
                                innerText("#dayNumber", dayNumber);
                                innerText("#year", year);

                                // Color Picker
                                $colorPicker.addEventListener("input", (event) => {
                                    document.documentElement.style.setProperty("--calendar-color", event.target.value);
                                }); */
            });
        </script>
    @endsection
