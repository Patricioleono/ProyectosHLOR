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
            <div class="text-5xl mb-3">Cargando por favor espere...</div>
            <span class="loading loading-spinner loading-lg"></span>
        </div>
    </div>

    <div class="drawer lg:drawer-open">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="w-full navbar bg-base-200">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2"></div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal">
                        <!-- Navbar menu content here -->
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS Navbar component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <ul tabindex="0"
                                class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                                <!--al deslogear envioar a la seccion login-->
                                <li>
                                    <a id="logout">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>

            <!-- Page content here -->
            @yield('dashboard')

        </div>
        <div class="drawer-side">
            <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="p-3 menu w-48 min-h-full bg-base-200">
                <div class="w-32 mb-1"><img src="{{ asset('assets/img/logo.png') }}" alt=""></div>
                <!-- MODULOS -->
                <li>
                    <details>
                        <summary>
                            <span>icon</span> Modulos
                        </summary>
                        <ul>
                            <li>
                                <a>RRHH</a>
                            </li>
                            <li>
                                <a>Matronas</a>
                            </li>
                            <li>
                                <a>Mantención</a>
                            </li>
                            <li>
                                <a>Vales de gas</a>
                            </li>
                        </ul>
                    </details>
                </li>
                <!-- MANTENEDORES -->
                <li>
                    <details>
                        <summary>
                            <span>icon</span> Mantenedores
                        </summary>
                        <ul>
                            <li>
                                <a>RRHH</a>
                            </li>
                            <li>
                                <a>Matronas</a>
                            </li>
                            <li>
                                <a>Mantención</a>
                            </li>
                            <li>
                                <a>Vales de gas</a>
                            </li>
                        </ul>
                    </details>
                </li>


            </ul>
        </div>
    </div>

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
    @yield('script_dashboard')
</body>

</html>
