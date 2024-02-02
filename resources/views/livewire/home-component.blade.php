<div class="">
    <main class="main">
        <section class="">
            <div class="container">
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col wow">
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </section>

        <section class="home-slider position-relative">
            
            @foreach ($featureds as $featured)
                @php
                    $i = rand(1, 6);
                    $i = ($i % 3) + 1; // Pour que $i soit toujours entre 1 et 3
                @endphp
                <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                    <div class="single-hero-slider single-animation-wrap">
                        <div class="container">
                            <div class="row align-items-center slider-animated-1">
                                <div class="col-lg-5 col-md-6">
                                    <div class="hero-slider-content-2">
                                        <h4 class="animated">Vedettes</h4>
                                        <h2 class="animated fw-900">{{ $featured->title }}</h2>
                                        <h3 class="animated fw-900 text-brand">De {{ $featured->user->pseudo }}
                                        </h3>
                                        <a class="animated btn btn-brush btn-brush-{{ $i }}"
                                            href="{{ route('manga.liste', ['slug' => $featured->slug]) }}"> Voir Plus
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="single-slider-img single-slider-img-1">
                                        <a href="{{ route('manga.liste', ['slug' => $featured->slug]) }}"> Voir Plus
                                        <img class="animated slider-1-1"
                                            src="{{ asset('kayconta-app/public/assets/imgs/mangas') }}/{{ $featured->cover_image }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </section>



        <section class="product-tabs section-padding position-relative   fadeIn animated pt-5">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab"
                                data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one"
                                aria-selected="true">Chapitres</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two"
                                type="button" role="tab" aria-controls="tab-two"
                                aria-selected="false">Mangas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three"
                                type="button" role="tab" aria-controls="tab-three"
                                aria-selected="false">Populaire</button>
                        </li>
                    </ul>

                </div>
                <!--End nav-tabs-->
                <div class="tab-content   fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            <div class="container">
                                @php
                                    $i = rand(1, 6);
                                @endphp
                                <div class="row">
                                    @forelse ($chapters as $chapter)
                                        {{-- @php
                                $i = ($i % 6) + 1; // Pour que $i soit toujours entre 1 et 6
                                @endphp --}}
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4">
                                            <a href="{{ route('manga.chapters.liste', ['slug' => $chapter->slug]) }}">
                                                <div
                                                    class="banner-features text-center fadeIn animated hover-up animated animated">
                                                    <img class="default-img"
                                                        src="{{ asset('kayconta-app/public/assets/imgs/mangas') }}/{{ $chapter->manga->cover_image }}"
                                                        alt="{{ $chapter->title }}" height="170">
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h4><a
                                                            href="{{ route('manga.chapters.liste', ['slug' => $chapter->slug]) }}">#{{ $chapter->chapter_number }}</a>
                                                    </h4>
                                                    <div class="product-price">
                                                        <span>{{ $chapter->manga->title }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="alert alert-info text-center">
                                            Aucun Chapitre pour l'instant
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!--End product-grid-4-->
                        </div>
                    </div>
                    <!--En tab one (Featured)-->
                    <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                        <div class="row product-grid-4">
                            <div class="container">
                                <div class="row">
                                    @forelse ($mangas as $manga)
                                        @php
                                            $i = ($i % 6) + 1; // Pour que $i soit toujours entre 1 et 6
                                        @endphp
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4">
                                            <a href="{{ route('manga.liste', ['slug' => $manga->slug]) }}">
                                                <div
                                                    class="banner-features text-center fadeIn animated hover-up animated animated">
                                                    <a href="{{ route('manga.liste', ['slug' => $manga->slug]) }}">
                                                        <img class="default-img"
                                                            src="{{ asset('kayconta-app/public/assets/imgs/mangas') }}/{{ $manga->cover_image }}"
                                                            alt="{{ $manga->title }}" height="170">
                                                    </a>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h4><a
                                                            href="{{ route('manga.liste', ['slug' => $manga->slug]) }}">{{ $manga->title }}</a>
                                                    </h4>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="alert alert-info text-center">
                                            Aucun Manga pour l'instant
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <!--End product-grid-4-->
                    </div>

                    {{-- Tab Three  --}}
                    <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                        <div class="row product-grid-4">
                            <div class="container">
                                <div class="row">
                                    
                                    @forelse ($populars as $popular)
                                            @php
                                                $manga = \App\Models\Manga::find($popular->manga_id);
                                            @endphp

                                            @if ($manga)
                                                <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4">
                                                    <a href="{{ route('manga.liste', ['slug' => $manga->slug]) }}">
                                                        <div class="banner-features text-center fadeIn animated hover-up animated animated">
                                                            <a href="{{ route('manga.liste', ['slug' => $manga->slug]) }}">
                                                                <img class="default-img"
                                                                    src="{{ asset('kayconta-app/public/assets/imgs/mangas') }}/{{ $manga->cover_image }}"
                                                                    alt="{{ $manga->title }}" height="170">
                                                            </a>
                                                        </div>
                                                        <div class="product-content-wrap">
                                                            <h4><a
                                                                    href="{{ route('manga.liste', ['slug' => $manga->slug]) }}">{{ $manga->title }}</a>
                                                            </h4>
                                                            @php
                                                                $place = 0;
                                                                $place++; // Incrémenter le compteur
                                                            @endphp
                                                            <p>Rang: {{ $place }}, Vues: {{ $popular->total_views }}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                        
                                                
                                            @endif
                                        
                                        @empty
                                        <div class="alert alert-info text-center">
                                            Aucun Manga pour l'instant
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    {{-- End Tab Three --}}
                </div>
                <!--End tab-content-->
            </div>
        </section>
        <section class="banner-2 section-padding pb-0">
            <div class="container">
                <div class="banner-img banner-big   fadeIn animated f-none">
                    <img src="{{ asset('kayconta-app/public/assets/imgs/banner/banner-4.png') }}" alt="">
                    <div class="banner-text d-md-block d-none">
                        <h4 class="mb-15 mt-40 text-brand">Publicite</h4>
                        <h1 class="fw-600 mb-20">Autorisation <br>de mettre de Pub ici</h1>
                        <a href="#" class="btn disabled">Lire Plus <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <h3 class="section-title mb-20   fadeIn animated"><span>Vedette</span> Partenaire</h3>
            <div class="carausel-6-columns-cover position-relative   fadeIn animated">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows">
                </div>
                <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('kayconta-app/public/assets/imgs/banner/brand-1.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('kayconta-app/public/assets/imgs/banner/brand-2.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('kayconta-app/public/assets/imgs/banner/brand-3.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('kayconta-app/public/assets/imgs/banner/brand-4.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('kayconta-app/public/assets/imgs/banner/brand-5.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('kayconta-app/public/assets/imgs/banner/brand-6.png') }}"
                            alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('kayconta-app/public/assets/imgs/banner/brand-3.png') }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>


        @push('title')
            <title>{{ $pageTitle }}</title>
        @endpush
    </main>
</div>
