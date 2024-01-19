<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hlor - Intranet</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
     <!-- FONT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
</head>

<body>
    <!--MATRONAS APP-->
    @yield('header')
        @yield('content')
        @yield('modalMatronas')
    @yield('footer')

    <!-- JAVASCRIPT SCRIPT -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var hlorBase = "{{ url('/') }}";


        function hlorAlert(status){
            let message = '';
            let title = '';
            let type = 0;

            switch(status.status){
                case 400:
                    type = 'error'
                    title = 'Error de usuario'
                    message = 'Por Favor Verifique los campos llenados'
                    break
                default:
                    //cae aqui si es correcto(200)
                    type = 'success'
                    title = 'comunicado exitoso'
                    text = 'comunicado exitoso'
                    break
            }

            Swal.fire({
                title: `${title}`,
                text: `${message}`,
                icon: `${type}`
            });
        }

        function formValidation(name, lastName, surName, statePap, rutSinDv, rutDv, edad, direccion, fechaPap){
            if(name.length < 3 || lastName.length < 3 || surName.length < 3 || statePap == 'Seleccione Aqui' || rutSinDv == 0 || edad < 10 || edad > 90 || direccion.length < 3){
                return {'status': 400}
            }else{
                return {'status': 200}
            }
        }
    </script>
    @yield('scriptMatronas')
 </body>

</html>