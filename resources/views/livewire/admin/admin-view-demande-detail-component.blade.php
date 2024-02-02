<div>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                    <span></span> Validation
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Verification
                                    </div>
                                    <div class="col-md-6">
                                        <a href="" class="btn btn-small float-end"> La Demande en Detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">{{Session::get('success') }} </div>
                                @endif
                                <form wire:submit.prevent="">
                                    <div class="mb-3 mt-3 ">
                                        <label for="objet">Objet</label>
                                        <input type="text" placeholder="{{ $demande->objet }}" @readonly(true) class="form-control">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <p>
                                            {!! $demande->about !!}
                                        </p>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label">Image</label>

                                        <div id="carouselExampleControls" class="carousel slide" style="center" data-ride="carousel">
                                            @foreach ( json_decode($demande->planche) as $key => $planches )
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{asset('kayconta-app/public/assets/imgs/demandes')}}/{{$planches}}" width="100%" alt="First slide">
                                            </div>
                                        </div>
                                        @endforeach
                                            {{-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                              <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                              <span class="sr-only">Next</span>
                                            </a> --}}
                                          </div>

                                    </div>
                                        
                                    
                                    <button type="submit" class="btn btn-small btn-primary float-end" wire:click.prevent='Valider'>Valider</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @push('title')
        <title>
            Detail du Profil {{ config('app.name')}}
        </title>
    @endpush
</div>
