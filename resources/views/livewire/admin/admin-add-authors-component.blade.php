<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                    <span></span> Ajout d'Auteur
                    {{-- <span></span> Your Cart --}}
                </div>
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
                                        Ajout de nouveau Auteurs
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.authors')}}" class="btn btn-success float-end"> Tous les Auteurs</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">{{Session::get('success') }} </div>
                                @endif
                                <form wire:submit.prevent="AuthorsAdd">
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Nom de l'auteur</label>
                                        <input type="text" name="nom" class="form-control" placeholder="Le nom"  wire:model='nom' />
                                        @error('nom')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="pseudo" class="form-label">Pseudo</label>
                                        <input type="text" name="pseudo" class="form-control" wire:keyup='SlugGenerate' placeholder="Le pseudo" wire:model="pseudo" />
                                        @error('pseudo')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" placeholder="Le slug" wire:model="slug" disabled/>
                                        @error('slug')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="numero" class="form-label">numero</label>
                                        <input type="text" name="numero" class="form-control" placeholder="Le numero" wire:model="numero" />
                                        @error('numero')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Le email" wire:model="email" />
                                        @error('email')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="localisation" class="form-label">Localisation</label>
                                        <input type="localisation" name="localisation" class="form-control" placeholder="Le localisation" wire:model="localisation" />
                                        @error('localisation')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary float-end">Creer</button>
                                </form>
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
</div>
