<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                <span></span> Titre
                <span></span> {{$manga ->title}}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container custom">
            <div class="row">
                <div class="col-lg-9">
                    <div class="single-header mb-50">
                        <h1 class="font-xxl text-brand">{{$manga ->title}}</h1> ||
                        <span></span> Une Oeuvre de {{$manga->user->pseudo}}

                        <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                        </div>
                    </div>
                    <div class="loop-grid pr-30">
                        <div class="row">
                            <div class="col-12">
                                <article class="first-post mb-30 wow fadeIn animated hover-up">
                                    <div class="img-hover-slide position-relative overflow-hidden">
                                    @auth
                                        @if (in_array($manga->id, $favorites))
                                        <a href="#" type="button" role="button" >
                                            <span class="top-right-icon bg-danger"><i class="fi-rs-bookmark"></i></span>
                                        </a>
                                        @else
                                        <a href="#" type="button" role="button" >
                                            <span class="top-right-icon bg-primary"><i class="fi-rs-bookmark"></i></span>
                                        </a>
                                        @endif
                                    @endauth
                                        <div class="post-thumb img-hover-scale">
                                            <a href="blog-details.html">
                                                <img src="{{asset('kayconta-app/public/assets/imgs/mangas')}}/{{$manga->cover_image}}" alt="" width="100%"
                                                    height="100%">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="entry-content">
                                        <div class="entry-meta meta-1 mb-30">
                                            <a class="entry-meta meta-0" href="#">

                                            </a>
                                            <div class="font-sm">
                                                <span>
                                                    <span class="mr-10 text-muted"><i class="fi-rs-eye"></i></span>{{ $nbrViews }}
                                                </span>
                                                <span class="ml-30"><span class="mr-10 text-muted">
                                                    <i class="fi-rs-comment-alt"></i></span>{{ $nbrComments }}
                                                </span>
                                               
                                            </div>
                                        </div>
                                        <h4 class="post-title mb-20">
                                            <p class="post-exerpt text-strong font-medium text-muted mb-30">{!!$manga->description!!}</p>
                                            <div class="mb-20 entry-meta meta-2">
                                                <div class="font-xs ">
                                                </div>
                                                @auth
                                                @if (in_array($manga->id, $favorites))
                                                <a href="#" type="button" role="button"
                                                    wire:click.prevent="RemoveFavorite({{ $manga->id }})">
                                                    <i class="fi-rs-bookmark"></i> Supprimer des favoris
                                                </a>
                                                @else
                                                <a href="#" type="button" role="button"
                                                    wire:click.prevent="AddFavorite({{ $manga->id }})">
                                                    <i class="fi-rs-bookmark"></i> Ajouter aux favoris
                                                </a>
                                                @endif
                                                @endauth
                                            </div>
                                        </h4>
                                    </div>
                                </article>
                            </div>
                        
                            @forelse ( $listes as $liste)
                            <div class="col-md-12 wow fadeIn animated hover-up mb-30">
                                <a href="{{ route('chapter.streaming', ['chapter_id' => $liste->id])}}">
                                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                        <div class="col p-4 d-flex flex-column">
                                            <strong class="d-inline-block mb-2 text-primary"> #{{ $liste ->chapter_number }}</strong>
                                            <span>{{ substr($liste ->title, 0, 30) }}</span>
                                            {{-- <h3 class="mb-0">Featured post</h3> --}}
                                            <div class="mb-1 text-muted"><i class="fi-rs-clock"></i> {{ ($liste ->created_at)->diffForHumans()
                                                }}</div>
                                            <div class="col-md-2">
                                                <a type="button" href="{{ route('chapter.streaming', ['chapter_id'=> $liste->id])}}"
                                                    class="btn btn-sm text-light float-right ">Lire</a>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('chapter.streaming', ['chapter_id' => $liste->id])}}">
                                                <img src="{{asset('kayconta-app/public/assets/imgs/chapters/covers')}}/{{$liste->chapter_cover}}"
                                                    alt="{{ substr($liste ->title, 0 ,11)}}" width="100" height="100%">
                                                {{-- <img src="{{ asset('kayconta-app/public/assets/imgs/chapters')}}/{{$chapter->manga->cover_image}}"
                                                    alt="product image"> --}}
                        
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @empty
                            <p class="text-center alert alert-primary">
                                Aucun Chapitre Pour le Moment
                            </p>
                            @endforelse
                        
                        </div>
                    </div>
                    <!--post-grid-->
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            {{-- <ul class="pagination justify-content-start">
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">16</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-angle-double-small-right"></i></a></li>
                            </ul> --}}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-area">
                        
                        <!--Widget categories-->
                        <div class="sidebar-widget widget_categories mb-40">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title">Les Genres</h5>
                            </div>
                            <div class="post-block-list post-module-1 post-module-5">
                                <ul>
                                    @forelse ($genres as $genre)
                                        <li class="cat-item cat-item-2"><a href="#">{{ $genre ->name}}</a></li>
                                    @empty
                                        <li class="cat-item cat-item-2"><a href="#">Aucun Genre</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <!--Widget latest posts style 1-->
                        <div class="sidebar-widget widget_alitheme_lastpost mb-20">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title">{{ __('Du même auteur')}}</h5>
                            </div>
                            <div class="row">
                                @forelse ($liers as $lier)
                                <div class="col-md-6 col-sm-6 sm-grid-content mb-30">
                                    <div class="post-thumb d-flex border-radius-5 img-hover-scale mb-15">
                                        <a href="{{ route('manga.liste', ['slug' => $lier->slug])}}">
                                            <img src="{{ asset('kayconta-app/public/assets/imgs/mangas') }}/{{$lier->cover_image }}" alt="">
                                        </a>
                                    </div>
                                    <div class="post-content media-body">
                                        <a href="{{ route('manga.liste', ['slug' => $lier->slug])}}">
                                            <h6 class="post-title text-danger mb-10 text-limit-2-row">{{$lier->title}}</h6>
                                            <div class="entry-meta meta-13 font-xxs color-grey d-inline">
                                                <span class="post-on mr-10">{{$lier->created_at}}</span>
                                                {{-- <span class="hit-count has-dot mt-3">126k Views</span> --}}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @empty
                                    @foreach ($liers as $lier)
                                        Le seul Ouvre de {{$lier->user->pseudo}}
                                    @endforeach
                                @endforelse
                            </div>
                        </div>
                        <!--Widget ads-->
                        <div class="banner-img wow fadeIn mb-45 animated d-lg-block d-none animated">
                            <img src="{{asset('kayconta-app/public/assets/imgs/banner/banner-11.png') }}" alt="">
                            <div class="banner-text">
                                <span>Women Zone</span>
                                <h4>Save 17% on <br>Office Dress</h4>
                                <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                        <!--Widget Tags-->
                        <div class="sidebar-widget widget_tags mb-50">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title">Mangas Populaire </h5>
                            </div>
                            <div class="tagcloud">
                                <a class="tag-cloud-link" href="#">Manga</a>
                                <a class="tag-cloud-link" href="#">Comics</a>
                                <a class="tag-cloud-link" href="#">Dessins</a>
                                <a class="tag-cloud-link" href="#">Bandes</a>
                                <a class="tag-cloud-link" href="#">Crayons</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        @push('title')
            <title>{{ $pageTitle }}</title>
        @endpush
</main>