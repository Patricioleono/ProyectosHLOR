<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Intranet</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <style>
        .cargando {
            width: 100%;
            height: 100%;
            overflow: hidden;
            top: 0px;
            left: 0px;
            z-index: 10000;
            text-align: center;
            position: absolute;
            background-color: #ffffff !important;
            opacity: 0.9;
            filter: alpha(opacity=40);
        }
    </style>
    <div id="cargando_pantalla" class="absolute z-10 h-full w-full flex items-center justify-center cargando hidden">
        <div class="flex flex-col items-center">
            <div class="text-5xl mb-3">Cargando Vista Principal</div>
            <span class="loading loading-spinner loading-lg"></span>
        </div>
    </div>

    @yield('register_form')
    @yield('login_form')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function bloquear_pantalla() {
            $("#cargando_pantalla").removeClass('hidden');
        }

        function desbloquear_pantalla() {
            $("#cargando_pantalla").addClass('hidden');
        }

        var regEX = /^[a-zA-Z0-9.!#$%&'*+\=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var base_hlor = "{{ url('/') }}";

    function verify_email(email) {
        let validate_email = regEX.exec(email);
        let result = validate_email ? true : false;

        return result;
    }

    function verify_password(pass) {
        let count = pass.length;
        let result = count >= 4 ? true : false;

        return result;
    }

    function validate_form(email, pass) {
        let result_email = verify_email(email);
        let result_pass = verify_password(pass);
        let result = result_email == true && result_pass == true ? 200 : 400;

        return result;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function hlor_alert(text, type_alert) {
        Swal.fire({
            title: `${text}`,
            icon: `${type_alert}`,
            timer: 3000
        });
    }

    </script>
    @yield('script_login')
    @yield('script_register')
</body>

</html>
