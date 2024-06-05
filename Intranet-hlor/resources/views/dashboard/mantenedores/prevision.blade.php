@extends('layouts.dashboard')

@section('prevision_view')<div class="m-5 grid grid-rows-auto gap-4">
    <div class="grid">
        <div class="grid grid-cols-auto justify-end">
            <h4 class="font-bold">Mantenedor de Previsión</h4>
        </div>
        <div class="col-end-12 ms-96">
            <button class="btn btn-outline btn-success" onclick="ingreso_nueva_prevision.showModal()">Ingresar Nueva Prevision</button>
        </div>
    </div>
    <div class="grid grid-cols-auto">
        <div class="overflow-x-auto">
            <div class="overflow-x-auto">
                <table class="table table-zebra" id="table_prevision">
                    <thead>
                    <tr>
                        <th>Previsión</th>
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

@section('modal_prevision')
    <dialog id="ingreso_nueva_prevision" class="modal">
        <div class="modal-box max-w-3xl">
            <h3 class="font-bold text-lg"><i class="fa-solid fa-flag"></i> Ingreso Nueva Prevision</h3>
            <form class="mt-6">

                <div class="grid grid-cols-2 gap-1">
                    <label class="input input-bordered flex items-center w-full gap-2">
                        Previsión: <input type="text" class="grow" placeholder=" Ingrese Previsión" id="input_prevision"/>
                    </label>
                    <label class="input input-bordered flex items-center w-full gap-2">
                        Sigla: <input type="text" class="grow" placeholder=" Ingrese Sigla" id="input_sigla"/>
                    </label>
                </div>

            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-outline btn-success" id="btn_nueva_prevision"><i class="fa-regular fa-square-plus"></i> Ingresar Nueva Previsión</button>
                    <button class="btn btn-outline btn-error" id="btn_cerrar_prevision"><i class="fa-solid fa-xmark"></i> Cerrar Formulario</button>
                </form>
            </div>
        </div>
    </dialog>
@endsection

@section('script_prevision')
    <script>
        var table_prevision = $('#table_prevision').DataTable({
            "processing": false,
            "serverSide": true,
            "lengthChange": false,
            "paging": false,
            "scrollCollapse": true,
            "scrollY": '50vh',
            "searching": false,
            "ajax": {
                url: base_hlor + '/list_prevision',
                type: 'POST'
            },
            "columns": [
                {"data":"nombre_prev", "name":"nombre_prev"},
                {"data":"sigla_prev", "name":"sigla_prev"},
                {"data":"action", "name":"action",
                    render: function(data, type, row, meta){
                        return '<button class="btn btn-outline btn-error btn_eliminar_prev" id="'+row.id_prev+'"><i class="fa-solid fa-xmark"></i> Eliminar</button>'
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

            $('#btn_nueva_prevision').on('click', function(event){
                event.preventDefault();

                let prevision = $('#input_prevision').val();
                let sigla        = $('#input_sigla').val();

                $.ajax({
                    url: base_hlor + '/mantenedor_prev/ingreso_nueva_prev',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        prevision: prevision,
                        sigla: sigla
                    },
                    beforeSend:function(){ bloquear_pantalla(); },
                    success: function(data) {
                        $('#input_previsoin').val('');
                        $('#input_sigla').val('');

                        table_prevision.clear().draw();
                        document.getElementById('ingreso_nueva_prevision').close();
                        desbloquear_pantalla();
                        hlor_alert(data.message, 'success');
                    },
                    error: function(error) {
                        desbloquear_pantalla();
                        hlor_alert(error, 'error');
                    }
                });
            });

            $('#table_prevision tbody').on('click', '.btn_eliminar_prev', function(){
                let data = $(this);
                let id = data.attr('id');

                Swal.fire({
                    title: "¿Desea Borrar la Nacionalidad?",
                    showCancelButton: true,
                    confirmButtonText: "Si",
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            url: base_hlor + '/mantenedor_prev/eliminar_prev',
                            type: 'POST',
                            dataType: 'JSON',
                            data: { id: id },
                            success: function(data) {
                                table_prevision.clear().draw();
                                hlor_alert(data.message,'success');
                            },
                            error: function(error) {
                                hlor_alert(error, 'error');
                            }
                        });
                    }
                });
            });

            $('#btn_cerrar_prevision').on('click', function(event){
                $('#input_prevision').val('');
                $('#input_sigla').val('');
            });
        });

    </script>
@endsection
