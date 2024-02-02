<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                    <span></span> Les Utilisateurs
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
                                        Les Categories
                                    </div>
                                    <div class="col-md-6">
                                        <a href="" class="btn btn-small float-end"> Ajout de nouveau Utilisateur </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center" role="alert">
                                        {{ Session::get('success')}}
                                    </div>
                                @endif
                                @if (Session::has('danger'))
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ Session::get('danger')}}
                                </div>
                            @endif
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pseudo ?</th>
                                            <th>Email </th>
                                            <th>Role </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                            $i = ($users->currentPage() -1) * ($users->perPage());
                                        @endphp
                                        @forelse ($users as $user)
                                        <tr>
                                            <td>{{++ $i}}</td>
                                            <td> {{$user->pseudo}}</td>
                                            <td> {{$user->email}}</td>
                                            <td> {{$user->role}}</td>
                                            {{-- <td> Action</td> --}}
                                                
                                            <td>
                                                <a type="button" href="{{ route('admin.streamers.edit', ['user_id' => $user->id])}}" class="text-info">Modifier</a>
                                                <a href="#" onclick="deleteConfirmation({{$user->id}})" class="text-danger mx-2">Supprimer</a>
                                            </td>
                                        </tr>
                                        @empty
                                            Aucune Categories
                                        @endforelse
                                    </tbody>
                                </table>
                                {{$users->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Voudrez vous vraiment y continuer?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Annuler </button>
                        <button type="button" class="btn btn-danger" onclick="deleteUser()">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('deleteScript')
    <script>
        function deleteConfirmation(id)
        {
            @this.set('user_id', id);
            $('#deleteConfirmation').modal('show');
        }
        function deleteUser()
        {
            @this.call('deleteUser');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush