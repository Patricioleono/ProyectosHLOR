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
        <div class="modal-box w-2/5 max-w-5xs">
            <h3 class="font-bold text-lg">Ingreso Nuevo Paciente</h3>
            <form class="mt-3">
                <div class="grid-rows-1">
                    <div class="grid-cols-12">
                        <input type="text" placeholder="Ingrese Nombres" class="input input-bordered w-full mb-3 me-3" />
                        <input type="text" placeholder="Ingrese Apellido Paterno" class="input input-bordered w-full mb-3 me-3" />
                        <input type="text" placeholder="Ingrese Apellido Paterno" class="input input-bordered w-full mb-3 me-3" />
                        <input type="text" placeholder="Ingrese Apellido Materno" class="input input-bordered w-full mb-3 me-3" />
                        <input type="text" placeholder="Ingrese Dirección" class="input input-bordered w-full mb-3 me-3" />
                        <input type="text" placeholder="Ingrese Rut" class="input input-bordered w-full mb-3 me-3" />
                        <select class="select select-bordered w-full mb-3 me-3">
                            <option selected>Motivo del PAP</option>
                            <option value="0">PAP No Realizado</option>
                            <option value="1">PAP Atrasado</option>
                            <option value="2">Repetir PAP</option>
                        </select>
                        <input type="date" placeholder="" class="input input-bordered w-full mb-3 me-3" />
                    </div>
                </div>
            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-outline btn-success">Ingresar Nuevo Usuario</button>
                    <button class="btn btn-outline btn-error">Cerrar Formulario</button>
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

@endsection
