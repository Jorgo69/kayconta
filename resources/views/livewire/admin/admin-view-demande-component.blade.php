<div class="row">
    @foreach ($demandes as $demande)

    <div class="comments-area">
        <div class="row">
            <div class="col-lg-8">
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb text-center">
                                    <img src="{{asset('kayconta-app/public/assets/imgs/page/avatar-6.jpg')}}" alt="">
                                    <h6><a href="{{ route('admin.view.details', ['id' => $demande->id])}}">{{ __('Pseudo') }}</a></h6>
                                    <h6 class="mb-30">{{$demande->objet}}</h6>
                                    {{-- Pour afficher la date en le formattant a la Carbon tout en important Carbon avec [d ==> Jour]; [F ==> Mois en toute lettre]; [Y ==> Annee en 4 chiffre] --}}
                                    <p class="font-xxs mzb-5">Depuis {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d F Y') }}</p>
                                    {{-- <p class="font-xxs">Depuis {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('F Y') }}</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
                    

    @endforeach
</div>