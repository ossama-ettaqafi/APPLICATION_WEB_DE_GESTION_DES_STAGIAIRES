<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Service</title>
    <link rel="icon" href="{{ asset('images/suninternship-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/default-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main-pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
</head>

<body>
    @if(Auth::check())
        @include('partials.navbar-connected')
    @else
        @include('partials.navbar-unconnected')
    @endif

    @include('contents.service')
    @include('partials.footer')
</body>
</html>
