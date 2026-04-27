@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/icon/css/icon.css') }}">
    @include('icon::styles')
@endpush
<input type="hidden" id="icon_url" value="{{ route('icon.get') }}">

@push('js')
    <script src="{{ asset('vendor/icon/js/icon.js') }}"></script>
@endpush