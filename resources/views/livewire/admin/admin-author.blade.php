<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                    <span></span> Les Auteurs
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
                                        Les Auteurs
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.add.authors')}}" class="btn btn-success float-end"> Ajout de nouveau Auteurs </a>
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
                                            <th>Nom </th>
                                            <th>Pseudo ?</th>
                                            <th>Numero </th>
                                            <th>Email </th>
                                            <th>Localisation </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                            $i = ($authors->currentPage() -1) * ($authors->perPage());
                                        @endphp
                                        @forelse ($authors as $author)
                                        <tr>
                                            <td>{{++ $i}}</td>
                                            <td> {{$author->nom_complet}}</td>
                                            <td> {{$author->pseudo}}</td>
                                            <td> {{$author->numero}}</td>
                                            <td> {{$author->email}}</td>
                                            <td> {{$author->localisation}}</td>
                                            {{-- <td> Action</td> --}}
                                                
                                            <td>
                                                <a type="button" href="{{ route('admin.authors.edit', ['authors_id' => $author->id])}}" class="text-info">Modifier</a>
                                                <a href="#" onclick="deleteConfirmation({{$author->id}})" class="text-danger mx-2">Supprimer</a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td>Aucun Auteurs pour le moment</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{$authors->links()}}
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

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Vous etes sur le point de supprimer cet auteur que toutes ces Oeuvres? <br>
                            Irreversible
                        </h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Annuler </button>
                        <button type="button" class="btn btn-danger" onclick="deleteAuthor()">Supprimer</button>
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
            @this.set('authors_id', id);
            $('#deleteConfirmation').modal('show');
        }
        function deleteAuthor()
        {
            @this.call('deleteAuthor');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush