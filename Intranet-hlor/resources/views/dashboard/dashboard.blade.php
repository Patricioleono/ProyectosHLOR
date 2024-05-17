@extends('layouts.dashboard')


@section('dashboard')
    dashboard
@endsection


@section('script_dashboard')
    <script>
        $(document).ready(function() {
            $('#logout').on('click', function() {
                console.log('dashboard cargado')
            });
        });
    </script>
@endsection
