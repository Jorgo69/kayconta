<div class="">
    
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                    <span></span> Commentaire
                    <span></span>
                    {{-- <span></span> {{substr($chapter ->title, 0, 5)}} || titre du chap --}}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            @auth
            <div class="container custom mb-5">
                <div class="row">
                    <form wire:submit.prevent='AddComment'>
                        @error('content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <textarea name="" id="" cols="30" rows="10" wire:model='content'></textarea>
                        <button class="btn btn-info md-3 float-end">Commenter</button>
                    </form>
                </div>
            </div>
            @endauth
            
            <div class="container custom">
                <div class="row">
                    @if (Session::has('danger'))
                        <div class="alert alert-danger wow fadeIn animated hover-up mb-30 text-center alert-dismissible" role="alert"> 
                            {{ Session::get('danger') }}
                            <a href="" class="btn-close"></a>
                        </div>
                    @endif
                    @guest
                    <div class="alert alert-danger wow fadeIn animated hover-up mb-30 text-center alert-dismissible" role="alert"> 
                        Connectez vous pouvoir laissé(e) un commentaire
                    </div>
                    @endguest
                </div>

                
                <div class="comments-area">
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="mb-30">Comments</h4>
                            @forelse ($comments as $comment)
                            <div class="comment-list">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb text-center">
                                            <img src="{{asset('kayconta-app/public/assets/imgs/page/avatar-6.jpg')}}" alt="">
                                            <h6><a href="#">{{ $comment->user->pseudo}}</a></h6>
                                             {{-- Pour afficher la date en le formattant a la Carbon tout en important Carbon avec [d ==> Jour]; [F ==> Mois en toute lettre]; [Y ==> Annee en 4 chiffre] --}}
                                            {{-- <p class="font-xxs">Depuis {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d F Y') }}</p> --}}
                                            <p class="font-xxs">Depuis {{ \Carbon\Carbon::parse($comment->user->created_at)->format('F Y') }}</p>
                                        </div>
                                        <div class="desc">
                                            {{-- <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div> --}}
                                            <p>{{$comment ->content}}</p>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-xs mr-30">{{ $comment->created_at->diffForHumans()}} </p>
                                                    @if ($comment->user_id === Auth::id())
                                                    <a href="#" role="button" wire:click.prevent='deleteComment({{ $comment->id}})' class="text-brand btn-reply"> Supprimer <i class="fi-rs-arrow-right"></i> </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        
</main>




    <script>
        window.addEventListener('refresh-page', event => {
            window.location.reload(false); 
            })
    </script>

    {{-- le titre de la page du composant --}}
    @push('title')
    <title>{{ $pageTitle }}</title>
    @endpush


</div>