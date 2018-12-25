@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Nowe zamówienie o numerze {{ $order->number }}!
        @endcomponent
    @endslot

    @component('mail::table')
        Twoja płatność została zaksięgowana.

        Dziękujemy.
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