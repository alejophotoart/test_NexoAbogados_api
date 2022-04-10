@extends('index')
<!-- Tabla de recurrencias segun la informacion que devuelve el backend -->
@section('contents')
    <h1>Recurrencias</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __("Abogado") }}</th>
                <th scope="col">{{ __("Email") }}</th>
                <th scope="col">{{ __("Fecha de Recurrencia") }}</th>
                <th scope="col">{{ __("Fecha de Suscripcion") }}</th>
            </tr>
        </thead>
        <tbody>

            @foreach($recurrents as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->subscription->user->name }}</td>
                <td>{{ $r->subscription->user->email }}</td>
                <td>{{ $r->date_recurrent }}</td>
                <td>{{ $r->subscription->date_subscription }}</td>
            </tr>
            @endforeach
    
        </tbody>
    </table>
@endsection