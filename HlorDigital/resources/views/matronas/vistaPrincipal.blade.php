@extends('layout.app')

@section('header')
@include('includes.header')
@endsection

@section('content')
<div class="row m-1">
    <!-- falta tab para separar pacientes de alta al hacer click en el btn se tiene quye agregar el active-->
    <ul class="nav nav-tabs" id="list-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="list-paciente-list" data-bs-toggle="list" href="#list-paciente" role="tab" aria-controls="list-paciente">Listado Pacientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="list-paciente-alta-list" data-bs-toggle="list" href="#list-paciente-alta" role="tab" aria-controls="list-paciente-alta">Listado Pacientes de Alta</a>
        </li>
    </ul>
    
        <div class="tab-content" id="nav-tabContent">
            <div class="col-12">
                
            </div>
            <div class="tab-pane fade show active" id="list-paciente" role="tabpanel" aria-labelledby="list-paciente-list">
                <div class="col-12 mt-1">
                    <table class="table table-hover" id="tableListPacients">
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
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="list-paciente-alta" role="tabpanel" aria-labelledby="list-paciente-alta-list">
                <div class="col-12 mt-3">
                    <table class="table table-hover mt-1" id="tableListPacientsAlta">
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
                        </tbody>
                    </table>
                </div>
            </div>
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
                        <button type="button" class="btn btn-primary text-white" id="closeModal" data-bs-dismiss="modal"><i class="fa-solid fa-right-left"></i> Volver</button>
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
    //carga Principal Listado Pacientes table
    $.ajaxSetup({headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}"  }});

    //vista princpipal
   var pacientTable = $('#tableListPacients').DataTable({
        "processing": false,
        "resposive": true,
        "serverSide": true,
        "lengthChange": false,
        "paging": false,
        "scrollCollapse": true,
        "scrollY": '50vh',
        "ajax": {
            url: hlorBase + "/listPacients",
            type: "POST"
        },
        "columns": [
            { "data": "nombre", "name":"nombre"},
            { "data": "apellidos", "name":"apellidos" },
            { "data": "rut", "name":"rut" },
            {
                 "data": "ultimo_control", "name":"ultimo_control",
                 render:function(data, type, row, meta) { return row.ultimo_control.split('-').reverse().join('-'); }
            },
            { 
                "data": "estado_pap", "name":"estado_pap",
                render:function(data, type, row, meta) {
                    if(row.estado_pap == 'REALIZADO'){
                        return '<span class="badge bg-success"><i class="fa-solid fa-check"></i> ' + row.estado_pap + '</span>';
                    }else{
                        return '<span class="badge bg-danger"><i class="fa-solid fa-times"></i>'+ row.estado_pap + '</span>';
                    }
                }
            },
            { 
                "data": "action", "name":"action",
                 render: function(data, type, row, meta) { 
                   return '<button class="btn btn-primary m-1 btnVisualizar" id="'+row.id_paciente+'"><i class="text-white fa-solid fa-eye"></i></button>' +
                          '<button class="btn btn-info m-1 btnEditar" id="'+row.id_paciente+'"><i class="text-white fa-solid fa-file-pen"></i></button>' +
                          '<button class="btn btn-danger m-1 btnDarDeAlta" id="'+row.id_paciente+'"><i class="text-white fa-solid fa-hand-holding-heart"></i></button>';
                 }
            }
        ],
        "order": [[ 0, "desc" ]],
        language: {
            "decimal":        "",
            "emptyTable":     "No hay datos",
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
            "infoFiltered":   "(Filtro de _MAX_ total registros)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron Registros",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Próximo",
                "previous":   "Anterior"
            },
            "aria": {
                "sortAscending":  ": Activar orden de columna ascendente",
                "sortDescending": ": Activar orden de columna desendente"
            }
        }
    });

    //vista pacientes dados de alta
    var pacientTableAlta = $('#tableListPacientsAlta').DataTable({
        "processing": false,
        "responsive": true,
        "serverSide": true,
        "lengthChange": false,
        "paging": false,
        "scrollCollapse": true,
        "scrollY": '50vh',
        "ajax": {
            url: hlorBase + "/listPacientsAlta",
            type: "POST"
        },
        "columns": [
            { "data": "nombre", "name":"nombre"},
            { "data": "apellidos", "name":"apellidos" },
            { "data": "rut", "name":"rut" },
            {
                 "data": "ultimo_control", "name":"ultimo_control",
                 render:function(data, type, row, meta) { return row.ultimo_control.split('-').reverse().join('-'); }
            },
            { 
                "data": "estado_pap", "name":"estado_pap",
                render:function(data, type, row, meta) {
                    if(row.estado_pap == 'REALIZADO'){
                        return '<span class="badge bg-success"><i class="fa-solid fa-check"></i> ' + row.estado_pap + '</span>';
                    }else{
                        return '<span class="badge bg-danger"><i class="fa-solid fa-times"></i>'+ row.estado_pap + '</span>';
                    }
                }
            },
            { 
                "data": "action", "name":"action",
                 render: function(data, type, row, meta) { 
                   return '<button class="btn btn-primary m-1 btnVisualizar" id="'+row.id_paciente+'"><i class="text-white fa-solid fa-eye"></i></button>'
                 }
            }
        ],
        "order": [[ 0, "desc" ]],
        language: {
            "decimal":        "",
            "emptyTable":     "No hay datos",
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
            "infoFiltered":   "(Filtro de _MAX_ total registros)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron Registros",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Próximo",
                "previous":   "Anterior"
            },
            "aria": {
                "sortAscending":  ": Activar orden de columna ascendente",
                "sortDescending": ": Activar orden de columna desendente"
            }
        }
    });

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
                $('#inputFechaPap').val('');
            }
        });
        $('#closeModal').on('click', function() {
            $('#inputName').val('');
            $('#inputLastName').val('');
            $('#inputSurName').val('');
            $('#inputSelectPap').val('Seleccione Aqui');
            $('#inputRut').val('');
            $('#inputEdad').val('');
            $('#inputDireccion').val('');
            $('#inputFechaPap').val('');
            $('#fechaPap').fadeOut();
            $('#fechaPap').addClass('d-none');
        });
        $('.btn-close').on('click', function() {
            $('#inputName').val('');
            $('#inputLastName').val('');
            $('#inputSurName').val('');
            $('#inputSelectPap').val('Seleccione Aqui');
            $('#inputRut').val('');
            $('#inputEdad').val('');
            $('#inputDireccion').val('');
            $('#inputFechaPap').val('');
            $('#fechaPap').fadeOut();
            $('#fechaPap').addClass('d-none');
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
            let fechaPap = $('#inputFechaPap').val();

            let resultValidation = formValidation(name, lastName, surName, statePap, rutSinDv, edad, direccion, fechaPap);

            if(resultValidation.status != 200){
                hlorAlert(resultValidation)
            }else{
                (statePap != 'no')? statePap = true : statePap = false;
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
                    beforeSend: function(){ bloquearPantalla(); },
                    success: function(result){
                        pacientTable.clear().draw();
                        $('#modalNuevoPaciente').modal('hide');
                        desbloquearPantalla();
                        hlorAlert(result);
                    }
                });
            }


        });
        

        $('#tableListPacients tbody').on('click', '.btnVisualizar', function(){
            $('#inputName').val('');
            $('#inputLastName').val('');
            $('#inputSurName').val('');
            $('#inputSelectPap').val('Seleccione Aqui');
            $('#inputRut').val('');
            $('#inputEdad').val('');
            $('#inputDireccion').val('');
            $('#inputFechaPap').val('');

            //$('#modalNuevoPaciente').modal('show');
            let data = $(this);
            let id = data[0].id;
            
            $.ajax({
                type: 'POST',
                url: hlorBase + '/visualizarPaciente',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'JSON',
                success: function(result){

                }
            }); 
        });

        $('#tableListPacients tbody').on('click', '.btnDarDeAlta', function(){
            bloquearPantalla();
            let data = $(this);
            let id = data[0].id;
            //llamada ajax para obtener el nombre
            $.ajax({
                type: 'POST',
                url: hlorBase + '/onePacient',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                dataType: 'JSON',
                success: function(result){
                    desbloquearPantalla();
                    Swal.fire({
                        title: "Dar de Alta al Paciente " + result.data[0].paciente_nombre.toUpperCase() +" "+ result.data[0].paciente_apellido_paterno.toUpperCase() +" "+ result.data[0].paciente_apellido_materno.toUpperCase() + "?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Dar de Alta!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: 'POST',
                                    url: hlorBase + '/darDeAlta',
                                    data: { id: id },
                                    dataType: 'JSON',
                                    beforeSend: function(){ bloquearPantalla(); },
                                    success: function(result){
                                        pacientTable.clear().draw();
                                        pacientTableAlta.clear().draw();
                                        desbloquearPantalla();
                                        hlorAlert(result);
                                    }
                                });
                            }
                        });
                }

            });
        });
    })
</script>
@endsection

@section('footer')
@include('includes.footer')
@endsection