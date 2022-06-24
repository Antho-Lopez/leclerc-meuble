<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Primary Meta Tags -->
    <title>E.Lerclerc meuble Basse-Goulaine: Meuble, idée déco, électroménager</title>
    <meta name="title" content="E.Lerclerc meuble Basse-Goulaine: Meuble, idée déco, électroménager">
    <meta name="description"
        content="Découvrez nos produits chez E.Leclerc meuble Basse-Goulaine !  Des nouveautés toute l'année ( lit, matelas, table, chaise et bureau, canapés, électroménager décoration)">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://app.eleclercbassegoulaine.fr/leclerc-meuble">
    <meta property="og:title" content="E.Lerclerc meuble Basse-Goulaine: Meuble, idée déco, électroménager">
    <meta property="og:description"
        content="Découvrez nos produits chez E.Leclerc meuble Basse-Goulaine !  Des nouveautés toute l'année ( lit, matelas, table, chaise et bureau, canapés, électroménager décoration)">
    <meta property="og:image" content="{{ asset('img/reseau.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://app.eleclercbassegoulaine.fr/leclerc-meuble">
    <meta property="twitter:title" content="E.Lerclerc meuble Basse-Goulaine: Meuble, idée déco, électroménager">
    <meta property="twitter:description"
        content="Découvrez nos produits chez E.Leclerc meuble Basse-Goulaine !  Des nouveautés toute l'année ( lit, matelas, table, chaise et bureau, canapés, électroménager décoration)">
    <meta property="twitter:image" content="{{ asset('img/reseau.jpg') }}">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/submit.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d78aa9e790.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo-nav.png') }}" />
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top zindex-sticky bg-dark">
            <div class="container">
                <a href="/">
                    <img src="{{asset('img/logo_meuble_blanc.png')}}" style="height: 60px">
                </a>
            </div>
        </nav>
        @if (Session::has('success_message'))
        <div id="alarmmsg" class="alert alert-success m-0" role="alert">
            <p class="m-1">{{Session::get('success_message')}}</p>
        </div>
        @endif

        @if (Session::has('error_message'))
        <div class="alert alert-success m-0" role="alert">
            <p class="m-1">{{Session::get('error_message')}}</p>
        </div>
        @endif
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
