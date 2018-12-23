@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if(isset($products) && !empty($products->items))
            <h1>ZAWARTOŚĆ TWOJEGO KOSZYKA</h1>
            <table class="mt-5">
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Zdjęcie podglądowe</th>
                        <th>Rozmiar</th>
                        <th>Cena łączna</th>
                        <th>Cena jednostkowa</th>
                        <th>Ilość</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products->items as $size => $product)
                    @foreach($product as $size => $single_product)
                    <tr>
                        <td class="text-uppercase"><a href="{{ route('product', [$single_product['item']->id, str_slug($single_product['item']->name)]) }}">{{ $single_product['item']->name }}</a></td>
                        <td><img src="{{ Voyager::image($single_product['item']->front_image) }}" width="100"></td>
                        <td>{{ $size }}</td>
                        <td>{{ $single_product['price'] }} zł</td>
                        <td>{{ $single_product['item']->discount_price ?? $single_product['item']->price }} zł</td>
                        <td><input style="width: 4em" type="number" value="{{ $single_product['qty'] }}"> </td>
                        <form action="{{ route('product.deleteFromCart', [$single_product['item']->id, $size]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <td><button class="btn btn-danger" type="submit">Usuń</button></td>
                        </form>
                    </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
                <h5 class="mt-5">DO ZAPŁATY: {{ $products->totalPrice }} zł</h5>
            @else
                <h5>KOSZYK JEST PUSTY</h5>
            @endif
        </div>
    </div>
</div>
@stop