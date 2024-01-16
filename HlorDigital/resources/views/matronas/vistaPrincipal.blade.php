@extends('layout.app')

@section('header')
@include('includes.header')
@endsection

@section('content')
<div class="row m-3">
    <div class="col-12">
        <button class="btn btn-success text-white"><i class="text-white fa-solid fa-square-plus me-1"></i> Nuevo Paciente</button>
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


@section('footer')
@include('includes.footer')
@endsection