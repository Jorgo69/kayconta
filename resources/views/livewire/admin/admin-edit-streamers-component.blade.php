<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                    <span></span> Modif de Utilisateur
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
                                        Modif de Utilisateur
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.streamers')}}" class="btn btn-success float-end"> Tous les Utilisateur</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success') }} </div>
                                @endif
                                <form wire:submit.prevent="StreamersEdit">
                                    <div class="mb-3 mt-3">
                                        <label for="pseudo" class="form-label">Pseudo</label>
                                        <input type="text" name="pseudo" class="form-control" placeholder=""  wire:model="pseudo" />
                                        @error('pseudo')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-control" name="role" id="role" wire:model='role'>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                            @endforeach
                                        </select>
                                        
                                        {{-- <select class="form-option" name="role" id="role" wire:model='role'>
                                            <option value="{{'auteur'}}">Auteur</option>
                                            <option value="{{'user'}}"> {{ __('Lecteur') }} </option>
                                            <option value="{{'admin'}}">{{'admin' }}</option>
                                        </select> --}}
                                        @error('role')
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
                                    <button type="submit" class="btn btn-primary float-end">Modifier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
