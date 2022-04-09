@extends('index')

@section('content')
    <h1>Suscripciones</h1>

    @include('message.deleteMessage')

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __("Abogado") }}</th>
                <th scope="col">{{ __("Email") }}</th>
                <th scope="col">{{ __("Valor Suscripcion") }}</th>
                <th scope="col">{{ __("Fecha de Suscripcion") }}</th>
                <th scope="col">{{ __("Estado de Suscripcion") }}</th>
                <th scope="col">{{ __("Acciones") }}</th>
            </tr>
        </thead>
        <tbody>

            @foreach($subscriptions as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->user->name }}</td>
                <td>{{ $s->user->email }}</td>
                <td>$ {{ number_format($s->price_subs->price, 2, ",", ".") }}</td>
                <td>{{ $s->date_subscription }}</td>
                @if( $s->confirmed == 0 )
                <td>{{ __("Pendiente") }}</td>
                @elseif( $s->confirmed == 1 ) 
                <td>{{ __("Activo") }}</td>
                @endif
                <td>
                    <a data-bs-toggle="modal" data-bs-target="#detaillSub">
                        <i class="fas fa-eye" style="color: black; margin: 5px; cursor: pointer;" onclick="showDetaills('{{ $s->id }}')"></i>
                    </a>
                    <form action="{{ route('subscription.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="text" value="{{ $s->id }}" name="id" hidden>
                        <input type="text" value="{{ $s->user->name }}" name="name" hidden>

                        <button style="background-color: transparent; border-color: transparent;" type="submit">
                            <i class="fas fa-ban" style="color: black; margin: 5px; cursor: pointer;"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
    
        </tbody>
    </table>

    <script>
        function showDetaills(id) {
    
            $.ajax({
                url: "/getDetaills/subscriptions/" + id,
                type: "GET",
                contentType: "application/json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    contentType: "application/json"
                },
                success: function(r) {
                    console.log(r);

                    let detailuser = r.detaill.user;
                    let detailPrice = r.detaill.price_subs;
                    let details = r.detaill;

                    const options2 = { style: 'currency', currency: 'USD' };
                    const numberFormat2 = new Intl.NumberFormat('en-US', options2);

                    $("#userName").val(detailuser.name);
                    $("#userEmail").val(detailuser.email);
                    $("#subPrice").val(numberFormat2.format(detailPrice.price));
                    $("#userIn").val(detailuser.created_at);
                    $("#subDate").val(details.date_subscription);
                    if( details.confirmed == 0 ){
                        $("#subState").val("Pendiente");
                    }else if(details.confirmed == 1){
                        $("#subState").val("Activo");
                    }

                    if( detailuser.subscribed == 0 ){
                        $("#subConfirm").val("Sin confirmar");
                    }else if(detailuser.subscribed == 1){
                        $("#subState").val("Confirmado");
                    }

                }
            });
        }
    </script>

    @include('subscriptions.detaill')

@endsection