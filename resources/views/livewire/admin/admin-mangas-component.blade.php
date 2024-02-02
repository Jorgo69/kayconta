<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>
                    <span></span> Tous les Mangas
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
                                        Les Mangas
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.add.mangas')}}" class="btn btn-success float-end"> Ajouter un Mangas </a>
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
                                            <th>Vedette ?</th>
                                            <th>Images </th>
                                            <th>Titre </th>
                                            <th>Description</th>
                                            <th>Par </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                            $i = ($mangas->currentPage() -1) * ($mangas->perPage());
                                        @endphp
                                        @forelse ($mangas as $manga)
                                        <tr>
                                            <td>{{++ $i}}</td>
                                            <td>{{ $manga->featured }}</td>
                                            <td> <img src="{{asset('kayconta-app/public/assets/imgs/mangas')}}/{{$manga->cover_image}}" alt="" width="45"></td>
                                            <td> {{$manga->title}}</td>
                                            <td> {!! substr($manga->description, 0, 90) !!} ...</td>
                                            <td> {{$manga->user->pseudo}}</td>
                                                
                                            <td class="d-flex justify-content-around p-5">
                                                {{-- <a href="{{ route('admin.add.chapters', ['id' => $manga->id])}}">+</a> --}}
                                                <a href="{{ route('admin.edit.mangas', ['mangas_id' => $manga->id])}}" class="text-info">Modifier</a>
                                                <a href="#" onclick="deleteConfirmation({{$manga->id}})" class="text-danger mx-2">Supprimer</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td>{{__('') }}</td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td>  ...</td>
                                            <td> </td>
                                                
                                            <td class="d-flex justify-content-around p-5">
                                                
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{$mangas->links()}}
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
                        <button type="button" class="btn btn-danger" onclick="deleteThisManga()">Supprimer</button>
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
            @this.set('mangas_id', id);
            $('#deleteConfirmation').modal('show');
        }
        function deleteThisManga()
        {
            @this.call('deleteManga');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush