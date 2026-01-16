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

    <div id="main" style="min-height: 100vh; display: flex; flex-direction: column;">
        {{-- HEADER --}}
        @include('layouts.header')

        {{-- CONTENT --}}
        <div class="page-heading">
            <h4 class="text-muted">@yield('heading')</h4>
        </div>

        <div class="page-content">
            @yield('content')
        </div>

        <div style="margin-top: auto;">
            @include('layouts.footer')
        </div>
    </div>

</div>

@include('layouts.js')
</body>
</html>
