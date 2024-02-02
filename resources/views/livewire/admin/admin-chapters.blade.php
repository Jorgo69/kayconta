<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                    <span></span> Les Chapitres
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
                                        Les Chapitres
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.add.chapter')}}" class="btn btn-success float-end"> Ajout de nouvelles chapitres </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center" role="alert">
                                        {{ Session::get('success')}}
                                    </div>
                                @endif
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Couverture </th>
                                            <th>Titre </th>
                                            <th>Chapitres</th>
                                            <th> Manga Associe</th>
                                            <th>Auteur </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                            $i = ($chapters->currentPage() -1) * ($chapters->perPage());
                                        @endphp
                                        @forelse ($chapters as $chapter)
                                        <tr>
                                            <td>{{++ $i}}</td>
                                            <td> <img src="{{ asset('kayconta-app/public//assets/imgs/mangas')}}/{{$chapter->manga->cover_image}}" width="20" alt="{{$chapter->title}}"></td>
                                            <td> {{substr($chapter->title, 0 ,22)}} ...</td>
                                            <td> {{$chapter->chapter_number}}</td>
                                            <td> {{$chapter->manga->title}}</td>
                                            <td>
                                                @if ($chapter->user)
                                                {{$chapter->user->pseudo}}
                                            @else
                                                Aucun auteur associé
                                            @endif
                                            </td>                                                
                                            <td>
                                                <a type="button" href="{{ route('admin.edit.chapters', ['chapters_id' => $chapter->id])}}" class="text-info">Modifier</a>
                                                <a href="#" onclick="deleteConfirmation({{$chapter->id}})" class="text-danger mx-2">Supprimer</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td>{{0 }}</td>
                                            <td> </td>
                                            <td>  ...</td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>                                                
                                            <td> </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{$chapters->links()}}
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

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Voudrez vous vraiment y continuer?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Annuler </button>
                        <button type="button" class="btn btn-danger" onclick="deleteThisChapter()">Supprimer</button>
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
            @this.set('chapters_id', id);
            $('#deleteConfirmation').modal('show');
        }
        function deleteThisChapter()
        {
            @this.call('deleteChapter');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush