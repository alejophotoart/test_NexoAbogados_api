@extends('index')

@section('content')
    <h1>Abogados</h1>

    @include('message.pendingMessage')

    <table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __("Nombre") }}</th>
            <th scope="col">{{ __("Email") }}</th>
            <th scope="col">{{ __("Fecha de creacion") }}</th>
            <th scope="col">{{ __("Suscribir") }}</th>
            <th scope="col">{{ __("Acciones") }}</th>
        </tr>
    </thead>
    <tbody>

        @foreach($users as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ $a->name }}</td>
            <td>{{ $a->email }}</td>
            <td>{{ $a->created_at }}</td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input subsSwitch" type="checkbox" role="switch" value="{{ $a->id }},{{ $a->name }}" data-bs-toggle="modal" data-bs-target="#createSub">
                </div>
            </td>
            <td>
                <a href="#">
                    <i class="fas fa-trash-alt" style="color: black; margin: 5px"></i>
                </a>
                <a href="#">
                    <i class="fas fa-eye" style="color: black; margin: 5px"></i>
                </a>
            </td>
        </tr>
        @endforeach
   
    </tbody>
</table>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        var miCheckboxes = document.querySelectorAll('.subsSwitch');
        var modalSubs = document.getElementById('createSub');
        
        miCheckboxes.forEach((miCheckbox) => {
            miCheckbox.addEventListener('click', function() {
                
                if(miCheckbox.checked) {
                    let arr = miCheckbox.value;
                    
                    let arr2 = arr.split(',');
                    console.log(arr2);
                    
                    let id = arr2[0];
                    let name = arr2[1];
                    
                    localStorage.clear();
                    localStorage.setItem('id', id);
                    localStorage.setItem('name', name);

                    $('#modalName').attr('value', name);
                    $('#name').attr('value', name);
                    $('#idUser').attr('value', id);

                }
            });
        })



    });
</script>

@include('subscriptions.create')

@endsection