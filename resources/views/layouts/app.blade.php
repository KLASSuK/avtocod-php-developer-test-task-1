<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('layouts.partials.html_header')
</head>
<body>
    <div id="app">
        @include('layouts.partials.main_header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('inline_scripts')
</body>
</html>
