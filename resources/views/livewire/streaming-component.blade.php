    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index') }}" rel="nofollow">Accueil</a>
                    <span></span> Titre
                    <span></span> {{ $chapter->title }}
                    {{-- <span></span> {{substr($chapter ->title, 0, 5)}} || titre du chap --}}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50" style="background: transparent;" oncontextmenu="return false;"
            onselectstart="return false;" ondragstart="return false;">
            <div class="container custom" style="background: transparent;" oncontextmenu="return false;"
                onselectstart="return false;" ondragstart="return false;">
                <div class="row" style="background: transparent;" oncontextmenu="return false;"
                    onselectstart="return false;" ondragstart="return false;">
                    {{-- <img src="{{ asset('kayconta-app/public/assets/imgs/chapters') }}/{{ $chapter->content }}" alt=""
                        oncontextmenu="return false;"
                        style="pointer-events: none;"> --}}
                    {{-- @foreach (json_decode($chapter->content) as $key => $contentImage)
                        <img src="{{ asset('kayconta-app/public/assets/imgs/chapters') }}/{{ $contentImage }}" alt=""
                        oncontextmenu="return false;" onselectstart="return false;" ondragstart="return false;">
                        @endforeach --}}

                        <div class="d-flex justify-content-between mb-3">
                            {{-- Bouton précédent --}}
                        
                            <button class="btn btn-primar" wire:click="previousImage">Précédent</button>
                        
                            {{-- Bouton suivant --}}
                        
                            <button class="btn btn-primary" wire:click="nextImage">Suivant</button>
                        
                        </div>

                    {{-- Affiche l'image actuelle --}}

                    <img src="{{ asset('kayconta-app/public/assets/imgs/chapters') }}/{{ $images[$currentImageIndex] }}" alt=""
                        oncontextmenu="return false;" onselectstart="return false;" ondragstart="return false;">

                    <div class="d-flex justify-content-between mt-3">
                        {{-- Bouton précédent --}}
                    
                        <button class="btn btn-primar" wire:click="previousImage">Précédent</button>
                    
                        {{-- Bouton suivant --}}
                    
                        <button class="btn btn-primary" wire:click="nextImage">Suivant</button>
                    
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-50 mb-50">
            <div class="container custom">
                <div class="row">
                    <a href="{{ route('chapter.comment', ['chapter_id' => $this->chapter_id]) }}"
                        class="btn btn-info md-3 float-end">Laissez un Commentaire</a>
                </div>
            </div>
            </div>
        </section>
        @push('title')
            <title>{{ $pageTitle }}</title>
        @endpush
    </main>

    {{-- <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('action-timer-started', function (time) {
                setTimeout(function () {
                    Livewire.emit('enregistrerAction');
                }, time);
            });
        });
    </script> --}}

<script>
    document.addEventListener('livewire:load', function () {
        setTimeout(function () {
            Livewire.emit('action-timer-started');
        }, 10000);
    });
</script>

