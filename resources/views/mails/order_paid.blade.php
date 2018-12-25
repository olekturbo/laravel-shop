@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Nowa płatność!
        @endcomponent
    @endslot

   
        Twoja płatność została zaksięgowana.

        Dziękujemy.


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