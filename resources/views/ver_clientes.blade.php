{{-- NEW --}}
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="container">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('clientes.create') }}" class="btn btn-sm btn-light-green outline-none"
                role="button">Registrar
                cliente</a>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card-create">
                        <div class="card-header" style="font-size: 18px;">{{ __('Clientes Registrados') }}</div>
                        <div class="card-body">
                            <form class="row g-2 mb-2" method="GET" action="{{ route('ver.clientes') }}"
                                onsubmit="return validateForm()">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" id="search"
                                            placeholder="Buscar clientes">
                                        <button type="submit" class="btn btn-sm btn-light-green" id="search-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- <div id="error-message" style="display: none; color: red;">Por favor, inserta un
                                            nombre antes de buscar.</div> -->
                                </div>
                            </form>

                            <a href="/clientes/ver" class="custom-btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#FFFFFF"
                                    class="bi bi-arrow-clockwise "
                                    style="position: relative; left: 98%; margin-bottom: 10px;" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                    <path
                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                </svg>
                            </a>
                            @if ($clienteExiste)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        {{-- <th scope="col">Apellido</th> --}}
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Cedula</th>
                                        <th scope="col">Dirección</th>
                                        <th scope="col">Género</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientesAll as $cliente)
                                    <tr>
                                        <td>{{ $cliente->nombre_completo }}</td>
                                        {{-- <td>{{ $cliente->apellido }}</td> --}}
                                        <td>{{ $cliente->telefono }}</td>
                                        <td>{{ $cliente->cedula }}</td>
                                        <td>{{ $cliente->direccion }}</td>
                                        <td>{{ $cliente->genero }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-light-green"
                                                data-toggle="modal"
                                                data-target="#editModal{{ $cliente->id }}">Editar</a>
                                            <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                                method="POST" style="display: inline-block;"
                                                onsubmit="return confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light-red"
                                                    style="border: none !important; box-shadow: none !important;">Eliminar</button>
                                            </form>


                                            <!-- Modal de Edición -->
                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                                            <div class="modal fade" id="editModal{{ $cliente->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editarModalLabel{{ $cliente->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="background: rgb(7, 7, 7); color: white;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editModalLabel{{ $cliente->id }}">Editar
                                                                Cliente</h5>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form
                                                                action="{{ route('clientes.update', $cliente->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="nombre_completo">Nombre</label>
                                                                            <input type="text"
                                                                                name="nombre_completo"
                                                                                id="nombre_completo"
                                                                                class="form-control"
                                                                                value="{{ $cliente->nombre }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="apellido">Apellido</label>
                                                                            <input type="text"
                                                                                name="apellido" id="apellido"
                                                                                class="form-control"
                                                                                value="{{ $cliente->apellido }}">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="telefono">Telefono</label>
                                                                            <input type="text"
                                                                                name="telefono" id="telefono"
                                                                                class="form-control"
                                                                                value="{{ $cliente->telefono }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="direccion">Direccion</label>
                                                                            <input type="text"
                                                                                name="direccion"
                                                                                id="direccion"
                                                                                class="form-control"
                                                                                value="{{ $cliente->direccion }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="cedula">Cedula</label>
                                                                            <input type="text"
                                                                                name="cedula" id="cedula"
                                                                                class="form-control"
                                                                                value="{{ $cliente->cedula }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="genero">Género</label>
                                                                            <select name="genero" id="genero" class="form-control">
                                                                                <option value="Femenino" {{ $cliente->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                                                                <option value="Masculino" {{ $cliente->genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-sm btn-light-red" data-dismiss="modal">Cerrar Modal</button>

                                                            <script>
                                                                $(document).ready(function() {

                                                                    $('a.btn-light-green').on('click', function() {
                                                                        var targetModal = $(this).data('target');
                                                                        $(targetModal).modal('show');
                                                                    });
                                                                });
                                                            </script>

                                                            <button type="submit"
                                                                class="btn btn-sm btn-green">Guardar
                                                                Cambios</button>
                                                        </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                        </div>
                        </td>
                        </tr>
                        @endforeach

                        </tbody>
                        </table>

                        <div class="pagination">
                            @if ($clientesAll->currentPage() > 1)
                            <span class="page-item">
                                <a href="{{ $clientesAll->previousPageUrl() }}"
                                    class="btn btn-sm btn-light-green" id="prev-link">Anterior</a>
                            </span>
                            @endif

                            @if ($clientesAll->hasMorePages())
                            <span class="page-item">
                                <a href="{{ $clientesAll->nextPageUrl() }}"
                                    class="btn btn-sm btn-light-green" id="next-link">Siguiente</a>
                            </span>
                            @endif
                        </div>

                        <div class="page-info">
                            Página {{ $clientesAll->currentPage() }} de {{ $clientesAll->lastPage() }}
                        </div>
                        @else
                        @if (!$search)
                        <div id="empty-search-message" style="color: red;">Por favor, inserta un nombre
                            antes de buscar.</div>
                        @else
                        <div style="color: red;">No se encontraron clientes con el nombre especificado.
                        </div>
                        @endif
                        @endif

                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
                        <script>
                            $(document).ready(function() {
                                // Quita el enfoque al enlace "Anterior" y "Siguiente" después de hacer clic
                                $('#prev-link, #next-link').click(function() {
                                    $(this).blur();
                                });

                                // Función para abrir el modal cuando se hace clic en el botón "Editar"
                                $('a.btn-light-green').on('click', function() {
                                    var targetModal = $(this).data(
                                        'target'); // Obtiene el ID del modal desde el atributo data-target
                                    $(targetModal).modal('show'); // Abre el modal
                                });

                            });

                            // Función para validar el formulario
                            function validateForm() {
                                const searchInput = document.getElementById('search').value.trim();
                                const errorMessage = document.getElementById('error-message');
                                const emptySearchMessage = document.getElementById('empty-search-message');
                                if (searchInput === '') {
                                    errorMessage.style.display = 'block';
                                    emptySearchMessage.style.display = 'none';
                                    return false;
                                }
                                emptySearchMessage.style.display = 'none';
                                errorMessage.style.display = 'none';
                                return true;
                            }

                            // Función para confirmar la eliminación
                            function confirmDelete(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: '¿Estás seguro?',
                                    text: "¡No podrás revertir esto!",
                                    showCancelButton: true,
                                    confirmButtonColor: '#73b95891',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Sí, eliminarlo'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        event.target.submit();
                                    }
                                });
                            }

                            // Función para permitir solo letras en campos de texto
                            function permitirSoloLetras(event) {
                                const regex = /[^a-zA-Z\s]/g;
                                this.value = this.value.replace(regex, '');
                            }

                            // Función para limitar la entrada de números a un máximo de 10 dígitos
                            function limitarNumeros(input, maxLength) {
                                input.addEventListener('input', function() {
                                    let value = this.value.replace(/\D/g, '');
                                    if (value.length > maxLength) {
                                        value = value.slice(0, maxLength);
                                    }
                                    this.value = value;
                                });
                            }

                            // Función para limitar la entrada de texto a un máximo de longitud
                            function limitarTexto(input, maxLength) {
                                input.addEventListener('input', function() {
                                    let value = this.value;
                                    if (value.length > maxLength) {
                                        value = value.slice(0, maxLength);
                                    }
                                    this.value = value;
                                });
                            }

                            // Asignar eventos de entrada a los campos cuando el contenido del DOM esté cargado
                            document.addEventListener('DOMContentLoaded', function() {
                                const nombreInput = document.getElementById('nombre_completo');
                                const apellidoInput = document.getElementById('apellido');
                                const telefonoInput = document.getElementById('telefono');
                                const cedulaInput = document.getElementById('cedula');

                                nombreInput.addEventListener('input', permitirSoloLetras);
                                apellidoInput.addEventListener('input', permitirSoloLetras);

                                limitarNumeros(telefonoInput, 10);
                                limitarTexto(cedulaInput, 11);

                                // Manejo del evento de pegado en el campo de cédula
                                cedulaInput.addEventListener('paste', function(e) {
                                    e.preventDefault();
                                    const pastedData = e.clipboardData.getData('text');
                                    const cleanData = pastedData.replace(/[^0-9]/g, '').slice(0, 11);
                                    document.execCommand('insertText', false, cleanData);
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
@endsection
