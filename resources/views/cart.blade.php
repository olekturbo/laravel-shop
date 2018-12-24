@extends('layouts.app')
@section('content')
@include('layouts.partials.cart_messages')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if(isset($products) && !empty($products->items))
            <h1 class="text-center">ZAWARTOŚĆ TWOJEGO KOSZYKA</h1>
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
                        <form id="transferForm" method="POST" action="{{ route('transfer.order') }}">
                            @csrf
                            <td data-column="Produkt" class="text-uppercase"><a href="{{ route('product', [$single_product['item']->id, str_slug($single_product['item']->name)]) }}">{{ $single_product['item']->name }}</a></td>
                            <td data-column="Zdjęcie podglądowe"><img src="{{ Voyager::image($single_product['item']->front_image) }}" width="100"></td>
                            <td data-column="Rozmiar">{{ $size }}</td>
                            <td data-column="Cena łączna" id="product{{ $single_product['item']->id }}{{ $size }}">{{ $single_product['price'] }} zł</td>
                            <td data-column="Cena jednostkowa">{{ $single_product['item']->discount_price ?? $single_product['item']->price }} zł</td>
                            <td data-column="Ilość">
                                <input data-url="{{ route('product.updateCart', [$single_product['item']->id, $size]) }}" class="quantity-input" style="width: 4em" type="number" value="{{ $single_product['qty'] }}">
                            </td>
                            <input type="hidden" name="group" id="tpay_group">
                        </form>
                        <form id="deleteForm" action="{{ route('product.deleteFromCart', [$single_product['item']->id, $size]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <td data-column="Akcje"><button form="deleteForm" class="btn btn-template" type="submit"><i class="fas fa-trash"></i> </button></td>
                        </form>
                    </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
                <div class="row mt-5">
                    <div class="col-md-12 text-right">
                        <h5 name="totalPrice" id="totalPrice">DO ZAPŁATY: {{ $products->totalPrice }} zł</h5>
                    </div>
                   <div class="col-md-12 mt-5">
                       <h5 class="text-center">DANE ADRESOWE</h5>
                       <div class="row mt-5">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <input form="transferForm" name="first_name" type="text" id="first_name" class="form-control" required>
                                   <label class="form-control-placeholder" for="first_name">Imię</label>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <input form="transferForm" name="last_name" type="text" id="last_name" class="form-control" required>
                                   <label class="form-control-placeholder" for="last_name">Nazwisko</label>
                               </div>
                           </div>
                       </div>
                       <div class="row mt-3">
                           <div class="col-md-4">
                               <div class="form-group">
                                   <input form="transferForm" name="street" type="text" id="street" class="form-control" required>
                                   <label class="form-control-placeholder" for="street">Ulica</label>
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="form-group">
                                   <input form="transferForm" name="post_code" type="text" id="post_code" class="form-control" required>
                                   <label class="form-control-placeholder" for="post_code">Kod pocztowy</label>
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="form-group">
                                   <input form="transferForm" name="city" type="text" id="city" class="form-control" required>
                                   <label class="form-control-placeholder" for="city">Miejscowość</label>
                               </div>
                           </div>
                       </div>
                       <div class="row mt-3">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <input form="transferForm" name="email" type="email" id="email" class="form-control" required>
                                   <label class="form-control-placeholder" for="email">Adres e-mail</label>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <input form="transferForm" name="phone" type="tel" id="phone" class="form-control" required>
                                   <label class="form-control-placeholder" for="phone">Telefon</label>
                               </div>
                           </div>
                       </div>
                   </div>
                    <div class="col-md-12 text-center mt-5">
                        <h5>WYBIERZ FORMĘ PŁATNOŚCI</h5>
                        <div id="tpay_content" class="mt-5"></div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <p><input type="checkbox" name="rules_confirmation"> Akceptuję regulamin serwisu <a target="_blank" href="https://tpay.com/regulaminy-i-umowy">Tpay</a></p>
                        <button id="transferBtn" form="transferForm" type="submit" class="btn btn-template">REALIZUJ ZAMÓWIENIE</button>
                    </div>
                </div>
            @else
                <h5>KOSZYK JEST PUSTY</h5>
            @endif
        </div>
    </div>
</div>
@stop

@section('js')
    <script type="text/javascript" src="https://secure.tpay.com/groups-10100.js"></script>
    <script>
        jQuery(document).ready(function(){
            jQuery('.toast__close').click(function(e){
                e.preventDefault();
                var parent = $(this).parent('.toast');
                parent.fadeOut("slow", function() { $(this).remove(); } );
            });
            @if(session()->has('cart_message'))
            $('.sessionMessage').fadeIn('slow', function(){
                $('.sessionMessage').delay(2000).fadeOut();
            });
            @endif
            $('#transferBtn').click(function() {
                checked = $("input[name='rules_confirmation']:checked").length;

                if(!checked) {
                    alert("Musisz zaakceptować regulamin!");
                    return false;
                }

            });

        });
    </script>
@stop