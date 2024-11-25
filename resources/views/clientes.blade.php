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
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <title>Fernandez Rent Car </title>

    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-md-8">
                    <div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
                        <div class="card-create">
                            <div class="card-header" style="font-weight: bold;"> {{ __('Registrar Cliente') }}</div>

                            <div class="card-body">

                                <form class="row g-3" method="POST" action="{{ route('clientes.store') }}">
                                    @csrf

                                    <div class="col-md-6 mb-2">
                                        <label for="nombre" class="form-label">Nombre<span
                                                class="required-asterisk"></span></label>
                                        <input type="text" class="form-control" name="nombre" id="nombre">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="apellido" class="form-label">Apellido<span
                                                class="required-asterisk"></span></label>
                                        <input type="text" class="form-control" name="apellido" id="apellido">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="telefono" class="form-label">Teléfono<span
                                                class="required-asterisk"></span></label>
                                        <input type="text" class="form-control" name="telefono" id="telefono"
                                            maxlength="10" pattern="\d*" title="El teléfono debe contener solo números"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" id="direccion"
                                            placeholder="La torre, calle A">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="cedula" class="form-label">Identificación</label>
                                        <input type="text" class="form-control" name="cedula" id="cedula"
                                            maxlength="11" placeholder="Ingrese la cédula" required
                                            aria-describedby="cedulaHelp">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="genero" class="form-label">Género</label>
                                        <details id="genero" class="alternative-select" custom-select>
                                            <summary custom-toggle>
                                                Selecciona un género
                                            </summary>
                                            <ul custom-options class="alternative-select" custom-select>
                                                <li custom-option data-value="Femenino">Femenino</li>
                                                <li custom-option data-value="Masculino">Masculino</li>
                                            </ul>
                                        </details>
                                    </div>
                                    <input type="hidden" id="genero-hidden" name="genero" />

                                    <div class="col-12 my-2">
                                        <button type="submit" class="btn btn-sm btn-green">Ingresar</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const telefonoInput = document.getElementById('telefono');

                telefonoInput.addEventListener('input', function() {
                    let value = telefonoInput.value.replace(/\D/g, '');

                    if (value.length > 10) {
                        value = value.slice(0, 10);
                    }
                    telefonoInput.value = value;
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const cedulaInput = document.getElementById('cedula');

                cedulaInput.addEventListener('input', function() {
                    let value = cedulaInput.value;

                    value = value.replace(/[^0-9]/g, '');

                    if (value.length > 11) {
                        value = value.slice(0, 11);
                    }

                    cedulaInput.value = value;
                });

                cedulaInput.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text');
                    const cleanData = pastedData.replace(/[^0-9]/g, '').slice(0, 11);
                    document.execCommand('insertText', false, cleanData);
                });
            });

            const customSelectors = document.querySelectorAll("[custom-select]");

            customSelectors.forEach((select) => {
                const selectToggle = select.querySelector("[custom-toggle]");
                const selectOptionsContainer = select.querySelector("[custom-options]");
                const hiddenInput = document.getElementById('genero-hidden');

                selectOptionsContainer.addEventListener("click", (event) => {
                    const target = event.target;

                    if (target.hasAttribute('custom-option')) {
                        const value = target.getAttribute("data-value");
                        const text = target.innerText;

                        selectToggle.innerText = text;
                        hiddenInput.value = value;
                        select.removeAttribute("open");
                        console.log('Género seleccionado:', value);
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const nombreInput = document.getElementById('nombre');
                const apellidoInput = document.getElementById('apellido');

                function permitirSoloLetras(event) {
                    const regex = /[^a-zA-Z\s]/g;

                    this.value = this.value.replace(regex, '');
                }

                nombreInput.addEventListener('input', permitirSoloLetras);

                apellidoInput.addEventListener('input', permitirSoloLetras);
            });
        </script>
    @endsection
