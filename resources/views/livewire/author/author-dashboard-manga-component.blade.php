<div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Images</th>
                    <th>Titres</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($manga as $mang)
                <tr>
                    @php
                        $i = 0;
                    @endphp

                    <tr>
                    <td>{{++ $i}}</td>
                    <td> <img src="{{asset('kayconta-app/public/assets/imgs/mangas') }}/{{ $mang->cover_image}}" alt="" width="45"></td>
                    <td> {!!$mang->title!!} ...</td>
                    <td> {!!$mang->description!!}</td>
                    <td class='d-flex justify-space-between' >
                        <a href="{{ route('author.manga.edit',  ['mangas_id' => $mang->id])}}" class="btn-small justify-content-evently">Modif</a>
                        <a href="#" onclick="deleteConfirmation({{$mang->id}})"  class="btn-small justify-content-evently">Sup</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
