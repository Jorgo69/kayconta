<div>
    <div class="container p-3">
        <div class="row">
            {{-- @forelse ($authors as $author) --}}
            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Header</div>
                <div class="card-body">
                  <h5 class="card-title">Light card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            {{-- @empty
                Aucun Auteurs
            @endforelse --}}
        </div>
    </div>
</div>
