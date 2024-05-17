@extends('layouts.base')

@section('login_form')
    <div class="bg-no-repeat bg-cover bg-center relative" style="background-image: url({{ asset('assets/img/hlor.jpg') }});">
        <div class="absolute bg-gradient-to-b from-green-500 to-green-400 opacity-75 inset-0 z-0"></div>
        <div class="min-h-screen sm:flex sm:flex-row mx-0 justify-center">
            <div class="flex-col flex  self-center p-10 sm:max-w-5xl xl:max-w-2xl  z-10">
                <div class="self-start hidden lg:flex flex-col  text-white">
                    <h1 class="mb-3 font-bold text-5xl">Bienvenido!!</h1>
                    <p class="pr-3">Intranet interna DR. Hospital Leopoldo Ortega Rodriguez</p>
                </div>
            </div>
            <div class="flex justify-center self-center  z-10">
                <div class="p-12 bg-white mx-auto rounded-2xl w-100 ">
                    <div class="mb-4">
                        <h3 class="font-semibold text-2xl text-gray-800">Inicio Session </h3>
                        <p class="text-gray-500">Ingresa con tu cuenta intitucional</p>
                    </div>
                    <div class="space-y-5">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 tracking-wide">Usuario</label>
                            <input
                                class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                                type="email" placeholder="mail@saludaysen.cl" id="input_user">
                        </div>
                        <div class="space-y-2">
                            <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">Contraseña</label>
                            <input
                                class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                                type="password" placeholder="Ingresa Contraseña" id="input_pass">
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full flex justify-center bg-green-400  hover:bg-green-500 text-gray-100 p-3  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500"
                                id="btn_ingresar">Ingresar</button>
                        </div>
                        <div class="pt-5 text-center text-gray-400 text-xs">Creado con ❤ Departamento de TI Hlor</div>
                    </div>
                </div>
            </div>
        @endsection

        @section('script_login')
            <script>
                $(document).ready(function() {

                    $('#btn_ingresar').on('click', function(event) {
                        event.preventDefault();
                        let user = $('#input_user').val();
                        let pass = $('#input_pass').val();

                        const result = validate_form(user, pass);

                        if (result == 200) {
                            $.ajax({
                                url: base_hlor + "/login",
                                type: "POST",
                                dataType: "JSON",
                                data: {
                                    email: user,
                                    password: pass
                                },
                                beforeSend: function() {
                                    bloquear_pantalla();
                                },
                                success: function(data) {
                                    $('#input_user').val('');
                                    $('#input_pass').val('');
                                    if (data.status != 200) {
                                        hlor_alert(data.message, 'error');
                                    } else {
                                        if (data.status != 200) {
                                            hlor_alert(data.message, 'error');

                                        } else {
                                            redirect_to("/dashboard", 'GET');
                                            desbloquear_pantalla();
                                        }
                                    }
                                },
                                error: function(data) {
                                    hlor_alert(data, 'error');
                                }
                            });
                        } else {
                            $('#input_user').val('');
                            $('#input_pass').val('');

                            hlor_alert('Usuario o contraseña incorrectos', 'error');
                        }
                    });

                });
            </script>
        @endsection
