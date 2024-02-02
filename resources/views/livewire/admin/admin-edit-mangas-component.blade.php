<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                    <span></span> Modification
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
                                        Manga 
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.mangas')}}" class="btn btn-success float-end"> Tous les Mangas</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">{{Session::get('success') }} </div>
                                @endif
                                <form wire:submit.prevent="MangasEdit">
                                    @csrf
                                    <div class="mb-3 mt-3">
                                        <label for="title" class="form-label"> Le Titre</label>
                                        <input type="text" name="title" class="form-control" placeholder="Le title" wire:model='title' />
                                        @error('title')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="cover_image" class="form-control" wire:model="new_cover_image"/>

                                        @if ($new_cover_image)
                                        <img src="{{$new_cover_image->temporaryUrl()}}" width="30"/>
                                        @else
                                        <img src="{{asset('kayconta-app/public/assets/imgs/mangas')}}/{{$cover_image}}" width="30" alt="">
                                        @endif
                                        @error('new_cover_image')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="description" class="form-label">La Description</label>
                                        <textarea name="description" id="description" class="form-control" wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="vedette" class="form-label"> Vedette</label>
                                        <select class="form-control" name="featured" id="vedette" wire:model="featured">
                                            <option value="">{{__('Mettre en avant ?')}}</option>
                                            @forelse ($featureds as $featured)
                                            <option value="{{ $featured}}">{{$featured}}</option>
                                            @empty
                                            <option value="">Aucun Auteur pour le moment</option>
                                            @endforelse
                                        </select>
                                        @error('featured')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="genre">Genre :</label>
                                        @forelse ($genres  as $genre)
                                        <div class="">
                                          <input class="form-check-input" name="genre[]" wire:model="selectedGenres" type="checkbox" value="{{ $genre->id}}" id="{{$genre->id}}">
                                          <label class="form-check-label" for="{{$genre->id}}">{{$genre->name}}</label>
                                          @empty
                                            <option value="">Aucun Genre pour le moment</option>
                                            @endforelse
                                        </div>

                                        @error('selectedGenres')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                      </div>
                                    
                                    <button type="submit" class="btn btn-primary float-end">Modifier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @push('title')
            <title>{{$pageTitle}}</title>
        @endpush
    </main>
</div>
