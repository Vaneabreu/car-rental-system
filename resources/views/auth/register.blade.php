{{-- @extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de inicio de sesión</title>
    <!-- Agrega el enlace al archivo de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Agrega el enlace al archivo de Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        @import url('https://fonts.googleapis.com/css?family=Josefin+Sans');

        body {
            padding: 0;
            margin: 0;
            /* background: #000000; */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        html {
            height: 100%;
            position: relative;
        }

        * {
            padding: 0;
            margin: 0;
            list-style-type: none;
            box-sizing: border-box;
            font-family: 'Josefin Sans', sans-serif;
        }



        .login input[type=submit] {
            width: 90%;
            height: 25px;
            margin: 20px auto;
            font-size: 12pt;
            border: none;
            color: #f5f4f4;
            /*  color: black !important; */

            background: #41802a91;
            margin-left: 50%;
            transform: translate(-50%, 0);
            border-radius: 6px;
        }

        .userLabel {
            transform: translate(-5px, -22px);
            font-size: 7pt;
            transition: .3s;
            color: #41802a91 !important;
        }

        .passLabel {
            transform: translate(-5px, -22px);
            font-size: 9pt;
            transition: .3s;
            color: #41802a91 !important;
        }

        #user:before {
            content: "\f007";
            position: absolute;
            right: 10px;
            top: 26px;
            z-index: 1;
            font-family: fontawesome;
            font-size: 10pt;
            /* color: gray; */
        }

        #Pass:before {
            content: "\f023";
            position: absolute;
            right: 10px;
            top: 26px;
            z-index: 1;
            font-family: fontawesome;
            font-size: 12pt;
            /* color: gray; */
        }

        #forgot {
            float: right;
            margin: 1px 5px;
            font-size: 7pt;
        }

        #forgot a {
            text-decoration: none;
            color: #41802a91;
        }

        #checkbox {
            display: none;
        }

        #checkbox+label:before {
            content: "\f096";
            position: absolute;
            font-family: fontawesome;
            left: -20px;
        }

        #checkbox:checked+label:before {
            content: "\f046";
            position: absolute;
        }

        #login-logo #border {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #41802a91;
            position: relative;
            margin: 0 auto;
            overflow: hidden;
        }

        #login-logo #shadow {
            width: 100%;
            height: 50%;
            position: absolute;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 40px;
            left: -36px;
            bottom: 10px;
            transform: rotate(-35deg);
        }

        .black-modal .modal-content {
            background-color: rgb(7, 7, 7) !important;
            color: white;

        }

        .card {
            background-color: rgb(7, 7, 7) !important;
            color: #ffffff;
            border-radius: 10px !important;
            height: 320px;
            width: 200%;
        }

        body {

            background-color: rgb(2, 2, 2) !important;
            color: white;
        }

        .form-control {
            border: 1px solid #41802a91;
            /* Color y grosor del borde */
            border-radius: 5px;
            background: black;
            color: #f5f4f4;
            outline: none;
        }

        .form-control:focus {
            border-color: #41802a91 !important;
            box-shadow: none !important;
        }

        .btn-light-green {
            background-color: #73b95891 !important;
            color: #ffffff;
        }
    </style>
</head>

<body>
    {{-- <div class="container"> --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register User') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control text-white @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}"{{--  required autocomplete="name" --}}
                                        style="background-color: black;" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control text-white @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" {{-- required autocomplete="email" --}}
                                        style="background-color: black;" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control text-white @error('password') is-invalid @enderror"
                                        name="password" {{-- required autocomplete="new-password" --}}
                                        style="background-color: black;" autofocus>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control text-white"
                                        name="password_confirmation" {{-- required autocomplete="new-password" --}}
                                        style="background-color: black;" autofocus>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4 text-end">
                                    <button type="submit" class="btn btn-sm btn-light-green">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
   {{--  </div> --}}
</body>

</html>
