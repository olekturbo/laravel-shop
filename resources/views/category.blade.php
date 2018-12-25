@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-5 item-row">
            <div class="col-md-12 text-center">
                <h2 class="item-header">{{ $category->name }}</h2>
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
        {{ $products->links() }}
    </div>
@stop