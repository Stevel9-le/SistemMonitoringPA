<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    @include('layouts.css')
</head>

<body>
<div id="app">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    <div id="main">
        {{-- HEADER --}}
        @include('layouts.header')

        {{-- CONTENT --}}
        <div class="page-heading">
            @yield('heading')
        </div>

        <div class="page-content">
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>

</div>

@include('layouts.js')
</body>
</html>
