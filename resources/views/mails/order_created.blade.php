@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Nowe zamówienie o numerze {{ $order->number }}!
        @endcomponent
    @endslot

    @component('mail::table')
        | Produkt       | Zdjęcie podglądowe         | Rozmiar  | Cena łączna  | Cena jednostkowa  | Ilość  |
        | ------------- | ------------- | ---------- |:--------:| ------------ | ----------------- |:------:|
        @foreach($products as $product)
        | <a href="{{ route('product', [$product->id, str_slug($product->name)]) }}">{{ strtoupper($product->name) }}</a>     | <img src="{{ Voyager::image($product->front_image) }}" width="100">      |      {{ $product->pivot->size }} | {{ $product->discount_price ? $product->discount_price * $product->pivot->quantity : $product->price * $product->pivot->quantity }} zł | {{ $product->discount_price ?? $product->price }} zł | {{ $product->pivot->quantity }} |
        @endforeach
    @endcomponent

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')

            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} Laravel MyOwnApp
        @endcomponent
    @endslot
@endcomponent