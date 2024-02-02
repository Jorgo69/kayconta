<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index') }}" rel="nofollow">Accueil</a>
                    <span></span> Tous les Genres
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
                                        Genres
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.add.genres') }}" class="btn btn-success float-end">
                                            Ajout de nouveau Genres </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                @if (Session::has('danger'))
                                    <div class="alert alert-danger text-center" role="alert">
                                        {{ Session::get('danger') }}
                                    </div>
                                @endif

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom </th>
                                            <th>Dscription</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                            $i = ($genres->currentPage() - 1) * $genres->perPage();
                                        @endphp
                                        @forelse ($genres as $genre)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td> {{ $genre->name }}</td>
                                                <td>{!! substr($genre->description, 0, 90) !!} ...</td>

                                                <td>
                                                    <a type="button"
                                                        href="{{ route('admin.edit.genres', ['genre_id' => $genre->id]) }}"
                                                        class="text-info">Modifier</a>
                                                    <a href="#" onclick="deleteConfirmation({{ $genre->id }})"
                                                        class="text-danger mx-2">Supprimer</a>
                                                </td>
                                            </tr>
                                        @empty
                                            Aucun Genres
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $genres->links() }}
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
                        <h4 class="pb-3">Voudrez vous vraiment y continuer?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#deleteConfirmation">Annuler </button>
                        <button type="button" class="btn btn-danger" onclick="deleteGenre()">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('deleteScript')
    <script>
        function deleteConfirmation(id) {
            @this.set('genre_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteGenre() {
            @this.call('deleteGenre');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush
