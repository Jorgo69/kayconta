<x-app-layout>
    <div class="text-center m-5 p-5">
        <h1>Oops, Page Non Trouvée</h1>
        <h3>Quelques chose s'est mal passée</h3>
        <p>La page recherchée n'existe pas.</p>
        @push('title')
            <title>
                404 Error
            </title>
        @endpush
    </div>
</x-app-layout>