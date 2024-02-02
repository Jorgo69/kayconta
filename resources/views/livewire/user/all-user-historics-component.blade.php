<div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Oeuvres</th>
                    <th>Chapitres</th>
                    <th>Avis</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historics as $historic)
                <tr>
                    <td>
                        {{-- Pour afficher la date en le formattant a la Carbon tout en important Carbon avec [d ==> Jour]; [F ==> Mois en toute lettre]; [Y ==> Annee en 4 chiffre] --}}
                        Le {{ \Carbon\Carbon::parse($historic->created_at)->format('d F Y') }}
                    </td>
                    <td>
                        {{$historic -> manga -> title}}
                    </td>
                    <td>
                        {{$historic -> chapter -> title}}
                    </td>
                    <td>
                        {{ Str::substr($historic -> content, 0, 30)  }} ... 
                    </td>
                    <td>
                        {{-- <a href="#" class="btn-small d-block">Voir</a> --}}
                        <a href="#"  wire:click.prevent='deleteHComment({{ $historic->id}})' class="btn-small d-block">Supprimer</a>
                    </td>
                </tr>    
                @endforeach
            </tbody>
        </table>
    </div>
</div>