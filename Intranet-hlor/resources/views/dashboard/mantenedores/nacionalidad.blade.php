@extends('layouts.dashboard')

@section('nacionalidad_view')<div class="m-5 grid grid-rows-auto gap-4">
    <div class="grid">
        <div class="grid grid-cols-auto justify-end">
            <h4 class="font-bold">Mantenedor de Nacionalidades</h4>
        </div>
        <div class="col-end-12 ms-96">
            <button class="btn btn-outline btn-success" onclick="ingreso_nueva_nacionalidad.showModal()">Ingresar Nueva Nacionalidad</button>
        </div>
    </div>
    <div class="grid grid-cols-auto">
        <div class="overflow-x-auto">
            <div class="overflow-x-auto">
                <table class="table table-zebra" id="table_nacionalidad">
                    <thead>
                    <tr>
                        <th>Nacionalidad</th>
                        <th>Sigla</th>
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

@section('modal_nacionalidad')
    <dialog id="ingreso_nueva_nacionalidad" class="modal">
        <div class="modal-box max-w-3xl">
            <h3 class="font-bold text-lg"><i class="fa-solid fa-flag"></i> Ingreso Nueva Nacionalidad</h3>
            <form class="mt-6">

                <div class="grid grid-cols-2 gap-1">
                    <label class="input input-bordered flex items-center w-full gap-2">
                        Nacionalidad: <input type="text" class="grow" placeholder=" Ingrese Nacionalidad" id="input_nacionalidad"/>
                    </label>
                    <label class="input input-bordered flex items-center w-full gap-2">
                        Sigla: <input type="text" class="grow" placeholder=" Ingrese Sigla" id="input_sigla"/>
                    </label>
                </div>

            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-outline btn-success" id="btn_nueva_nacionalidad"><i class="fa-regular fa-square-plus"></i> Ingresar Nuevo Usuario</button>
                    <button class="btn btn-outline btn-error" id="btn_cerrar_nuevo_usuario"><i class="fa-solid fa-xmark"></i> Cerrar Formulario</button>
                </form>
            </div>
        </div>
    </dialog>
@endsection

@section('script_nacionalidad')
    <script>
        var table_nacionalidad = $('#table_nacionalidad').DataTable({
            "processing": false,
            "serverSide": true,
            "lengthChange": false,
            "paging": false,
            "scrollCollapse": true,
            "scrollY": '50vh',
            "searching": false,
            "ajax": {
                url: base_hlor + '/list_nacionalidad',
                type: 'POST'
            },
            "columns": [
                {"data":"nombre_nac", "name":"nombre_nac"},
                {"data":"sigla_nac", "name":"sigla_nac"},
                {"data":"action", "name":"action",
                render: function(data, type, row, meta){
                    return '<button class="btn btn-outline btn-error btn_eliminar_nac" id="'+row.id_nac+'"><i class="fa-solid fa-xmark"></i> Eliminar</button>'
                }}
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

        $(document).ready(function() {

            $('#btn_nueva_nacionalidad').on('click', function(event){
                event.preventDefault();

                let nacionalidad = $('#input_nacionalidad').val();
                let sigla        = $('#input_sigla').val();

                $.ajax({
                    url: base_hlor + '/mantenedor_nac/ingreso_nueva_nac',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        nacionalidad: nacionalidad,
                        sigla: sigla
                    },
                    beforeSend:function(){ bloquear_pantalla(); },
                    success: function(data) {
                        let nacionalidad = $('#input_nacionalidad').val('');
                        let sigla        = $('#input_sigla').val('');
                        table_nacionalidad.clear().draw();
                        document.getElementById('ingreso_nueva_nacionalidad').close();
                        desbloquear_pantalla();
                        hlor_alert(data.message, 'success');
                    },
                    error: function(error) {
                        desbloquear_pantalla();
                        hlor_alert(error, 'error');
                    }
                });
            });

            $('#table_nacionalidad tbody').on('click', '.btn_eliminar_nac', function(){
                let data = $(this);
                let id = data.attr('id');

                Swal.fire({
                    title: "¿Desea Borrar la Nacionalidad?",
                    showCancelButton: true,
                    confirmButtonText: "Si",
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            url: base_hlor + '/mantenedor_nac/eliminar_nac',
                            type: 'POST',
                            dataType: 'JSON',
                            data: { id: id },
                            success: function(data) {
                                table_nacionalidad.clear().draw();
                                hlor_alert(data.message,'success');
                            },
                            error: function(error) {
                                hlor_alert(error, 'error');
                            }
                        });
                    }
                });
            });

            $('#btn_cerrar_nuevo_usuario').on('click', function(event){
                let nacionalidad = $('#input_nacionalidad').val('');
                let sigla        = $('#input_sigla').val('');
            });
        });

    </script>
@endsection
