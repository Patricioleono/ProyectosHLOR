@extends('layout.app')

@section('header')
@include('includes.header')
@endsection

@section('content')
<div class="row m-3">
    <div class="col-12">
        <button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#modalNuevoPaciente">
            <i class="text-white fa-solid fa-square-plus me-1"></i>
            Nuevo Paciente</button>
    </div>
    <div class="col-12 mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">RUT</th>
                    <th scope="col">Ultimo Control</th>
                    <th scope="col">PAP <span style="color:red">¿Realizado?</span></th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Patricio</td>
                    <td>Leon Ormazabal</td>
                    <td>18.028.144-4</td>
                    <td>15-01-2024</td>
                    <td>No</td>
                    <td>
                        <button class="btn btn-primary"><i class="text-white fa-solid fa-eye"></i></button>
                        <button class="btn btn-info"><i class="text-white fa-solid fa-file-pen"></i></button>
                        <button class="btn btn-danger"><i class="text-white fa-solid fa-hand-holding-heart"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Patricio</td>
                    <td>Leon Ormazabal</td>
                    <td>18.028.144-4</td>
                    <td>15-01-2024</td>
                    <td>No</td>
                    <td>
                        <button class="btn btn-primary"><i class="text-white fa-solid fa-eye"></i></button>
                        <button class="btn btn-info"><i class="text-white fa-solid fa-file-pen"></i></button>
                        <button class="btn btn-danger"><i class="text-white fa-solid fa-hand-holding-heart"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Patricio</td>
                    <td>Leon Ormazabal</td>
                    <td>18.028.144-4</td>
                    <td>15-01-2024</td>
                    <td>No</td>
                    <td>
                        <button class="btn btn-primary"><i class="text-white fa-solid fa-eye"></i></button>
                        <button class="btn btn-info"><i class="text-white fa-solid fa-file-pen"></i></button>
                        <button class="btn btn-danger"><i class="text-white fa-solid fa-hand-holding-heart"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Patricio</td>
                    <td>Leon Ormazabal</td>
                    <td>18.028.144-4</td>
                    <td>15-01-2024</td>
                    <td>No</td>
                    <td>
                        <button class="btn btn-primary"><i class="text-white fa-solid fa-eye"></i></button>
                        <button class="btn btn-info"><i class="text-white fa-solid fa-file-pen"></i></button>
                        <button class="btn btn-danger"><i class="text-white fa-solid fa-hand-holding-heart"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('modalMatronas')
<div class="modal fade" id="modalNuevoPaciente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalNuevoPaciente" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalNuevoPaciente"><i class="fa-regular fa-file-lines"></i> Ingreso Nuevo Paciente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="newPacientForm" enctype="multipart/form-data">
                    <div class="row m-1">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Nombre" class="form-label">Ingrese Nombre:</label>
                                <input type="text" class="form-control" id="inputName" name="inputName" placeholder="EJ: Patricio">
                            </div>
                            <div class="mb-3">
                                <label for="Apellido Paterno" class="form-label">Ingrese Apellido Paterno:</label>
                                <input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="EJ: Leon">
                            </div>
                            <div class="mb-3">
                                <label for="Apellido Materno" class="form-label">Ingrese Apellido Materno:</label>
                                <input type="text" class="form-control" id="inputSurName" name="inputSurName" placeholder="EJ: Ormazabal">
                            </div>
                            <div class="mb-3">
                                <label for="Estado Pap" class="mb-2">Seleccione Estado PAP</label>
                                <select class="form-select" aria-label="Selector Pap" id="inputSelectPap" name="inputSelectPap">
                                    <option selected>Seleccione Aqui</option>
                                    <option value="si">Realizado</option>
                                    <option value="no">No Realizado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="RUT" class="form-label">Ingrese RUT:</label>
                                <input type="text" class="form-control" id="inputRut" name="inputRut" placeholder="EJ: 11.111.111-2">
                            </div>
                            <div class="mb-3">
                                <label for="edad" class="form-label">Ingrese edad:</label>
                                <input type="number" class="form-control" id="inputEdad" name="inputEdad" placeholder="EJ: 30">
                            </div>
                            <div class="mb-3">
                                <label for="Direccion" class="form-label">Ingrese Direccion:</label>
                                <input type="text" class="form-control" id="inputDireccion" name="inputDireccion" placeholder="EJ: Lautaro #275">
                            </div>
                            <div class="mb-3 d-none" id="fechaPap">
                                <label for="Fecha Pap" class="form-label">Seleccione Fecha:</label>
                                <input type="date" class="form-control" id="inputFechaPap" name="inputFechaPap">
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="col-12 justify-content-end text-end">
                        <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal"><i class="fa-solid fa-right-left"></i> Volver</button>
                        <button type="submit" class="btn btn-success text-white" id="saveNewPacient"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection


@section('scriptMatronas')
<script>
    $(document).ready(function() {
        //escuchar cambios en el input
        document.addEventListener('input', (e) => {
            const rut = document.getElementById('inputRut');

            if (e.target === rut) {
                let rutFormateado = darFormatoRUT(rut.value);
                rut.value = rutFormateado;
            }
        });
 
        // dar formato XX.XXX.XXX-X
        function darFormatoRUT(rut) {
            // dejar solo números y letras 'k'
            const rutLimpio = rut.replace(/[^0-9kK]/g, '');

            // dejar separado cuerpo y codigo verificador
            const cuerpo = rutLimpio.slice(0, -1);
            const dv = rutLimpio.slice(-1).toUpperCase();

            if (rutLimpio.length < 2) return rutLimpio;

            // colocar los separadores de miles al cuerpo
            let cuerpoFormatoMiles = cuerpo
                .toString()
                .split('')
                .reverse()
                .join('')
                .replace(/(?=\d*\.?)(\d{3})/g, '$1.');

            cuerpoFormatoMiles = cuerpoFormatoMiles
                .split('')
                .reverse()
                .join('')
                .replace(/^[\.]/, '');

            return `${cuerpoFormatoMiles}-${dv}`;
        }


        $('#inputSelectPap').on('change', function() {
            let estadoPap = $('#inputSelectPap').val();
            if (estadoPap == 'si') {
                $('#fechaPap').fadeIn('slow');
                $('#fechaPap').removeClass('d-none');
            } else {
                $('#fechaPap').fadeOut();
                $('#fechaPap').addClass('d-none');
            }
        });

        $('#saveNewPacient').on('click', function(event) {
            event.preventDefault();
            let name = $('#inputName').val();
            let lastName = $('#inputLastName').val();
            let surName = $('#inputSurName').val();
            let statePap = $('#inputSelectPap').val();
            let rutDv = $('#inputRut').val().split('-')[1];
            let rutSinDv = $('#inputRut').val().split('-')[0].split('.').join('');
            let edad = $('#inputEdad').val();
            let direccion = $('#inputDireccion').val();
            let fechaPap = $('#inputFechaPap').val().split('-').reverse().join('-');

            let resultValidation = formValidation(name, lastName, surName, statePap, rutSinDv, rutDv, edad, direccion, fechaPap);

            if(resultValidation.status != 200){
                hlorAlert(resultValidation)
            }else{
                $.ajax({
                    type: 'POST',
                    url: hlorBase + '/newPacient',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        lastName: lastName,
                        surName: surName,
                        statePap: statePap,
                        rutDv: rutDv,
                        rutSinDv: rutSinDv,
                        edad: edad,
                        direccion: direccion,
                        fechaPap: fechaPap
                    },
                    dataType: 'JSON',
                    success: function(result){
                        console.log(result)
                    }
                });
            }


        });
    })
</script>
@endsection

@section('footer')
@include('includes.footer')
@endsection