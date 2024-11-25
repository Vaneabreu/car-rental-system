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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <title>Fernandez Rent Car </title>

    </head>

    <body>
        <div class="container" id="centrado-vertical-horizontal">
            <div class="row justify-content-center dark-mode">
                <div class="col-md-8">
                    <div class="card-create">
                        <div class="card-header"><b>{{ __('Registrar Vehículo') }}</b></div>

                        {{--   <div class="card-body">
                            <form class="row g-3" method="POST" action="{{ route('vehiculos.store') }}">
                                @csrf
                                <div class="col-md-6">
                                    <label for="año_vehiculo" class="form-label">Año<span class="required-asterisk"></span></label>
                                    <input type="text" class="form-control" name="año_vehiculo" id="año_vehiculo" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" class="form-control" name="color" id="color">
                                </div>
                                <div class="col-12">
                                    <label for="marca" class="form-label">Marca<span class="required-asterisk"></span></label>
                                    <input type="text" class="form-control" name="marca" id="marca"
                                        placeholder="Marca del vehiculo">
                                </div>
                                <div class="col-12">
                                    <label for="modelo" class="form-label">Modelo<span class="required-asterisk"></span></label>
                                    <input type="text" class="form-control" name="modelo" id="modelo"
                                        placeholder="Modelo del vehiculo">
                                </div>
                                <div class="col-md-6">
                                    <label for="matricula" class="form-label">Matricula</label>
                                    <input type="text" class="form-control" name="matricula" id="matricula">
                                </div>
                                <div class="col-md-6">
                                    <label for="placa" class="form-label">Placa</label>
                                    <input type="text" class="form-control" name="placa" id="placa">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-sm btn-light-green"
                                        style="border: none !important; box-shadow: none !important;">Ingresar</button>
                                </div>


                            </form>
                        </div> --}}

                        <div class="card-body">
                            <form class="row g-3" method="POST" action="{{ route('vehiculos.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="año_vehiculo" class="form-label">Año<span
                                            class="required-asterisk"></span></label>
                                    <input type="text" class="form-control" name="año_vehiculo" id="año_vehiculo"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" class="form-control" name="color" id="color">
                                </div>

                                <div class="col-12">
                                    <label for="marca" class="form-label">Marca<span
                                            class="required-asterisk"></span></label>
                                    <input type="text" class="form-control" name="marca" id="marca"
                                        placeholder="Marca del vehiculo">
                                </div>

                                <div class="col-12">
                                    <label for="modelo" class="form-label">Modelo<span
                                            class="required-asterisk"></span></label>
                                    <input type="text" class="form-control" name="modelo" id="modelo"
                                        placeholder="Modelo del vehiculo">
                                </div>

                                <div class="col-md-6">
                                    <label for="matricula" class="form-label">Matricula</label>
                                    <input type="text" class="form-control" name="matricula" id="matricula">
                                </div>

                                <div class="col-md-6">
                                    <label for="placa" class="form-label">Placa</label>
                                    <input type="text" class="form-control" name="placa" id="placa">
                                </div>

                                <div class="col-12">
                                    <label for="imagen" class="form-label">Subir Imagen<span
                                            class="required-asterisk"></span></label>
                                    <div
                                        style="position: relative; display: inline-block; width: 100px; height: 100px; margin-top: 10px;">
                                        <input type="file" class="form-control" name="imagen" id="imagen"
                                            accept="image/*" required style="display: none;" onchange="previewImage(event)">
                                        <label for="imagen"
                                            style="width: 100%; height: 100%; border-radius: 50%; background: rgba(75, 74, 74, 0.1); display: flex; justify-content: center; align-items: center; cursor: pointer; overflow: hidden;">
                                            <img id="imagePreview" src="" alt="Imagen"
                                                style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; position: absolute; top: 0; left: 0; display: none;">
                                            <i id="cameraIcon" class="fas fa-camera"
                                                style="font-size: 2rem; color: black;"></i>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-sm btn-green"
                                        style="border: none !important; box-shadow: none !important;">Ingresar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('success'))
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                @endif
            });
        </script>

        <script>
            function previewImage(event) {
                const file = event.target.files[0];
                const reader = new FileReader();
                const imagePreview = document.getElementById('imagePreview');
                const cameraIcon = document.getElementById('cameraIcon');

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    cameraIcon.style.display = 'none';
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            }
        </script>
    @endsection
