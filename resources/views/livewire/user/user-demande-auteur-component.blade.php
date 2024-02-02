<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Comment devenir Auteur </h5>
        </div>
        <div class="card-body contact-from-area">
            <p>Pour devenir auteur sur la plateforme {{ config('app.name') }} il vous suffit juste de remplir ces
                formulaire vous demandans de nous faire part de quelques une de vos oeuvres <br>
                Ainsi notre equipe examineras avec soin votre demande et vous donnera une suite
                .</p>
            <div class="row">
                <div class="col-lg-8">
                    <form class="contact-form-style mt-30 mb-50" wire:submit.prevent='MakeRequest'>
                        @csrf
                        <div class="input-style mb-20">
                            <label>Objet</label>
                            <input type="text" class="form-control" wire:model="objet">

                            @error('objet')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-style mb-20">
                            <label>Développez</label>
                            <textarea name="" id="" cols="30" rows="10" class="square" wire:model="about"></textarea>

                            @error('about')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @foreach ($choix as $choi)
                            <div class="form-check d-flex ">
                                <input class="form-check-input" wire:model="contrat" type="radio"
                                    value="{{ $choi }}">
                                <label class="form-check-label mx-2"
                                    for="{{ $choi }}">{{ ucfirst($choi) }}</label>
                            </div>
                        @endforeach
                        @error('contrat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="input-style mb-20">
                            <label>Un One Shot</label>
                            <input type="file" name="planches" class="form-control p-2" wire:model="planches"
                                multiple />
                            @if ($planches)
                                @foreach ($planches as $key => $content)
                                    <img src="{{ $content->temporaryUrl() }}" width="120" />
                                @endforeach
                            @endif
                            {{-- <img src="{{asset('kayconta-app/public/assets/imgs/demandes')}}/{{$planches}}" alt="" width="120"> --}}
                            @error('planches')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="submit submit-auto-width" type="submit">Soumettez</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
