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
                <table class="table table-zebra">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nacionalidad</th>
                        <th>Sigla</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php
                        foreach($nacionalidad as $nacional){
                            echo '<tr>';
                            echo '<th>'.$nacional->mat_nacionalidad_pk.'</th>';
                            echo '<td>'.$nacional->mat_pais_origen.'</td>';
                            echo '<td>'.$nacional->mat_sigla_nacionalidad.'</td>';
                            echo '<td>';
                            echo '<button class="btn btn-outline btn-error" onclick="eliminar.showModal()" id="'.$nacional->mat_nacionalidad_pk.'">Eliminar</button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    @endphp

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
        $(document).ready(function() {
            $('#btn_nueva_nacionalidad').on('click', function(event){
                event.preventDefault();

                let nacionalidad = $('#input_nacionalidad').val();
                let sigla = $('#input_sigla').val();

                $.ajax({
                    url: base_hlor + '/mantenedor_nac/ingreso_nueva_nac',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        nacionalidad: nacionalidad,
                        sigla: sigla
                    },
                    success: function(data) {
                        hlor_alert(data, 'success');
                    },
                    error: function(error) {
                        hlor_alert(error, 'error');
                    }
                });
            });
        });
    </script>
@endsection
