@extends('layouts.dashboard')

@section('matronas_view')
    <div class="m-5 grid grid-rows-auto gap-4">
        <div class="grid">
            <div class="col-end-12 ms-96">
                <button class="btn btn-outline btn-success ms-96" onclick="ingreso_nuevo_paciente.showModal()">Ingresar nuevo Paciente</button>
            </div>
        </div>
        <div class="grid grid-cols-auto">
            <div class="overflow-x-auto">
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre Completo</th>
                                <th>Atendido Por</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>
                                    <button class="btn btn-outline btn-info" onclick="ver_historial.showModal()">Ver Historial</button>
                                    <button class="btn btn-outline btn-error" onclick="alta.showModal()">Dar de Alta</button>
                                </td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>
                                    <button class="btn btn-outline btn-info">Ver Historial</button>
                                    <button class="btn btn-outline btn-error">Dar de Alta</button>
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>
                                    <button class="btn btn-outline btn-info">Ver Historial</button>
                                    <button class="btn btn-outline btn-error">Dar de Alta</button>
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>
                                    <button class="btn btn-outline btn-info">Ver Historial</button>
                                    <button class="btn btn-outline btn-error">Dar de Alta</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals_matronas')
    <dialog id="ingreso_nuevo_paciente" class="modal">
        <div class="modal-box max-w-3xl">
            <h3 class="font-bold text-lg"><i class="fa-solid fa-user-plus"></i> Ingreso Nuevo Paciente</h3>
            <form class="mt-6">

                <div class="grid grid-cols-2 gap-1">
                   <label class="input input-bordered flex items-center w-full gap-2">
                       Nombres: <input type="text" class="grow" placeholder=" Ingrese Nombres" id="input_nombres"/>
                   </label>
                   <label class="input input-bordered flex items-center w-full gap-2">
                       Apellido P: <input type="text" class="grow" placeholder=" Ingrese Apellido Paterno" id="input_apellido_paterno"/>
                   </label>
                   <label class="input input-bordered flex items-center w-full gap-2">
                       Apellido M: <input type="text" class="grow" placeholder=" Ingrese Apellido Materno" id="input_apellido_materno"/>
                   </label>
                   <label class="input input-bordered flex items-center w-full gap-2">
                       Dirección: <input type="text" class="grow" placeholder=" Ingrese Dirección" id="input_direccion"/>
                   </label>
                   <label class="input input-bordered flex items-center w-full gap-2">
                       Rut: <input type="text" class="grow" placeholder=" Ingrese Rut" id="input_rut"/>
                   </label>
                    <label class="input input-bordered flex items-center w-full gap-2">
                        Previsión: <input type="text" class="grow" placeholder=" Ingrese Previsión" id="input_prevision_social"/>
                    </label>
                    <label class="input input-bordered flex items-center w-full gap-2">
                        Nacionalidad: <input type="text" class="grow" placeholder=" Ingrese Nacionalidad" id="input_nacionalidad"/>
                    </label>
                    <label class="input input-bordered flex items-center w-full gap-2">
                        Telefono: <input type="text" class="grow" placeholder=" Ingrese Telefono" id="input_telefono"/>
                    </label>

                   <label class="form-control w-full">
                       <div class="label">
                           <span class="label-text">Fecha de Nacimiento</span>
                       </div>
                       <input type="date" class="input input-bordered w-full" id="input_fecha_nacimiento"/>
                   </label>
                   <label class="form-control w-full">
                       <div class="label">
                           <span class="label-text">Motivo PAP</span>
                       </div>
                       <select class="select select-bordered w-full" id="input_motivo_pap">
                           <option selected>Seleccione Motivo</option>
                           <option value="0">PAP No Realizado</option>
                           <option value="1">PAP Atrasado</option>
                           <option value="2">Repetir PAP</option>
                       </select>
                   </label>
                </div>
                <div class="grid grid-rows-1">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Fecha PAP</span>
                        </div>
                        <input type="date" class="input input-bordered w-full" id="input_fecha_pap"/>
                    </label>
                </div>

            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-outline btn-success" id="btn_nuevo_usuario"><i class="fa-regular fa-square-plus"></i> Ingresar Nuevo Usuario</button>
                    <button class="btn btn-outline btn-error" id="btn_cerrar_nuevo_usuario"><i class="fa-solid fa-xmark"></i> Cerrar Formulario</button>
                </form>
            </div>
        </div>
    </dialog>

    <dialog id="alta" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg">Hello!</h3>
            <p class="py-4">alta paciente</p>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button, it will close the modal -->
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>

    <dialog id="ver_historial" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg">Hello!</h3>
            <p class="py-4">historial clinico paciente</p>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button, it will close the modal -->
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>
@endsection

@section('script_matronas')
<script type="text/javascript">
$(document).ready(function(){
    format_rut_init();

    $('#btn_nuevo_usuario').on('click', function(event){
        event.preventDefault();
        let nombres = $('#input_nombres').val();
        let apellido_paterno = $('#input_apellido_paterno').val();
        let apellido_materno = $('#input_apellido_materno').val();
        let direccion = $('#input_direccion').val();
        let rut_sin_dv = $('#input_rut').val().split('-')[0].split('.').join('');
        let rut_dv = $('#input_rut').val().split('-')[1];
        let prevision_social = $('#input_prevision_social').val();
        let nacionalidad = $('#input_nacionalidad').val();
        let telefono = $('#input_telefono').val();
        let fecha_nacimiento = $('#input_fecha_nacimiento').val();
        let motivo_pap = $('#input_motivo_pap').val();
        let fecha_pap = $('#input_fecha_pap').val();

        $.ajax({
            url: base_hlor + "/matronas/new_user",
            type: "POST",
            dataType: "JSON",
            data: {
                nombres: nombres,
                apellido_paterno: apellido_paterno,
                apellido_materno: apellido_materno,
                direccion: direccion,
                rut_sin_dv: rut_sin_dv,
                rut_dv: rut_dv,
                prevision_social: prevision_social,
                nacionalidad: nacionalidad,
                telefono: telefono,
                fecha_nacimiento: fecha_nacimiento,
                motivo_pap: motivo_pap,
                fecha_pap: fecha_pap
            },
            beforeSend: function() {
                bloquear_pantalla();
            },
            success: function(data) {
                $('#input_nombres').val('');
                $('#input_apellido_paterno').val('');
                $('#input_apellido_materno').val('');
                $('#input_direccion').val('');
                $('#input_rut').val('');
                $('#input_prevision_social').val('');
                $('#input_nacionalidad').val('');
                $('#input_telefono').val('');
                $('#input_fecha_nacimiento').val('');
                $('#input_motivo_pap').val('');
                $('#input_fecha_pap').val('');

               desbloquear_pantalla();
            },
            error: function(data) {
                hlor_alert(data, 'error');
                desbloquear_pantalla();
            }
        });
    });
});
</script>
@endsection
