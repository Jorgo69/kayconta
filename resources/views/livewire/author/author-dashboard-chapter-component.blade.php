<div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Couverture </th>
                    <th>Titre </th>
                    <th>Chapitres</th>
                    <th> Manga Associe</th>
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
                    <td> <img src="{{ asset('kayconta-app/public/assets/imgs/mangas')}}/{{$chapter->manga->cover_image}}" width="20" alt="{{$chapter->title}}"></td>
                    <td> {!! substr($chapter->title, 0 ,22) !!} ...</td>
                    <td> {!! $chapter->chapter_number !!}</td>
                    <td> {!! $chapter->manga->title !!}</td>
                    <td class='d-flex justify-space-between' >
                        <a type="button" href="{{ route('author.chapter.edit', ['chapters_id' => $chapter->id])}}" class="text-info">Modifier</a>
                        <a href="#" onclick="deleteConfirmation({{$chapter->id}})" class="text-danger mx-2">Supprimer</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>0</td>
                    <td> Null</td>
                    <td> Null</td>
                    <td> Null</td>
                    <td> Null</td>
                    <td> Null</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
