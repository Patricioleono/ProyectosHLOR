@extends('layouts.base')

@section('register_form')
    <div class="container mx-auto p4-10">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-xl">
            <div class="md:flex">
                <div class="w-full px-6 py-8 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-800">Formulario de Registro</h2>
                    <p class="mt-4 text-gray-600">Ingresa los campos para crear usuario.</p>
                    <form class="mt-6">
                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2" for="user">User</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="input_user" type="email" placeholder="correo@institucional.cl">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2" for="password">Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="input_pass" type="password" placeholder="minimo 5 caracteres">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2" for="nombres">Nombres</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="input_name" type="text" placeholder="Patricio Humberto">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2" for="apellido_paterno">Apellido
                                Paterno</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="input_last_name" type="text" placeholder="León">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2" for="apellido_materno">Apellido
                                Materno</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="input_sur_name" type="text" placeholder="Ormazabal">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2" for="rut">Rut/Dni</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="input_rut" type="text" placeholder="11.111.111-2">
                        </div>
                        <button
                            class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button" id="btn_agregar">Agregar Nuevo User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_register')
    <script>
        $(document).ready(function() {
            format_rut_init();

            $('#btn_agregar').on('click', function(event) {
                event.preventDefault();
                let email_user = $('#input_user').val();
                let pass_user = $('#input_pass').val();
                let name_user = $('#input_name').val();
                let last_name_user = $('#input_last_name').val();
                let sur_name_user = $('#input_sur_name').val();
                let rut = $('#input_rut').val();
                let dv_user = rut.split('-')[1];
                let rut_user = rut.split('-')[0].split('.').join('');

                const result_validation_front = validate_form(email_user, pass_user);
                if (result_validation_front == 200) {
                    $.ajax({
                        url: base_hlor + '/register_user',
                        type: 'POST',
                        data: {
                            str_email: email_user,
                            str_pass: pass_user,
                            str_name: name_user,
                            str_last_name: last_name_user,
                            str_sur_name: sur_name_user,
                            int_rut: rut_user,
                            str_dv: dv_user,
                        },
                        success: function(data) {
                            hlor_alert(data.message, 'success');
                        },
                        error: function(data) {
                            hlor_alert(data.message, 'error');
                        }
                    });
                } else {
                    hlor_alert('Error en Formulario verifique usuario/contraseña', 'error');
                }

            });
        });
    </script>
@endsection
