
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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
                    <div class="card-create ">
                        <div class="card-header"><b>{{ __('Editar Vehículo') }}</b></div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('vehiculos.actualizar', $vehiculo->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div style="position: relative; display: inline-block;">
                                            <img src="{{ Storage::url($vehiculo->imagen) }}" alt="Imagen del vehículo" style="max-width: 100px; height: auto; border-radius: 50%;">

                                            <label for="imagen_nueva" style="position: absolute; top: -5px; right: 5px; cursor: pointer; background: rgba(255, 255, 255, 0.8); border-radius: 50%; padding: 3px;">
                                                <i class="fas fa-camera" style="font-size: 1.5rem; color: black;"></i>
                                            </label>
                                            <input id="imagen_nueva" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" accept="image/*" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="año_vehiculo" class="col-form-label">{{ __('Año') }}</label>
                                        <input id="año_vehiculo" type="text"
                                            class="form-control @error('año_vehiculo') is-invalid @enderror"
                                            name="año_vehiculo" value="{{ $vehiculo->año_vehiculo }}" required autofocus>
                                        @error('año_vehiculo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="color" class="col-form-label">{{ __('Color') }}</label>
                                        <input id="color" type="text"
                                            class="form-control @error('color') is-invalid @enderror" name="color"
                                            value="{{ $vehiculo->color }}" required>
                                        @error('color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="marca" class="col-form-label">{{ __('Marca') }}</label>
                                        <input id="marca" type="text"
                                            class="form-control @error('marca') is-invalid @enderror" name="marca"
                                            value="{{ $vehiculo->marca }}" required>
                                        @error('marca')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="modelo" class="col-form-label">{{ __('Modelo') }}</label>
                                        <input id="modelo" type="text"
                                            class="form-control @error('modelo') is-invalid @enderror" name="modelo"
                                            value="{{ $vehiculo->modelo }}" required>
                                        @error('modelo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="matricula" class="col-form-label">{{ __('Matricula') }}</label>
                                        <input id="matricula" type="text"
                                            class="form-control @error('matricula') is-invalid @enderror" name="matricula"
                                            value="{{ $vehiculo->matricula }}" required>
                                        @error('matricula')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-sm btn-green" style="border: none !important; box-shadow: none !important;">Guardar</button>

                            </form>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('imagen_nueva').addEventListener('change', function() {
                const imgElement = document.querySelector('img[alt="Imagen del vehículo"]');
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        imgElement.src = e.target.result;
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        </script>

    @endsection
