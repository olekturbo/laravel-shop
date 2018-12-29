@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Uzupełnij dane adresowe</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('provider.store-data') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="post_code" class="col-md-4 col-form-label text-md-right">Kod pocztowy</label>

                                <div class="col-md-6">
                                    <input id="post_code" type="text" class="form-control" name="post_code" value="{{ old('post_code') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">Miejscowość</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street" class="col-md-4 col-form-label text-md-right">Ulica</label>

                                <div class="col-md-6">
                                    <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Telefon</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-template">
                                        Wyślij
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new Cleave('#post_code', {
            blocks: [2,3],
            delimiter: '-',
            numericOnly: true
        });

        new Cleave('#phone', {
            prefix: '+48',
            noImmediatePrefix: true,
            blocks: [3,3,3,3],
            delimiters: [' ', '-', '-'],
            numericOnly: true
        });
    </script>
@stop
