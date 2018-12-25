@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Zweryfikuj Twój adres e-mail</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Weryfikacyjny adres-email został wysłany na Twoje konto!
                        </div>
                    @endif

                    Jeśli nie otrzymałeś od nas e-maila, <a href="{{ route('verification.resend') }}">ponów próbę</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
