@extends('layouts.dashboard')

@section('motivo_pap_view')<div class="m-5 grid grid-rows-auto gap-4">
    <div class="grid">
        <div class="grid grid-cols-auto justify-end">
            <h4 class="font-bold">Mantenedor Motivos Pap</h4>
        </div>
        <div class="col-end-12 ms-96">
            <button class="btn btn-outline btn-success" onclick="ingreso_nuevo_motivo.showModal()">Ingresar Motivo PAP</button>
        </div>
    </div>
    <div class="grid grid-cols-auto">
        <div class="overflow-x-auto">
            <div class="overflow-x-auto">
                <table class="table table-zebra" id="table_motivo">
                    <thead>
                    <tr>
                        <th>Motivo PAP</th>
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

@section('modal_motivo_pap')
    <dialog id="ingreso_nuevo_motivo" class="modal">
        <div class="modal-box max-w-3xl">
            <h3 class="font-bold text-lg"><i class="fa-solid fa-flag"></i> Ingreso Motivo PAP</h3>
            <form class="mt-6">

                <div class="grid grid-cols-2 gap-1">
                    <label class="input input-bordered flex items-center w-full gap-2">
                        Motivo PAP: <input type="text" class="grow" placeholder=" Ingrese Motivo" id="input_motivo"/>
                    </label>
                    <label class="input input-bordered flex items-center w-full gap-2">
                        Sigla: <input type="text" class="grow" placeholder=" Ingrese Sigla" id="input_sigla"/>
                    </label>
                </div>

            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-outline btn-success" id="btn_nuevo_motivo"><i class="fa-regular fa-square-plus"></i> Ingresar Motivo PAP</button>
                    <button class="btn btn-outline btn-error" id="btn_cerrar_motivo"><i class="fa-solid fa-xmark"></i> Cerrar Formulario</button>
                </form>
            </div>
        </div>
    </dialog>
@endsection

@section('script_motivo_pap')
    <script>
        var table_motivo = $('#table_motivo').DataTable({
            "processing": false,
            "serverSide": true,
            "lengthChange": false,
            "paging": false,
            "scrollCollapse": true,
            "scrollY": '50vh',
            "searching": false,
            "ajax": {
                url: base_hlor + '/list_motivo',
                type: 'POST'
            },
            "columns": [
                {"data":"nombre_motivo", "name":"nombre_motivo"},
                {"data":"sigla_motivo", "name":"sigla_motivo"},
                {"data":"action", "name":"action",
                    render: function(data, type, row, meta){
                        return '<button class="btn btn-outline btn-error btn_eliminar_motivo" id="'+row.id_motivo+'"><i class="fa-solid fa-xmark"></i> Eliminar</button>'
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

            $('#btn_nuevo_motivo').on('click', function(event){
                event.preventDefault();

                let motivo_pap = $('#input_motivo').val();
                let sigla        = $('#input_sigla').val();

                $.ajax({
                    url: base_hlor + '/mantenedor_motivo/ingreso_nuevo_motivo',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        motivo_pap: motivo_pap,
                        sigla: sigla
                    },
                    beforeSend:function(){ bloquear_pantalla(); },
                    success: function(data) {
                        $('#input_motivo').val('');
                        $('#input_sigla').val('');

                        table_motivo.clear().draw();
                        document.getElementById('ingreso_nuevo_motivo').close();
                        desbloquear_pantalla();
                        hlor_alert(data.message, 'success');
                    },
                    error: function(error) {
                        desbloquear_pantalla();
                        hlor_alert(error, 'error');
                    }
                });
            });

            $('#table_motivo tbody').on('click', '.btn_eliminar_motivo', function(){
                let data = $(this);
                let id = data.attr('id');

                Swal.fire({
                    title: "¿Desea Eliminar Motivo PAP?",
                    showCancelButton: true,
                    confirmButtonText: "Si",
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            url: base_hlor + '/mantenedor_motivo/eliminar_motivo',
                            type: 'POST',
                            dataType: 'JSON',
                            data: { id: id },
                            success: function(data) {
                                table_motivo.clear().draw();
                                hlor_alert(data.message,'success');
                            },
                            error: function(error) {
                                hlor_alert(error, 'error');
                            }
                        });
                    }
                });
            });

            $('#btn_cerrar_motivo').on('click', function(event){
                $('#input_motivo').val('');
                $('#input_sigla').val('');
            });
        });

    </script>
@endsection
