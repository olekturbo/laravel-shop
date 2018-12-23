@extends('layouts.app')

@section('content')
@include('layouts.partials.cart_messages')
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
                        <td>
                            <input data-url="{{ route('product.updateCart', [$single_product['item']->id, $size]) }}" id="quantity" style="width: 4em" type="number" value="{{ $single_product['qty'] }}">
                        </td>
                        <form action="{{ route('product.deleteFromCart', [$single_product['item']->id, $size]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <td><button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i> </button></td>
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

@section('js')
    <script>
        jQuery(document).ready(function(){
            jQuery('.toast__close').click(function(e){
                e.preventDefault();
                var parent = $(this).parent('.toast');
                parent.fadeOut("slow", function() { $(this).remove(); } );
            });
            @if(session()->has('cart_message'))
            $('.toast__container').fadeIn('slow', function(){
                $('.toast__container').delay(5000).fadeOut();
            });
            @endif

            $('#quantity').change(function(){
                var value=$(this).val();
                var url = $(this).attr('data-url');
                $.ajax({
                    type : 'get',
                    dataType: 'json',
                    url  : url,
                    data : {'value':value},
                    success:function(data) {
                        console.log(data);
                    }
                });
            });

        });
    </script>
@stop