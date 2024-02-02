<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                    <span></span> Modification
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
                                        Modification du Genre
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.genres')}}" class="btn btn-success float-end"> Tous les Genres</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">{{Session::get('success') }} </div>
                                @endif
                                <form wire:submit.prevent="EditGenre">
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Le Genre</label>
                                        <input type="text" name="name" class="form-control" placeholder="Le Genre" wire:model='name' />
                                        @error('name')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger">{!!$message!!}</p>
                                        @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success float-end">Modifier</button>
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
