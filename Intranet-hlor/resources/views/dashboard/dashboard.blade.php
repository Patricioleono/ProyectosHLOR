@extends('layouts.dashboard')


@section('dashboard')
    <div class="grid grid-cols-auto mt-3">
       <div class="grid justify-items-center mt-3">
           <h3>Enlaces de Utilidad</h3>
           <a target="_blank" href="http://10.8.110.4/autoconsulta/" class="rounded btn btn-ghost mt-3 font-bold">Auto Consulta</a>
           <a target="_blank" href="https://ceropapel.saludaysen.cl/login/index.php" class="rounded btn btn-ghost mt-3 font-bold">Cero Papel</a>
           <a target="_blank" href="http://10.8.110.9/" class="rounded btn btn-ghost mt-3 font-bold">Panel de Documentos</a>
       </div>
    </div>
@endsection


@section('script_dashboard')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
