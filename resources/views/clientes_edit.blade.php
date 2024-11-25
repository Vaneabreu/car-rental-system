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


        <title>Fernandez Rent Car </title>

    </head>

    <body>
        <div class="container-edit">
            <div class="card" style="max-width: 600px;">
                <div class="card-header">
                    <h5>Editar Cliente</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                value="{{ $cliente->nombre_completo }}">
                        </div>

                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control"
                                value="{{ $cliente->telefono }}">
                        </div>

                        <div class="form-group">
                            <label for="direccion">Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control"
                                value="{{ $cliente->direccion }}">
                        </div>

                        <div class="form-group">
                            <label for="cedula">Cedula</label>
                            <input type="text" name="cedula" id="cedula" class="form-control"
                                value="{{ $cliente->cedula }}">
                        </div>

                        <button type="submit" class="btn btn-sm btn-green"
                            style="border: none !important; box-shadow: none !important;">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const nombreInput = document.getElementById('nombre');
                const direccionInput = document.getElementById('direccion');

                function permitirSoloLetras(event) {
                    const regex = /[^a-zA-Z\s]/g;

                    this.value = this.value.replace(regex, '');
                }

                nombreInput.addEventListener('input', permitirSoloLetras);

                direccionInput.addEventListener('input', permitirSoloLetras);
            });

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
        </script>
    @endsection
