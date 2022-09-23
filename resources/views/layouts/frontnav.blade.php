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

        <nav class="navbar navbar-expand-lg navbar-dark fixed-top p-2 mb-5 custom-shadow bg-dark d-none d-lg-block d-xl-block d-xxl-block">
            <div class="container-fluid d-flex flex-row">
              <div class="d-flex flex-row-reverse col-7 justify-content-between">
                <div class="">
                  <a href="{{ route('home') }}">
                        <img src="{{ Storage::url($logo->img_name) }}" alt="{{ $logo->name }}" style="height: 60px">
                  </a>
                </div>
                <div class="">
                  <form class="d-flex ms-3">
                    <nav-search one_product="{{ route('oneproduct', "#") }}" no_visuel="{{asset('img/no-visuel.jpg')}}"></nav-search>
                  </form>
                </div>
              </div>
                <div class="col-5 d-flex justify-content-end pe-3">
                  <div>
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle los-andes" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Nos produits
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown2">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item text-white front-menu-item los-andes" href="{{ route('products', $category->id) }}">{{ $category->name}}</a></li>
                            @endforeach
                        </ul>
                      </li>

                      <li class="nav-item dropdown los-andes">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          @if(Auth::user()) {{ Auth::user()->name }}  @if(Auth::user()->email_verified_at == null && Auth::user()->is_client == 1) <span class="badge rounded-pill bg-info"> 1</span> @endif @else <i class="fas fa-user"></i> @endif
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown3">

                          @guest()
                            <li>
                              <a class="dropdown-item text-white front-menu-item los-andes" href="{{ route('register') }}">S'inscrire</a>
                            </li>
                            <li>
                              <a class="dropdown-item text-white front-menu-item los-andes" href="{{ route('login') }}">Se connecter</a>
                            </li>
                          @endguest

                          @auth()
                            <li>
                              <a class="dropdown-item text-white front-menu-item los-andes" href="{{ route('user.edit', Auth::user()->id) }}">Mon compte</a>
                            </li>
                            @if(Auth::user()->email_verified_at == null && Auth::user()->is_client == 1)
                            <li>
                              <a class="dropdown-item text-white front-menu-item los-andes" href="{{ route('verification.notice') }}">Vérifier mon compte <span class="badge rounded-pill bg-info"> 1</span></a>
                            </li>
                            @endif

                            <li>
                              <div class="" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item bg-danger text-white front-menu-item los-andes" href={{ route('logout') }}
                                  onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Se déconnecter') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                              </div>
                            </li>
                          @endauth

                        </ul>
                      </li>

                      <li class="nav-item">
                        @if(Auth::user())
                            <a href="{{ route('myfav', Auth::user()->id) }}" class="nav-link" href="#"><i class="fas fa-heart"></i></a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link" href="#"><i class="fas fa-heart"></i></a>
                        @endif
                      </li>

                    </ul>
                  </div>
                </div>
            </div>
          </nav>

          <nav class="navbar navbar-expand-lg navbar-dark fixed-top p-2 mb-5 custom-shadow bg-dark d-block d-lg-none">
            <div class="container-fluid">
              <div class=" ">
                <a href="{{ route('home') }}">
                      <img src="{{ Storage::url($logo->img_name) }}" alt="{{ $logo->name }}" style="height: 60px">
                </a>
              </div>

              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="my-4">
                  <nav-search one_product="{{ route('oneproduct', "#") }}"></nav-search>
                </div>
                <div class="col-5 d-flex pe-3">
                  <div>
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle los-andes" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Nos produits
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown2">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item text-white front-menu-item los-andes" href="{{ route('products', $category->id) }}">{{ $category->name}}</a></li>
                            @endforeach
                        </ul>
                      </li>

                      <div class="d-flex flex-row">
                        <li class="nav-item me-3">
                        @if(Auth::user())
                            <a href="{{ route('myfav', Auth::user()->id) }}" class="nav-link" href="#"><i class="fas fa-heart"></i></a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link" href="#"><i class="fas fa-heart"></i></a>
                        @endif
                        </li>
                        <li class="nav-item dropdown los-andes">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()) {{ Auth::user()->name }}  @if(Auth::user()->email_verified_at == null && Auth::user()->is_client == 1) <span class="badge rounded-pill bg-info"> 1</span> @endif @else <i class="fas fa-user"></i> @endif
                          </a>
                          <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown3">

                            @guest()
                              <li>
                                <a class="dropdown-item text-white front-menu-item los-andes" href="{{ route('register') }}">S'inscrire</a>
                              </li>
                              <li>
                                <a class="dropdown-item text-white front-menu-item los-andes" href="{{ route('login') }}">Se connecter</a>
                              </li>
                            @endguest

                            @auth()
                              <li>
                                <a class="dropdown-item text-white front-menu-item los-andes" href="{{ route('user.edit', Auth::user()->id) }}">Mon compte</a>
                              </li>
                              @if(Auth::user()->email_verified_at == null && Auth::user()->is_client == 1)
                              <li>
                                <a class="dropdown-item text-white front-menu-item los-andes" href="{{ route('verification.notice') }}">Vérifier mon compte <span class="badge rounded-pill bg-info"> 1</span></a>
                              </li>
                              @endif

                              <li>
                                <div class="" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item bg-danger text-white front-menu-item los-andes" href={{ route('logout') }}
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                      {{ __('Se déconnecter') }}
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                  </form>
                                </div>
                              </li>
                            @endauth

                          </ul>
                        </li>
                      </div>
                    </ul>
                  </div>
                </div>
              </div>
              </div>
            </nav>

            @if (Session::has('success_message'))
                <div id="alarmmsg" class="alert alert-success p-3" role="alert" style="margin-top: 4.5em; margin-bottom: 0px">
                    <p class="m-1">{{Session::get('success_message')}}</p>
                </div>
            @endif

            @if (Session::has('error_message'))
                <div class="alert alert-success p-3 m-0" role="alert" style="margin-top: 4.5em; margin-bottom: 0px">
                    <p class="m-1">{{Session::get('error_message')}}</p>
                </div>
            @endif

          <main style="">
            @yield('content')
          </main>

        <footer class="bg-dark">
          <div class="d-flex flex-wrap justify-content-center text-white pb-5">
              <div class="gap-2 resp-m col-lg-3 col-md-4 col-sm-8 col-10 mt-4 ps-4">
                <p class="h4">Contactez nous</p>
                <a href="tel:{{ $contact->phone }}" class="m-0 text-white text-decoration-none">{{ chunk_split($contact->phone, 2, ' ') }}</a>
                <br>
                <a href="mailto:{{ $contact->email }}" class="m-0 text-white text-decoration-none">{{ $contact->email }}</a>
                <p class="m-0">{{ $contact->address }}</p>
                <p class="m-0">{{ $contact->cp }} {{ $contact->city }}</p>
              </div>

              <div class="gap-2 resp-m col-lg-3 col-md-4 col-sm-8 col-10 mt-4">
                <p class="h4">Localisation</p>
                <iframe class="img-thumbnail" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2013.102563297595!2d-1.4626414775437548!3d47.18713473094831!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4805e61847a1d45b%3A0xedcf738fd78fabfb!2sLeclerc%20Meubles!5e0!3m2!1sfr!2sfr!4v1659353095656!5m2!1sfr!2sfr" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
              </div>

              <div class="gap-2 resp-m col-lg-3 col-md-4 col-sm-8 col-10 mt-4">
                  <p class="h4">Retrouvez nous sur les réseaux</p>
                  @foreach ($socials as $rs)
                      <a href="{{$rs->link}}" target="_blank" class="h1 text-white m-1"><?= $rs->img_name ?></a>
                  @endforeach

                  <p class="h4 pt-3">Voir notre catalogue du moment</p>
                  <a href="https://app.eleclercbassegoulaine.fr/landingclients/landing/generic" target="_blank" class="text-white m-1">en cliquant ici</a>
              </div>

              <div class="gap-2 resp-m col-lg-3 col-md-4 col-sm-8 col-10 mt-4 pe-4">
                  <p class="h4">Newsletter</p>
                  <p>Entrez votre adresse e-mail pour être au courant lorsque des nouveautés sont disponibles</p>
                  <x-form :route="route('newsletter')">
                    <div class="d-flex flex-wrap align-items-center col-12">
                      <x-form.newsletterinput class="custom-search col-11" field="email"/>
                      <div class="resp-mt">
                        <x-form.newslettersubmit color="primary" size="col-12" value="S'inscrire" />
                      </div>
                    </div>
                  </x-form>
              </div>
          </div>
        </footer>
    </div>
</body>

</html>
