<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8">
    @stack('title')
<meta charset="utf8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="">
<meta property="og:type" content="">
<meta property="og:url" content="">
<meta property="og:image" content="">
<link rel="icon" href="{{asset('kayconta-app/public/assets/imgs/theme/favicon.ico')}}" type="image/x-icon">
<link rel="stylesheet" href="{{asset('kayconta-app/public/assets/css/main.css') }}">
{{-- <link rel="stylesheet" href="{{asset('kayconta-app/public/assets/css/custom.css') }}"> --}}
@livewireStyles
</head>

<body>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            
                            {{-- If Auth --}}
                            @auth
                            <ul>                                
                                <li><i class="fi-rs-user"></i> {{ Auth::user()->pseudo}}  / 
                                    <form action="{{ route('logout')}}" method="post">
                                        @csrf
                                        <a href="{{ route('logout')}}"  onclick="event.preventDefault();
                                                                        this.closest('form').submit();
                                        " >Deconnexion</a>
                                    </form>
                                </li>
                            </ul>
                            @else
                            <ul>                                
                                <li><i class="fi-rs-key"></i><a href="{{ route('login')}}">Connexion </a>  / <a href="{{ route('register')}}">Inscription</a></li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{ route('home.index' )}}"><img src="{{asset('kayconta-app/public/assets/imgs/logo/logo.png') }}" alt="logo"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{ route('home.index' )}}"><img src="{{asset('kayconta-app/public/assets/imgs/logo/logo.png') }}" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav class="d-flex">
                                <ul>
                                    <li><a class="{{ request()->routeIs('home.index') ? 'active' : '' }}" href="{{ route('home.index') }}">Accueil </a></li>
                                    {{-- <li><a href="#">Les Auteurs </a></li> --}}
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                    <li><a href="{{ route('author.dashboard')}}">Dashboard<i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                                            <li><a href="{{ route('admin.streamers')}}">Lecteurs</a></li>
                                            <li><a href="{{ route('admin.genres')}}">Genres</a></li>
                                            <li><a href="{{ route('admin.mangas')}}">Mangas</a></li>
                                            <li><a href="{{ route('admin.chapters')}}">Chapitres</a></li>
                                            <li><a href="{{ route('user.favorites')}}">Mes Favoris</a></li>
                                            <li>
                                                <form action="{{ route('logout')}}" method="post">
                                        @csrf
                                        <a href="{{ route('logout')}}"  onclick="event.preventDefault();
                                                                        this.closest('form').submit();
                                        " >Deconnexion</a>
                                    </form>    
                                            </li>
                                        </ul>
                                    </li>
                                    @elseif (Auth::check() && Auth::user()->role === 'author')
                                    <li><a href="{{ route('author.dashboard')}}">Mon Dashboard<i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('user.favorites')}}">Mes Favoris</a></li>
                                            <li>
                                                <form action="{{ route('logout')}}" method="post">
                                        @csrf
                                        <a href="{{ route('logout')}}"  onclick="event.preventDefault();
                                                                        this.closest('form').submit();
                                        " >Deconnexion</a>
                                    </form>    
                                            </li>
                                        </ul>
                                    </li>
                                    @elseif (Auth::check() && Auth::user()->role === 'user')
                                    <li><a href="{{ route('user.dashboard')}}">Mon Dashboard<i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('user.favorites')}}">Mes Favoris</a></li>
                                            <li>
                                                <form action="{{ route('logout')}}" method="post">
                                        @csrf
                                        <a href="{{ route('logout')}}"  onclick="event.preventDefault();
                                                                        this.closest('form').submit();
                                        " >Deconnexion</a>
                                    </form>    
                                            </li>
                                        </ul>
                                    </li>
                                    @endif
                                    <li><a href="{{ route('about.index')}}">A propos</a></li>
                                    
                                </ul>
                                <ul class="float-right">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li class="float-right">
                                        <div class="">
                                            <div class="search-style-2">
                                                <form action="#">                                
                                                    <input type="search" placeholder="Cherchez un manga...">
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ route('home.index' )}}"><img src="{{asset('kayconta-app/public/assets/imgs/logo/logo.png') }}" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="search" placeholder="Ecrivez ...">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <div class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active-1" href="{{ route('home.index')}}">
                             Accueil
                        </a>
                    </div>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            {{-- <li class="menu-item-has-children"><span class="menu-expand"></span><a href="shop.html">Les Auteurs</a></li> --}}
                            @if(Auth::check() && Auth::user()->role === 'admin')
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Tableau de Board</a>
                                    <ul class="dropdown">
                                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('author.dashboard')}}">Tableau de Board</a></li>
                                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Mon Compte</a></li>
                                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('admin.streamers')}}">Lecteurs</a></li>
                                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('admin.genres')}}">Genres</a></li>
                                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('admin.mangas')}}">Manga</a></li>
                                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('admin.chapters')}}">Chapitres</a></li>
                                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('user.favorites')}}">Favoris</a></li>
                                    </ul>
                                    @endif
                                    {{-- @elseif (Auth::check() && Auth::user()->role === 'author')
                                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('user.favorites')}}">Auteur</a></li>
                                    </ul>
                                    @endif --}}
                            </li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('about.index')}}">A propos</a></li>
                            @auth
                            <li class="menu-item-has-children"><span class="menu-expand"></span>
                                <form action="{{ route('logout')}}" method="post">
                                    @csrf
                                    <a href="{{ route('logout')}}"  onclick="event.preventDefault();
                                                                    this.closest('form').submit();
                                    " >Deconnexion</a>
                                </form>    
                            </li>
                            @endauth
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    @guest
                    <div class="single-mobile-header-info mt-30">
                        <a href="contact.html"> Benin, Cotonou </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="{{ route('login')}}">Connexion </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="{{ route('register')}}">Inscription</a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#">(+229) 692 382 65 </a>
                    </div>
                    @endguest
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">Follow Us</h5>
                    <a href="#"><img src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-facebook.svg') }}" alt=""></a>
                    <a href="#"><img src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a>
                    <a href="#"><img src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a>
                    <a href="#"><img src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a>
                    <a href="#"><img src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-youtube.svg') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>

    {{ $slot }}

    <footer class="main">
        <section class="newsletter p-30 text-white wow fadeIn animated">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-md-3 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col flex-horizontal-center">
                                <img class="icon-email" src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-email.svg') }}" alt="">
                                <h4 class="font-size-20 mb-0 ml-3">S'inscrire au Newsletter</h4>
                            </div>
                            <div class="col my-4 my-md-0 des">
                                <h5 class="font-size-15 ml-4 mb-0">...et recevez <strong>vos première newletter dès maintenant.</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- Subscribe Form -->
                        <form class="form-subcriber d-flex wow fadeIn animated">
                            <input type="email" class="form-control bg-white font-small" placeholder="Votre Mail">
                            <button class="btn bg-dark text-white" type="submit">S'inscrire</button>
                        </form>
                        <!-- End Subscribe Form -->
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="{{ route('home.index' )}}"><img src="{{asset('kayconta-app/public/assets/imgs/logo/logo.png') }}" alt="logo"></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                            <p class="wow fadeIn animated">
                                <strong>Address: </strong>Bénin, Cotonou
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Phone: </strong>+229 69 23 82 65
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Email: </strong>contact@kayconta.com
                            </p>
                            @auth
                            <form action="{{ route('logout')}}" method="post">
                                @csrf
                                <a class="btn btn-danger" href="{{ route('logout')}}"  onclick="event.preventDefault();
                                                                this.closest('form').submit();
                                " >Deconnexion</a>
                            </form>
                            @endauth
                            {{-- <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h5>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a href="#"><img src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-facebook.svg') }}" alt=""></a>
                                <a href="#"><img src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a>
                                <a href="#"><img src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a>
                                <a href="#"><img src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a>
                                <a href="#"><img src="{{asset('kayconta-app/public/assets/imgs/theme/icons/icon-youtube.svg') }}" alt=""></a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">A propos</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li><a href="{{ route('about.index') }}">A propos</a></li>
                            <li><a href="{{ route('about.index') }}#politique">Politique de Confidentialité</a></li>
                            <li><a href="#">Termes & Conditions</a></li>
                            <li><a href="#">Contactez Nous</a></li>
                        </ul>
                    </div>
                    @auth
                    <div class="col-lg-2  col-md-3">
                        <h5 class="widget-title wow fadeIn animated">Mon Compte</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="my-account.html">Profile</a></li>
                            <li><a href="#">Favorie</a></li>
                        </ul>
                    </div>
                    @endauth
                    <div class="col-lg-4 mob-center">
                        <h5 class="widget-title wow fadeIn animated">Install App</h5>
                        <div class="row">
                            <div class="col-md-8 col-lg-12">
                                <p class="wow fadeIn animated">From App Store or Google Play</p>
                                <div class="download-app wow fadeIn animated mob-app">
                                    <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active" src="{{asset('kayconta-app/public/assets/imgs/theme/app-store.jpg') }}" alt=""></a>
                                    <a href="#" class="hover-up"><img src="{{asset('kayconta-app/public/assets/imgs/theme/google-play.jpg') }}" alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0 d-flex">
                                <p class="mb-20 wow fadeIn animated">Coming Soon</p> &nbsp; &nbsp; &nbsp;
                                <p class="mb-20 wow fadeIn animated">Bientot disponible</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated mob-center">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">
                        <a href="privacy-policy.html">Privacy Policy</a> | <a href="terms-conditions.html">Terms & Conditions</a>
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        {{-- © <strong class="text-brand">SurfsideMedia</strong> All rights reserved --}}
                    </p>
                </div>
            </div>
        </div>
    </footer>
    @livewireScripts
    @stack('deleteScript')
    <!-- Vendor JS-->
{{-- <script src="{{asset('kayconta-app/public/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script> --}}
<script src="{{asset('kayconta-app/public/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
{{-- <script src="{{asset('kayconta-app/public/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script> --}}
<script src="{{asset('kayconta-app/public/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('kayconta-app/public/assets/js/plugins/slick.js') }}"></script>
{{-- <script src="{{asset('kayconta-app/public/assets/js/plugins/jquery.syotimer.min.js') }}"></script> --}}
<script src="{{asset('kayconta-app/public/assets/js/plugins/wow.js') }}"></script>
{{-- <script src="{{asset('kayconta-app/public/assets/js/plugins/jquery-ui.js') }}"></script> --}}
{{-- <script src="{{asset('kayconta-app/public/assets/js/plugins/perfect-scrollbar.js') }}"></script> --}}
<script src="{{asset('kayconta-app/public/assets/js/plugins/magnific-popup.js') }}"></script>
<script src="{{asset('kayconta-app/public/assets/js/plugins/select2.min.js') }}"></script>
{{-- <script src="{{asset('kayconta-app/public/assets/js/plugins/waypoints.js') }}"></script> --}}
<script src="{{asset('kayconta-app/public/assets/js/plugins/counterup.js') }}"></script>
{{-- <script src="{{asset('kayconta-app/public/assets/js/plugins/jquery.countdown.min.js') }}"></script> --}}
<script src="{{asset('kayconta-app/public/assets/js/plugins/images-loaded.js') }}"></script>
{{-- <script src="{{asset('kayconta-app/public/assets/js/plugins/isotope.js') }}"></script> --}}
<script src="{{asset('kayconta-app/public/assets/js/plugins/scrollup.js') }}"></script>
{{-- <script src="{{asset('kayconta-app/public/assets/js/plugins/jquery.vticker-min.js') }}"></script> --}}
{{-- <script src="{{asset('kayconta-app/public/assets/js/plugins/jquery.theia.sticky.js') }}"></script> --}}
{{-- <script src="{{asset('kayconta-app/public/assets/js/plugins/jquery.elevatezoom.js') }}"></script> --}}
<!-- Template  JS -->
<script src="{{asset('kayconta-app/public/assets/js/main.js?v=3.3') }}"></script>
<script src="{{asset('kayconta-app/public/assets/js/shop.js?v=3.3') }}"></script>
</body>

</html>