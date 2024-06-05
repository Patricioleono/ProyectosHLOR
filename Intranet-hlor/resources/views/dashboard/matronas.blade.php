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
                    <table class="table table-zebra" id="table_matronas_user">
                        <thead>
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Rut</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

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
                        Telefono: <input type="text" class="grow" placeholder=" Ingrese Telefono" id="input_telefono"/>
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Nacionalidad</span>
                        </div>
                        <select class="select select-bordered w-full" id="input_nacionalidad">
                            <option selected>Seleccione Nacionalidad</option>>
                            @php
                                foreach($nacionalidades as $nacionalidad){
                                    echo '<option value="'.$nacionalidad->mat_pais_origen.'">'.$nacionalidad->mat_pais_origen.'</option>';
                                }
                            @endphp
                        </select>
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Prevision</span>
                        </div>
                        <select class="select select-bordered w-full" id="input_prevision_social">
                            <option selected>Seleccione Prevision</option>>
                            @php
                                foreach($previsiones as $prevision){
                                    echo '<option value="'.$prevision->mat_prevision_nombre.'">'.$prevision->mat_prevision_nombre.'</option>';
                                }
                            @endphp
                        </select>
                    </label>
                </div>
                <div class="grid grid-cols-1 gap-1">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Fecha de Nacimiento</span>
                        </div>
                        <input type="date" class="input input-bordered w-full" id="input_fecha_nacimiento"/>
                    </label>
                </div>

                <div class="grid grid-rows-1 mt-3">

                    <div class="collapse collapse-plus bg-white border border-1">
                        <input type="checkbox" name="my-accordion-3"/>
                        <div class="collapse-title text-xl font-medium">
                            Datos Primer Control/Ingreso
                        </div>
                        <div class="collapse-content">
                            <div class="grid grid-cols-2 gap-1">
                                <label class="form-control">
                                    <div class="label">
                                        <span class="label-text-alt">Indicaciones</span>
                                    </div>
                                    <textarea class="textarea textarea-bordered h-24" placeholder="Ingrese Indicaciones" id="input_indicaciones"></textarea>
                                </label>
                                <label class="form-control">
                                    <div class="label">
                                        <span class="label-text-alt">Observaciones</span>
                                    </div>
                                    <textarea class="textarea textarea-bordered h-24" placeholder="Ingrese Observaciones" id="input_observaciones"></textarea>
                                </label>
                            </div>

                            <div class="grid grid-cols-2 gap-1">
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">Motivo PAP</span>
                                    </div>
                                    <select class="select select-bordered w-full" id="input_motivo_pap">
                                        <option selected>Seleccione Motivo Pap</option>>
                                        @php
                                            foreach($motivos_pap as $motivos){
                                                echo '<option value="'.$motivos->mat_motivo_pap.'">'.$motivos->mat_motivo_pap.'</option>';
                                            }
                                        @endphp
                                    </select>
                                </label>

                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">Fecha PAP</span>
                                    </div>
                                    <input type="date" class="input input-bordered w-full" id="input_fecha_pap"/>
                                </label>
                            </div>
                        </div>
                    </div>
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

    <dialog id="ver_historial" class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg">Historial Seguimiento de Paciente</h3>
            <div class="grid grid-rows-1">
                <div class="grid grid-cols-1 gap-1 mt-3 w-full place-items-center">
                    <div class="grid gap-3" id="nombre_paciente">

                    </div>
                </div>
            </div>

            <div class="grid grid-rows-1 mt-5 justify-items-center">
                <div class="grid grid-cols-2 gap-5 w-full ">
                    <div class="grid gap-3" id="datos_pacientes">

                    </div>
                    <div class="grid gap-3" id="prevision_salud">

                    </div>
                </div>
            </div>

            <div class="grid grid-rows-1 mt-3 justify-items-center">
                <div class="grid grid-cols-3 gap-5 w-full mt-5">
                    <div id="fecha_toma_pap_paciente">
                        <h3 class="border-b-2 hover:border-b-stone-950">Fecha Pap Realizado </h3>
                    </div>
                    <div id="resultado_pap_paciente">
                        <h3 class="border-b-2 hover:border-b-stone-950">Resultado Pap </h3>
                    </div>
                    <div id="indicaciones_pap_paciente">
                        <h3 class="border-b-2 hover:border-b-stone-950">Indicaciones Pap </h3>
                    </div>
                </div>
            </div>

            <!-- Desplegar para agregar Control -->
            <div class="collapse collapse-plus bg-white border border-1 mt-5">
                <input type="checkbox" name="my-accordion-3"/>
                <div class="collapse-title text-xl font-medium">
                    Ingresar Nuevo Control
                </div>
                <div class="collapse-content">
                    <div class="grid grid-cols-2 gap-1">
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text-alt">Indicaciones</span>
                            </div>
                            <textarea class="textarea textarea-bordered h-24" placeholder="Ingrese Indicaciones" id="input_indicaciones"></textarea>
                        </label>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text-alt">Observaciones</span>
                            </div>
                            <textarea class="textarea textarea-bordered h-24" placeholder="Ingrese Observaciones" id="input_observaciones"></textarea>
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-1">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Motivo PAP</span>
                            </div>
                            <select class="select select-bordered w-full" id="input_motivo_pap">
                                <option selected>Seleccione Motivo Pap</option>>
                                @php
                                    foreach($motivos_pap as $motivos){
                                        echo '<option value="'.$motivos->mat_motivo_pap.'">'.$motivos->mat_motivo_pap.'</option>';
                                    }
                                @endphp
                            </select>
                        </label>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Fecha PAP</span>
                            </div>
                            <input type="date" class="input input-bordered w-full" id="input_fecha_pap"/>
                        </label>
                    </div>
                </div>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-error btn-outline"><i class="fa-solid fa-xmark"></i> Cerrar Historial</button>
                </form>
            </div>
        </div>
    </dialog>
@endsection

@section('script_matronas')
<script type="text/javascript">
    var table_matronas_user = $('#table_matronas_user').DataTable({
        "processing": false,
        "serverSide": true,
        "lengthChange": false,
        "paging": false,
        "scrollCollapse": true,
        "scrollY": '50vh',
        "ajax": {
            url: base_hlor + '/matronas/list_users',
            type: 'POST'
        },
        "columns": [
            {"data":"user_name", "name":"user_name",
                render: function(data, type, row,){
                    return row.user_name+' '+row.user_last_name+' '+row.user_last_last_name;
                }
            },
            {"data":"user_rut", "name":"user_rut"},
            {"data":"action", "name":"action",
                render: function(data, type, row, meta){
                    return '<button class="btn btn-outline btn-info info_historial" id="'+row.user_rut+'">Ver Historial</button>' +
                            '<button class="btn btn-outline btn-error ms-3 alta_user" id="'+row.user_rut+'">Dar de Alta</button>'
                }, "orderable": false, "searchable": false
            }
        ],
        "order": [[ 0, "asc" ]],
        language: {
            "decimal": "",
            "emptyTable": "No hay datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(Filtro de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron Registros",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Próximo",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar orden de columna ascendente",
                "sortDescending": ": Activar orden de columna desendente"
            }
        }
    });

$(document).ready(function(){
    format_rut_init();

    $('#btn_nuevo_usuario').on('click', function(event){
        event.preventDefault();
        let nombres             = $('#input_nombres').val();
        let apellido_paterno    = $('#input_apellido_paterno').val();
        let apellido_materno    = $('#input_apellido_materno').val();
        let direccion           = $('#input_direccion').val();
        let rut_sin_dv          = $('#input_rut').val().split('-')[0].split('.').join('');
        let rut_dv              = $('#input_rut').val().split('-')[1];
        let prevision_social    = $('#input_prevision_social').val();
        let nacionalidad        = $('#input_nacionalidad').val();
        let telefono            = $('#input_telefono').val();
        let fecha_nacimiento    = $('#input_fecha_nacimiento').val();
        let motivo_pap          = $('#input_motivo_pap').val();
        let fecha_pap           = $('#input_fecha_pap').val();
        let indicaciones        = $('#input_indicaciones').val()
        let observaciones       = $('#input_observaciones').val()

        if(indicaciones.length < 0 || observaciones.length < 0 ){
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

                    table_matronas_user.clear().draw();
                    ingreso_nuevo_paciente.close();
                    hlor_alert(data.message, 'success');
                    desbloquear_pantalla();
                },
                error: function(data) {
                    hlor_alert(data, 'error');
                    desbloquear_pantalla();
                }
            });
        }else{
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
                    fecha_pap: fecha_pap,
                    indicaciones: indicaciones,
                    observaciones: observaciones
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

                    table_matronas_user.clear().draw();
                    ingreso_nuevo_paciente.close();
                    hlor_alert(data.message, 'success');
                    desbloquear_pantalla();
                },
                error: function(data) {
                    hlor_alert(data, 'error');
                    desbloquear_pantalla();
                }
            });
        }

    });

    $('#table_matronas_user').on('click', '.info_historial', function(){
        let data = $(this);
        let rut = data[0].id.split('-')[0];
        let dv = data[0].id.split('-')[1];

        $.ajax({
            url: base_hlor + "/matronas/historial_usuario",
            type: "POST",
            dataType: "JSON",
            data: {rut: rut, dv:dv },
            beforeSend: function() {
                bloquear_pantalla();
                $('#nombre_paciente').empty();
                $('#datos_pacientes').empty();
                $('#prevision_salud').empty();
                $('#fecha_toma_pap_paciente').empty();
                $('#resultado_pap_paciente').empty();
                $('#indicaciones_pap_paciente').empty();
            },
            success: function(data) {
                if(data.status !== 400){
                    $('#nombre_paciente').append('<h3 class="transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">'+data[0].nombre_completo+'</h3>');
                    $('#datos_pacientes').append(
                        '<h3 class="border-b-2 hover:border-b-stone-950 mt-1">Rut: '+data[0].rut+'</h3>' +
                        '<h3 class="border-b-2 hover:border-b-stone-950 mt-1">Fecha de Nacimiento: '+data[0].fecha_de_nacimiento+'</h3>' +
                        '<h3 class="border-b-2 hover:border-b-stone-950 mt-1">Dirección: '+data[0].domicilio +'</h3>'
                    );
                    $('#prevision_salud').append(
                        '<h3 class="border-b-2 hover:border-b-stone-950 mt-1">Previsión: '+data[0].prevision+'</h3>' +
                        '<h3 class="border-b-2 hover:border-b-stone-950 mt-1">Nacionalidad: '+data[0].nacionalidad+'</h3>' +
                        '<h3 class="border-b-2 hover:border-b-stone-950 mt-1">Telefono: '+data[0].telefono +'</h3>'
                    );
                    data.forEach((element) => {
                        $('#fecha_toma_pap_paciente').append('<h3 class="mt-1">'+element.fecha_pap+'</h3>')
                        $('#resultado_pap_paciente').append('<h3 class="mt-1">'+element.observaciones+'</h3>')
                        $('#indicaciones_pap_paciente').append('<h3 class="mt-1">'+element.indicaciones+'</h3>')
                    });
                    ver_historial.showModal();
                    desbloquear_pantalla();
                }else{
                    desbloquear_pantalla();
                    hlor_alert(data.message, 'error');
                }

            },
            error: function(data) {
                hlor_alert(JSON.parse(data), 'error');
                desbloquear_pantalla();
            }
        });

    });

    $('#table_matronas_user').on('click', '.alta_user', function(){
        let data = $(this);
        let rut = data[0].id.split('-')[0];
        let dv = data[0].id.split('-')[1];

        Swal.fire({
            title: "¿Desea Dar de Alta al Paciente?",
            showCancelButton: true,
            confirmButtonText: "Si",
        }).then((result) => {

            if (result.isConfirmed) {
                $.ajax({
                    url: base_hlor + '/matronas/historial_usuario_eliminar',
                    type: 'POST',
                    dataType: 'JSON',
                    data: { rut: rut, dv: dv },
                    success: function(data) {
                        table_matronas_user.clear().draw();
                        hlor_alert(data.message,'success');
                    },
                    error: function(error) {
                        hlor_alert(JSON.parse(error), 'error');
                    }
                });
            }
        });
    });
});
</script>
@endsection
