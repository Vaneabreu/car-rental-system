<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferrentcar - Login</title>
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


        .container {
            width: 400px;
            padding: 10px 50px;
            background-color: rgb(7, 7, 7) !important;
            box-shadow: 1px 3px 5px 1px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .container:before {
            content: "";
            position: absolute;
            width: 100px;
            height: 200px;
            background: rgba(0, 0, 0, 0.01);
            transform: rotate(-45deg);
            bottom: -70px;
            left: -20px;
            border: solid rgba(0, 0, 0, 0.01);
        }

        .container input:focus {
            outline: 0;
        }

        #user,
        #Pass {
            position: sticky;
            height: 50px;
        }

        .container label {
            position: absolute;
            top: 26px;
            left: 10px;
            z-index: 1;
            /* color: gray; */
            transition: .2s;
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
        }

        body {

            background-color: rgb(2, 2, 2) !important;
            color: white;
        }

        @media (min-width: 410px) {
            .container {
                width: 400px;
            }

            #remember label {
                font-size: 10pt;
            }

            #forgot {
                font-size: 10pt;
            }


            #user label {
                margin-bottom: 5px;
                font-size: 12px;
                color: gray;
            }

            #Pass label {
                margin-top: 10px;
                font-size: 12px;
                color: gray;
            }

        }

        .form-control {
            border: 1px solid #41802a91; /* Color y grosor del borde */
            border-radius: 5px;
            background: black;
            color: #f5f4f4;
            outline: none;
        }

        .form-control:focus {
            border-color: #41802a91 !important;
            box-shadow: none !important;
        }


    </style>
</head>

<body>
    <div class="login">
        <div class="container">
            <div id="login-logo">
                <div id="border">
                    {{-- <i class="fa fa-lock"></i> --}}
                    <img src="/assets/img/carlogo.jpg" alt="Logo" width="120" height="120"
                        class="rounded-circle">
                    <div id="shadow"></div>
                </div>
                {{-- <div id="elzero">Fernandez Rent A Car</div> --}}
            </div>
            <br>
            <form autocomplete="off" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <h6>Correo electrónico</h6>
                            <input id="email" type="text"
                                class="form-control text-white @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required
                                style="background-color: black;" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <h6>Contraseña</h6>
                            <input id="password" type="password"
                                class="form-control text-white @error('password') is-invalid @enderror" name="password" required
                                style="background-color: black;">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                {{-- <div id="remember">
                    <input type="checkbox" name="" id="checkbox" />
                    <label for="checkbox">Recordarme</label>
                    <span id="forgot">
                        <a href="#">¿Olvidó su contraseña?</a>
                    </span>
                </div> --}}
                <input type="submit" value="Iniciar Sesión" />
            </form>
        </div>
    </div>
</body>

</html>
<script>
    // Desactivar el autocompletado para el campo de correo electrónico
    document.getElementById("email").addEventListener("focus", function() {
        this.setAttribute("autocomplete", "off");
    });

    // Desactivar el autocompletado para el campo de contraseña
    document.getElementById("password").addEventListener("focus", function() {
        this.setAttribute("autocomplete", "off");
    });
</script>

