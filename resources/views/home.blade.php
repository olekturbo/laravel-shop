@extends('layouts.app')

@section('content')
    <div class="container">
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
        <div class="row pt-5 item-row">
            <div class="col-md-12 text-center">
                <h2 class="item-header">najnowsze produkty</h2>
                <hr class="pb-5">
            </div>
            @foreach($products as $product)
                <a href="{{ route('product', [$product->category->name, $product->id, str_slug($product->name)]) }}" class="col-md-4">
                    <img src="{{ Voyager::image($product->front_image) }}" class="img-fluid rounded"  onmouseover="this.src='{{ Voyager::image($product->back_image) }}';" onmouseout="this.src='{{ Voyager::image($product->front_image) }}'">
                    <div class="item-title text-uppercase">
                        {{ $product->name }}
                    </div>
                    <div class="item-price">
                        {{ $product->discount_price ?? $product->price }} PLN
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <section class="home-newsletter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <form action="" method="post">
                        <div class="single">
                            <h2>Dołącz do naszego newslettera</h2>
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Wprowadź adres-email">
                                <span class="input-group-btn"><button class="btn btn-theme" type="submit">subskrybuj</button></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row contact-row">
            <div class="col-md-12 text-center">
                <h2 class="contact-header">formularz kontaktowy</h2>
                <hr class="pb-5">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control" name="first_name" placeholder="Imię" /><br />
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" name="last_name" placeholder="Nazwisko" /><br />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control" name="email" placeholder="Email" /><br />
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" name="tel" placeholder="Telefon" /><br />
                        </div>
                    </div>
                    <textarea class="form-control" name="text" placeholder="wiadomość..." style="height:150px;"></textarea><br />
                    <input class="btn btn-lg btn-primary" type="submit" value="Wyślij" /><br /><br />
                </form>
            </div>
        </div>
    </div>
@stop