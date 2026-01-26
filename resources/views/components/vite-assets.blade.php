{{-- Vite React Assets Component --}}
@if (app()->environment('local'))
    {{-- Development Mode --}}
    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
@else
    {{-- Production Mode --}}
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
@endif

