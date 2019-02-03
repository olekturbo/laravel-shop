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
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" type="text/css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
    @yield('css')
</head>
<body>
    <div id="preloader">
        <div style="background-image: url({{ asset('images/preloader.gif') }});" id="status">&nbsp;</div>
    </div>
    <div class="container pt-3">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img id="logo" src="{{ asset('images/logo.png') }}" alt="logo">
            </a>
            <div class="nav-option order-lg-last">
                @auth
                <a class="nav-item nav-link" href="#"><i class="fa fa-user"></i> twoje konto</a>
                <a class="nav-item nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    <i class="fas fa-sign-out-alt"></i> Wyloguj
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @else
                <a class="nav-item nav-link @if(\Request::route()->getName() == 'register') active @endif" href="{{ route('register') }}"><i class="fa fa-user"></i> rejestracja</a>
                <a class="nav-item nav-link @if(\Request::route()->getName() == 'login') active @endif" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> logowanie</a>
                @endauth
                <a class="nav-item nav-link @if(\Request::route()->getName() == 'cart') active @endif" href="{{ route('product.showCart') }}"><i class="fa fa-shopping-cart"></i> koszyk @if(session()->get('cart')) <span id="totalQty" class="shopping-cart-amount ml-1">{{ session()->get('cart') ? session()->get('cart')->totalQty : "" }}</span> @endif </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <div class="navbar-nav text-center text-right pr-3">
                    @foreach($categories as $category)
                        <a class="nav-item nav-link @if(array_key_exists('category', \Request::route()->parameters) && (\Request::route()->parameters['category'] === $category->name)) active @endif" href="{{ route('category', $category->name) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </nav>
    </div>
    <div class="shopping-cart-right">
        <button class="btn btn-xs btn-template" data-toggle="toggle" data-target="#shopping-cart-right-full"><i class="fas fa-shopping-bag"></i> <strong>koszyk</strong> </button>
        <div id="shopping-cart-right-full" class="">
            @if(session()->get('cart'))
                @foreach(session()->get('cart')->items as $product)
                    @foreach($product as $size => $single_product)
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ Voyager::image($single_product['item']->front_image) }}" width="64">
                            </div>
                            <div class="col-md-8">
                                <a href="{{ route('product', [$single_product['item']->category->name,$single_product['item']->id, str_slug($single_product['item']->name)]) }}">{{ $single_product['item']->name }}</a>
                                <p class="small">Ilość: {{ $single_product['qty'] }}, Rozmiar: {{ $size }}</p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @endforeach
            <h5 class="pb-3">CENA ŁĄCZNA: {{ session()->get('cart')->totalPrice }} zł</h5>
            @else
                Brak produktów w koszyku
            @endif
        </div>
    </div>
        @yield('content')

    <footer>
        <div class="copy text-center font-weight-bold">
            <span class="my-orange">©</span> {{ date('Y') }} <span class="my-orange">myown.vh</span> all rights reserved
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    @yield('js')
</body>
</html>
