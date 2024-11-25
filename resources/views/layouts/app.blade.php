<!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Scripts -->
  {{--    <script src="{{ asset('js/app.js') }}" defer></script> --}}

     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
     <link rel="stylesheet"
         href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;700&display=swap">

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@animxyz/core">

     <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <style>
         @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

         body {
             /*font-family: 'Montserrat', Helvetica, Arial, serif; */
             font-family: "Montserrat", Helvetica, Arial, serif;
             background: #000000;
             line-height: 1.45;
         }


         p {
             font-family: "Montserrat", Helvetica, Arial, serif;
             font-size: 1.1em;
             font-weight: 300;
             line-height: 1.7em;
             color: #999;
         }

         a,
         a:hover,
         a:focus {
             color: inherit;
             text-decoration: none;
             /*    transition: all 0.3s; */
             transition: margin-left 0.3s ease;
         }

         .navbar {
             padding: 15px 10px;
             background: rgb(7, 7, 7);
             border: none;
             border-radius: 0;
             margin-bottom: 40px;
             box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
             font-family: "Montserrat", Helvetica, Arial, serif;

         }

         .navbar-btn {
             box-shadow: none;
             outline: none !important;
             border: none;
         }

         .line {
             width: 100%;
             height: 1px;
             border-bottom: 1px dashed #ddd;
             margin: 40px 0;
         }

         .wrapper {
             display: flex;
             width: 100%;
             align-items: stretch;
         }

         #sidebar {

             min-width: 250px;
             max-width: 250px;
             background: rgb(7, 7, 7);
             color: #fff;
             transition: all 0.1s;
             box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.384);
             z-index: 1000;

         }

         #sidebar.active {
             margin-left: -250px;
             transition: all 0.3s ease;
         }

         #sidebar .sidebar-header {
             padding: 20px;
         }

         #sidebar ul p {
             color: #fff;
             padding: 10px;
         }

         #sidebar ul li a {
             padding: 10px;
             font-size: 1.1em;
             display: block;
         }

         #sidebar ul li a:hover {
             color: #fff;
             background: none;
         }

         #sidebar ul li.active>a,
         a[aria-expanded="true"] {
             color: none;
         }

         a[data-toggle="collapse"] {
             position: relative;

         }

         .dropdown-toggle::after {
             display: block;
             position: absolute;
             top: 50%;
             right: 20px;
             transform: translateY(-50%);
         }

         ul ul a {
             font-size: 0.9em !important;
             padding-left: 30px !important;
             background: #fff;
         }

         ul.CTAs {
             padding: 20px;
         }

         ul.CTAs a {
             text-align: center;
             font-size: 0.9em !important;
             display: block;
             border-radius: 5px;
             margin-bottom: 5px;
         }

         a.download {
             background: #fff;
             color: #fff;
         }

         a.article,
         a.article:hover {
             background: #73b95891 !important;
             color: #fff !important;

         }

         body,
         p,
         a,
         .navbar,
         .line,
         .wrapper,
         #sidebar,
         #sidebar .sidebar-header,
         #sidebar ul p,
         #sidebar ul li a,
         #sidebar ul li a:hover,
         #sidebar ul li.active>a,
         a[data-toggle="collapse"],
         ul ul a,
         ul.CTAs a,
         a.download,
         a.article,
         #content,
         .navbar-nav .nav-link {
             color: #ffffffe5;
         }

         #content {
             width: 100%;
             padding: 20px;
             min-height: 100vh;
             /*  transition: all 0.3s; */
             transition: margin-left 0.3s ease;

         }

         .btn-oval {
             border-radius: 50px;
             background-color: #73b95891 !important;
         }

         .circle {
             display: inline-block;
             width: 24px;
             height: 24px;
             border-radius: 50%;
             background-color: #73b95891 !important;
             text-align: center;
             line-height: 24px;
             color: rgb(0, 0, 0);
             margin-right: 10px;
         }

         #sidebar ul li a:hover {
             text-decoration: none;
             color: #73b95891;
             background: none;
             scale: 1.05;
             transition: 1ms;
             animation: ease-in;
         }

         div::-webkit-scrollbar {
             width: 8px;
         }

         div::-webkit-scrollbar-track {
             background-color: transparent;
         }

         div::-webkit-scrollbar-thumb {
             border-radius: 4px;
             background-color: #ccc;
         }

         div::-webkit-scrollbar-thumb:hover {
             background-color: #aaa;
         }

         .nav-item a {
             text-decoration: none;
             transition: color 0.3s;
             color: #ffffffe5;
         }

         .nav-item a:hover {
             color: #73b95891 !important;
             text-decoration: none;
         }

         .nav-li-content {
             display: flex;
             flex-flow: column;
             justify-content: center;
             text-align: start;

         }

         .list-unstyled {
             font-size: 16px;
         }

         @media (max-width: 768px) {
             #sidebar {
                 margin-left: -250px;
             }

             #sidebar.active {
                 margin-left: 0;
             }

             #sidebarCollapse span {
                 display: none;
             }

         }

         /* Estilos para el overlay de carga */
         #loading-overlay {
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background: rgba(0, 0, 0, 0.7);
             /* Fondo negro semi-transparente*/
             display: flex;
             justify-content: center;
             align-items: center;
             z-index: 9999;

         }

         .spinner {
             border: 8px solid #f3f3f3;
             /* Color de fondo del spinner*/
             border-top: 8px solid #73b95891;
             /* Color del spinner*/
             border-radius: 50%;
             width: 60px;
             height: 60px;
             animation: spin 1s linear infinite;
         }

         @keyframes spin {
             0% {
                 transform: rotate(0deg);
             }

             100% {
                 transform: rotate(360deg);
             }

         }

         * {
             -webkit-tap-highlight-color: transparent;
         }

         body.dark-theme #sidebar a {
             -webkit-tap-highlight-color: rgba(0, 0, 0, 0.2);
         }

         .search-input {
             margin-left: 10px;
             background-color: black;
             color: white;
             border: 2px solid transparent;
             outline: none;
             transition: border-color 0.3s;
             width: 230px;
         }
         .search-input:focus {
             border-color: #41802a91;
         }
     </style>

     @laravelPWA
 </head>

 <body class="dark-theme user-select-none">

     {{-- <div id="loading-overlay">
         <div class="spinner"></div>
     </div> --}}
     <div class="wrapper">

         <nav id="sidebar" xyz="fade left duration-10" class="xyz-in">
             <div class="sidebar-header" style="text-align: center;">
                 <img src="/assets/img/carlogo.jpg" width="150" height="150" class="rounded-circle">
             </div>

             <ul class="list-unstyled components">
                 @guest
                     {{--  @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesion') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                    @endif --}}
                 @else
                     <li class=" text-nowrap nav-li-content ">
                         <a href="#" onclick="location.href='/'" style="margin-left: 10px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-car-front-fill" viewBox="0 0 16 16">
                                 <path
                                     d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
                             </svg>
                             Vehiculos
                         </a>
                         <a href="#" onclick="location.href='/vehiculos/reservar'" style="margin-left: 10px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-calendar-date" viewBox="0 0 16 16">
                                 <path
                                     d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                                 <path
                                     d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                             </svg>
                             Crear reserva
                         </a>
                         <a href="#" onclick="location.href='/vehiculos/reservas/por-mes'" style="margin-left: 10px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-calendar2-check-fill" viewBox="0 0 16 16">
                                 <path
                                     d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zm9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5zm-2.6 5.854a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                             </svg>
                             Ver reservas
                         </a>
                         <a href="#" onclick="location.href='/vehiculos/estado-cuenta'" style="margin-left: 10px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                 <path
                                     d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                             </svg>
                             Estado de cuenta
                         </a>

                         <a href="#" onclick="location.href='/clientes/ver'" style="margin-left: 10px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-person-fill" viewBox="0 0 16 16">
                                 <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                             </svg>
                             Clientes
                         </a>
                         <a href="#" onclick="location.href='/clientes'" style="margin-left: 10px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                 <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                 <path fill-rule="evenodd"
                                     d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                             </svg>
                             Registrar cliente
                         </a>

                         <a href="#" onclick="location.href='/gastos'" style="margin-left: 10px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-cash-coin" viewBox="0 0 16 16">
                                 <path fill-rule="evenodd"
                                     d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                 <path
                                     d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                 <path
                                     d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                 <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                             </svg>
                             Gastos
                         </a>

                         <a href="#" onclick="location.href='/gastos/crear'" style="margin-left: 10px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-cash-coin" viewBox="0 0 16 16">
                                 <path fill-rule="evenodd"
                                     d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                 <path
                                     d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                 <path
                                     d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                 <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                             </svg>
                             Registrar Gasto
                         </a>

                         <a href="#" onclick="location.href='/cotizacion/crear'" style="margin-left: 10px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-cash-coin" viewBox="0 0 16 16">
                                 <path fill-rule="evenodd"
                                     d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                 <path
                                     d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                 <path
                                     d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                 <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                             </svg>
                             Cotizar Reserva
                         </a>

                         <a href="#" onclick="location.href='/cotizaciones'" style="margin-left: 10px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-cash-coin" viewBox="0 0 16 16">
                                 <path fill-rule="evenodd"
                                     d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                 <path
                                     d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                 <path
                                     d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                 <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                             </svg>
                             Cotizaciones
                         </a>

                         <script>
                             function logout() {
                                 window.location.href = "{{ route('logout') }}";
                             }
                         </script>

                     </li>

                     <hr style="border-top: 1px solid #ddd; margin: 10px 0;">

                     <h6 style="margin-left: 25px;">
                         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor"
                             class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                             <path
                                 d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                         </svg>
                         <strong>Clientes </strong>
                     </h6>

                     <input type="text" id="search" placeholder="Buscar cliente" class="search-input"
                         onkeyup="filterClientes()">

                     <div style="height: 320px; overflow-y: auto; scrollbar-width: thin; overflow-x: hidden;">
                         <div id="clientesList">
                             @php
                                 $clientesConReservas = $clientes->filter(function ($cliente) {
                                     return $cliente->reservas->isNotEmpty();
                                 });

                                 $clientesSinReservas = $clientes->filter(function ($cliente) {
                                     return $cliente->reservas->isEmpty();
                                 });

                                 $clientesOrdenados = $clientesConReservas->merge($clientesSinReservas);
                             @endphp

                             @foreach ($clientesOrdenados as $cliente)
                                 <li class="client-item" style="margin: 5px 0;">
                                     <a href="{{ route('clientes.edit', ['cliente' => $cliente->id]) }}"
                                     style="margin-left: 10px;">
                                         <span
                                             class="circle">{{ strtoupper(substr($cliente->nombre_completo, 0, 1)) }}</span>
                                         {{ $cliente->nombre_completo }}
                                     </a>
                                    </li>
                             @endforeach
                         </div>
                     </div>

                     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                     <script>
                         function filterClientes() {
                             const input = document.getElementById('search');
                             const filter = input.value.toLowerCase();
                             const div = document.getElementById('clientesList');
                             const clientItems = div.getElementsByClassName('client-item');

                             for (let i = 0; i < clientItems.length; i++) {
                                 const a = clientItems[i].getElementsByTagName("a")[0];
                                 const txtValue = a.textContent || a.innerText;
                                 if (txtValue.toLowerCase().indexOf(filter) > -1) {
                                     clientItems[i].style.display = ""; // Muestra el cliente
                                 } else {
                                     clientItems[i].style.display = "none"; // Oculta el cliente
                                 }
                             }
                         }
                     </script>

                 @endguest

         </nav>

         <div id="content">

             <nav xyz="fade up duration-10" class="navbar navbar-expand-lg xyz-in">
                 <div class="container-fluid">
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                         <ul class="nav navbar-nav ml-auto align-items-center">
                             <li class="nav-item mr-3">
                                 <a href="{{ route('logout') }}" {{-- id="logoutButton" --}}
                                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                         <path fill-rule="evenodd"
                                             d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                                         <path fill-rule="evenodd"
                                             d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                                     </svg>
                                     Cerrar sesión
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                         style="display: none;">
                                         @csrf
                                     </form>
                                 </a>

                             </li>
                             <li class="nav-item">
                                 <img src="/assets/img/carlogo.jpg" width="40" height="40"
                                     class="rounded-circle">
                             </li>
                         </ul>

                         <script>
                             function logout() {
                                 window.location.assign("{{ url('logout') }}");
                             }
                         </script>

                     </div>
                 </div>

             </nav>

             <main class="py-10">
                 @yield('content')
             </main>
         </div>
     </div>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
     <script>
         window.addEventListener("load", function() {
             const loadingOverlay = document.getElementById('loading-overlay');
             if (loadingOverlay) {
                 loadingOverlay.style.display = 'none';
                 console.log('Loading overlay hidden');
             } else {
                 console.log('Loading overlay not found');
             }
         });

         function changeContent(url) {
             fetch(url)
                 .then(response => response.text())
                 .then(html => {
                     document.getElementById('content').innerHTML = html;
                 })
                 .catch(error => console.error('Error loading content:', error));
         }
     </script>
 </body>
