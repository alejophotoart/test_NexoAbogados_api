<!-- @auth
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- Se importa CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('/css/app.css') }}"></link>  -->
    <!-- Font-Awesome -->
    <!-- <script src="https://kit.fontawesome.com/fac3d9d15e.js" crossorigin="anonymous"></script>  -->
    <!-- <title>NexoAbogados</title>
</head>
    <body> -->
    @extends('layouts.app')

    @section('content')

        <div class="card m-4 mx-auto" style="width: 900px;">
            <div class="card-header">
                <nav class="nav nav-pills nav-fill">
                    <a class="nav-link" href="{{ route('users.index') }}">Abogados</a>
                    <a class="nav-link" href="{{ route('subscriptions.index') }}">Suscripciones</a>
                    <a class="nav-link" href="{{ route('recurrents.index') }}">Recurrencias</a>
                </nav>
            </div>
            <div class="card-body">
                <!-- vista principal con las opciones de cada tabla -->
                @yield('contents')
            </div>
        </div>
        <!-- Se importa JS y Jquery -->
        <!-- <script src="{{ asset('/js/app.js') }}"></script> -->
        <script src="{{ asset('/js/jquery.js') }}"></script>
        @endsection
    <!-- </body>
</html>
@endauth -->