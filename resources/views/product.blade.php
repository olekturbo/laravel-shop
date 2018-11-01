@extends('layouts.app')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Bluzy</a></li>
            <li>SUPERSTAR 2000</li>
        </ul>
        <div class="row">
            <div class="col-md-6">
                <div class="slider-pro" id="product-slider">
                    <div class="sp-slides">
                        <div class="sp-slide">
                            <img class="sp-image" src="{{ asset('images/product1.jpg') }}" data-src="{{ asset('images/product1.jpg') }}" data-retina="{{ asset('images/product2.jpg') }}">
                        </div>
                        <div class="sp-slide">
                            <a href="http://bqworks.com">
                                <img class="sp-image" src="{{ asset('images/product2.jpg') }}" data-src="{{ asset('images/product2.jpg') }}" data-retina="{{ asset('images/product2.jpg') }}"/>
                            </a>
                        </div>
                        <div class="sp-slide">
                            <a href="http://bqworks.com">
                                <img class="sp-image" src="{{ asset('images/product3.jpg') }}" data-src="{{ asset('images/product3.jpg') }}" data-retina="{{ asset('images/product3.jpg') }}"/>
                            </a>
                        </div>
                        <div class="sp-slide">
                            <a href="http://bqworks.com">
                                <img class="sp-image" src="{{ asset('images/product4.jpg') }}" data-src="{{ asset('images/product4.jpg') }}" data-retina="{{ asset('images/product4.jpg') }}"/>
                            </a>
                        </div>
                    </div>

                    <div class="sp-thumbnails">
                        <img class="sp-thumbnail" src="{{ asset('images/product1.jpg') }}" data-src="{{ asset('images/product1.jpg') }}" data-retina="{{ asset('images/product1.jpg') }}"/>
                        <img class="sp-thumbnail" src="{{ asset('images/product2.jpg') }}" data-src="{{ asset('images/product2.jpg') }}" data-retina="{{ asset('images/product2.jpg') }}"/>
                        <img class="sp-thumbnail" src="{{ asset('images/product3.jpg') }}" data-src="{{ asset('images/product3.jpg') }}" data-retina="{{ asset('images/product3.jpg') }}"/>
                        <img class="sp-thumbnail" src="{{ asset('images/product4.jpg') }}" data-src="{{ asset('images/product4.jpg') }}" data-retina="{{ asset('images/product4.jpg') }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-5">
                <h1>SUPERSTAR 2000</h1>
                <div class="product-info pt-1">
                    <span class="badge badge-success p-2">DOSTĘPNY</span>
                    <span class="badge badge-warning p-2 text-white">NOWOŚĆ</span>
                    <span class="badge badge-danger p-2">PROMOCJA</span>
                </div>
                <h3 class="pt-3"><i class="fas fa-dollar-sign"></i> 119,90 PLN <del style="color: #dc3545">149,90 PLN</del></h3>
                <div class="product-size pt-2">
                    <div class="icheck-success icheck-inline">
                        <input type="radio" id="r1" name="size" />
                        <label for="r1">S</label>
                    </div>
                    <div class="icheck-success icheck-inline">
                        <input type="radio" id="r2" name="size"/>
                        <label for="r2">M</label>
                    </div>
                    <div class="icheck-success icheck-inline">
                        <input type="radio" id="r3" name="size" />
                        <label for="r3">L</label>
                    </div>
                    <div class="icheck-success icheck-inline">
                        <input type="radio" id="r4" name="size" />
                        <label for="r4">XL</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
