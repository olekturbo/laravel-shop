@extends('layouts.app')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('welcome') }}">Home</a></li>
            <li><a href="{{ route('category', $product->category->name) }}">{{ $product->category->name }}</a></li>
            <li>{{ $product->name }}</li>
        </ul>
        <form method="POST" action="{{ route('product.addToCart', $product->id) }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="slider-pro" id="product-slider">
                        <div class="sp-slides">
                            @foreach($product->decoded_images as $decoded_image)
                            <div class="sp-slide">
                                <img class="sp-image" src="{{ Voyager::image($decoded_image) }}" data-src="{{ Voyager::image($decoded_image) }}" data-retina="{{ Voyager::image($decoded_image) }}">
                            </div>
                            @endforeach
                        </div>

                        <div class="sp-thumbnails">
                            @foreach($product->decoded_images as $decoded_image)
                            <img class="sp-thumbnail" src="{{ Voyager::image($decoded_image) }}" data-src="{{ Voyager::image($decoded_image) }}" data-retina="{{ Voyager::image($decoded_image) }}"/>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <h1>SUPERSTAR 2000</h1>
                    <div class="product-info pt-1">
                        @if($product->quantity > 0) <span class="badge badge-success p-2">DOSTĘPNY</span> @endif
                        @if($product->is_new) <span class="badge badge-warning p-2 text-white">NOWOŚĆ</span> @endif
                        @if($product->is_discount) <span class="badge badge-danger p-2">PROMOCJA</span> @endif
                    </div>
                    <h3 class="pt-3"><i class="fas fa-dollar-sign"></i> @if($product->discount_price) {{ $product->discount_price }} PLN <del style="color: #dc3545">{{ $product->price }}PLN</del> @else {{ $product->price }} PLN @endif</h3>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="product-size">
                                <h5>ROZMIAR</h5>
                                @foreach($product->decoded_sizes as $decoded_size)
                                <div class="icheck-success icheck-inline">
                                    <input type="radio" id="r{{ $loop->index }}" name="size" value="{{ $decoded_size }}" />
                                    <label for="r{{ $loop->index }}">{{ $decoded_size }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if($product->quantity > 0)
                            <h5>ILOŚĆ</h5>
                            <input name="quantity" class="w-50" type="number" min="1" max="{{ $product->quantity }}" step="1" value="1">
                            @else
                            <h5>BRAK NA MAGAZYNIE</h5>
                            @endif
                        </div>
                    </div>
                    @if($product->quantity > 0)
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button id="checkBtn" type="submit" class="btn btn-template btn-lg"><i class="fas fa-shopping-cart"></i> Dodaj do koszyka</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </form>
        <div class="row mt-3">
            <div class="col-md-12">
                <h1>OPIS</h1>
                {!! $product->description !!}
            </div>
        </div>
        @if($similar_products->count())
        <div class="row mt-3">
            <div class="col-md-12">
                <h1>PRODUKTY PODOBNE</h1>
            </div>
            @foreach($similar_products as $similar_product)
                    <div class="col-md-3">
                        <a href="{{ route('product', [$similar_product->category->name, $similar_product->id, str_slug($similar_product->name)]) }}">
                            <img class="w-100" src="{{ Voyager::image($similar_product->front_image) }}">
                            <p class="text-center text-uppercase">{{ $similar_product->name }}</p>
                        </a>
                    </div>
            @endforeach
        </div>
        @endif
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#checkBtn').click(function() {
                checked = $("input[type=radio]:checked").length;

                if(!checked) {
                    alert("Musisz zaznaczyć rozmiar!");
                    return false;
                }

            });
        });
    </script>
@stop
