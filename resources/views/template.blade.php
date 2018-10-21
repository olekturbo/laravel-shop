<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sklep internetowy wykorzystujący framework Laravel">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MyOwn Laravel Shop</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/template.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    @yield('css')
</head>
<body>
    <div class="container pt-3">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="logo">
            </a>
            <div class="nav-option order-lg-last">
                <a class="nav-item nav-link" href="#"><i class="fa fa-user"></i> twoje konto</a>
                <a class="nav-item nav-link" href="#"><i class="fa fa-shopping-cart"></i> koszyk</a>
            </div>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <div class="navbar-nav text-center text-right pr-3">
                    <a class="nav-item nav-link active" href="#">bluzy</a>
                    <a class="nav-item nav-link" href="#">koszulki</a>
                    <a class="nav-item nav-link" href="#">spodnie</a>
                    <a class="nav-item nav-link" href="#">kurtki</a>
                    <a class="nav-item nav-link" href="#">akcesoria</a>
                    <a class="nav-item nav-link" href="#">muzyka</a>
                </div>
            </div>
        </nav>
        <div id="clothesCarousel" class="carousel slide pt-5" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('images/ubrania.jpeg') }}" alt="First cloth">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/ubrania2.jpg') }}" alt="Second cloth">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/ubrania3.jpg') }}" alt="Third cloth">
                </div>
            </div>
            <a class="carousel-control-prev" href="#clothesCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#clothesCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    @yield('content')
    <script src="{{ mix('js/template.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
