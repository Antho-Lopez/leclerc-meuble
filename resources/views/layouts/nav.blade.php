<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Primary Meta Tags -->
     <title>E.Lerclerc meuble Basse-Goulaine: Meuble, idée déco, électroménager</title>
     <meta name="title" content="E.Lerclerc meuble Basse-Goulaine: Meuble, idée déco, électroménager">
     <meta name="description" content="Découvrez nos produits chez E.Leclerc meuble Basse-Goulaine !  Des nouveautés toute l'année ( lit, matelas, table, chaise et bureau, canapés, électroménager décoration)">

     <!-- Open Graph / Facebook -->
     <meta property="og:type" content="website">
     <meta property="og:url" content="https://app.eleclercbassegoulaine.fr/leclerc-meuble">
     <meta property="og:title" content="E.Lerclerc meuble Basse-Goulaine: Meuble, idée déco, électroménager">
     <meta property="og:description" content="Découvrez nos produits chez E.Leclerc meuble Basse-Goulaine !  Des nouveautés toute l'année ( lit, matelas, table, chaise et bureau, canapés, électroménager décoration)">
     <meta property="og:image" content="{{ asset('img/reseau.jpg') }}">

     <!-- Twitter -->
     <meta property="twitter:card" content="summary_large_image">
     <meta property="twitter:url" content="https://app.eleclercbassegoulaine.fr/leclerc-meuble">
     <meta property="twitter:title" content="E.Lerclerc meuble Basse-Goulaine: Meuble, idée déco, électroménager">
     <meta property="twitter:description" content="Découvrez nos produits chez E.Leclerc meuble Basse-Goulaine !  Des nouveautés toute l'année ( lit, matelas, table, chaise et bureau, canapés, électroménager décoration)">
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
                <a href="{{ route('backoffice-home') }}">
                    <img src="{{asset('img/logo_meuble_blanc.png')}}" style="height: 60px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-lg-flex flex-lg-grow-0" id="navbarText">

                    <div class="dropdown mt-2 mb-2">
                        <button class="btn btn-outline-light nav-btn dropdown-toggle" type="button" id="dropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Gestionnaire
                        </button>
                        <ul class="dropdown-menu bg-light m-0 p-0" aria-labelledby="dropdown">
                            <li class="d-grid gap-2">
                                <a href="{{ route('product.index') }}"class="dropdown-item">Produits</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('category.index') }}"class="dropdown-item">Catégories</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('inspiration.index') }}" class="dropdown-item">Collections</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('brand.index') }}"class="dropdown-item">Marques</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('material.index') }}"class="dropdown-item">Matériaux / Revetements</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('color.index') }}"class="dropdown-item">Couleurs</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('dimension.index') }}"class="dropdown-item">Dimensions</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('social_media.index') }}"class="dropdown-item">Réseaux sociaux</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('img_global.index') }}"class="dropdown-item">Images</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('contact.show', 1) }}" class="dropdown-item">Infos de contact</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('shape.index') }}"class="dropdown-item">Formes</a>
                            </li>
                            <li class="d-grid gap-2">
                                <a href="{{ route('statistic.index') }}"class="dropdown-item">Statistiques</a>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown mt-2 mb-2">
                        <button class="btn btn-outline-light nav-btn dropdown-toggle" type="button" id="dropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="text-uppercase">{{Auth::user()->name}}</span>
                        </button>
                        <ul class="dropdown-menu bg-light m-0 p-0" aria-labelledby="dropdown">
                            <li class="d-grid gap-2">
                                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Déconnexion') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="alert alert-danger p-5 m-0 d-none" id="navigator_support" role="alert">
            <p class="m-1 fs-2 text-center"><i class="fas fa-exclamation-triangle text-warning"></i> Pour que la plateforme fonctionne correctement merci d'utiliser le navigateur Google Chrome ou Mozilla Firefox <i class="fas fa-exclamation-triangle text-warning"></i></p>
        </div>
        @if (Session::has('success_message'))
            <div class="alert alert-success p-3 m-0" role="alert">
                <p class="m-1">{{Session::get('success_message')}}</p>
            </div>
        @endif
        @if (Session::has('error_message'))
            <div class="alert alert-success p-3 m-0" role="alert">
                <p class="m-1">{{Session::get('error_message')}}</p>
            </div>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
