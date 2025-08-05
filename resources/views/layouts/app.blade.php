<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul')</title>
    @include('includes.styleuser')
</head>
<!-- Preloader -->

<body>
    @include('includes.navbar')
    
    {{-- <!-- Preloader -->
    <div id="preloader" class="position-fixed top-0 start-0 w-100 h-100 bg-white d-flex justify-content-center align-items-center" style="z-index: 9999;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    </div> --}}

    <main class="main">
        @yield('content-user')
    </main>
    @include('includes.footer')
    @include('includes.scriptuser')
</body>
</html>