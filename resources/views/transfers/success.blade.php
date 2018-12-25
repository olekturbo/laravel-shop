@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-5">TRANSAKCJA ZAKOŃCZONA SUKCESEM!</h5>
                <p class="mt-5">Dziękujemy za skorzystanie z naszych usług i złożenie zamówienia o numerze <strong>{{ $order }}</strong>. Szczegóły znajdziesz w swojej skrzynce e-mail.</p>
            </div>
        </div>
    </div>
@endsection