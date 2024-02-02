<?php

namespace App\Http\Livewire\User;

use App\Models\DemandeAuteur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserDemandeAuteurComponent extends Component
{
    use WithFileUploads;

    public $objet, $about, $contrat, $planches = [], $planchesImages = [];

    public $choix = ['oui', 'non'];

    public $isEditing;

    protected $rules = [
        'objet' => 'required|string',
        'about' => 'required|string',
        'contrat' => 'required|in:oui,non',
        'planches' => 'required|array',
        'planches.*' => 'image|mimes:jpeg,png,jpg',
        // 'lu' => 'nullable|boolean',
    ];

    protected $messages = [
        'objet.required' => 'Vous devriez renseigné un ":attribute".',
        'objet.string' => 'Le champ ":attribute" doit être une chaîne de caractères.',
        'about.required' => 'Le champ à propos est obligatoire.',
        'about.string' => 'Le champ à propos doit être une chaîne de caractères.',
        'contrat.required' => 'Le champ ":attribute" est obligatoire.',
        'contrat.in' => 'Le champ ":attribute" doit être "oui" ou "non".',
        'planches.required' => 'Le champ ":attribute" est obligatoire.',
        'planches.array' => 'Le champ ":attribute" doit être un tableau.',
        'planches.*.image' => 'Chaque élément du champ ":attribute" doit être une image.',
        'planches.*.mimes' => 'Chaque élément du champ ":attribute" doit avoir une extension jpeg, png ou jpg.',
        // 'lu.nullable' => 'Le champ ":attribute" doit être nul ou de type boolean.',
    ];

    public function mount()
{
    // Vérifie si l'utilisateur a déjà une demande
    $existingDemande = DemandeAuteur::where('user_id', auth()->id())->first();

    if ($existingDemande) {
        // Si une demande existe, chargez les données existantes dans les propriétés du composant
        $this->objet = $existingDemande->objet;
        $this->about = $existingDemande->about;
        $this->contrat = $existingDemande->contrat;

        // Vous pouvez également charger les autres champs si nécessaire

        // Marquez le composant comme "édition" plutôt que "création"
        $this->isEditing = true;
    }
}



    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'objet' => 'required|string',
            // 'objet.required' => 'Le champs Objet est obligatoire',
            'about' => 'required|string',
            'contrat' => 'required|in:oui,non',
            'planches' => 'required|image|mimes:jpeg,png,jpg',
            // 'planches' => 'required|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=100,min_height=100|max:2048', // Taille maximale de 2 Mo
            // 'planches.dimensions' => 'La planche doit avoir une largeur et une hauteur d\'au moins 100 pixels.',

        ]);
    }

    

    public function MakeRequest()
    {
        $this->validate([
            'objet' => 'required|string',
            'about' => 'required|string',
            'contrat' => 'required|in:oui,non',
            'planches' => 'required|array',
            'planches.*' => 'image|mimes:jpeg,png,jpg',
            // 'lu' => 'nullable|boolean',
        ]);

                // Si le contrat n'est pas égal à 'oui', affiche un message d'erreur
    if ($this->contrat !== 'oui') {
        $this->addError('contrat', 'Vous devriez accepter le contrat".');
        return;
    }

        // Vérifie si l'utilisateur a déjà une demande
    $existingDemande = DemandeAuteur::where('user_id', auth()->id())->first();

    if ($existingDemande) {
        // Si une demande existe, mettez à jour les données existantes
        $existingDemande->update([
            'objet' => $this->objet,
            'about' => $this->about,
            'contrat' => $this->contrat,
            'planche' => $this->planches,
            
            // Mettez à jour les autres champs si nécessaire
        ]);

        // Affichez un message de succès ou effectuez d'autres actions nécessaires

        // Remarque : Vous pouvez également ajouter une propriété dans le modèle DemandeAuteur
        // pour indiquer si la demande a été acceptée ou non, et ajuster la logique en conséquence.
    } else {
        // Si aucune demande n'existe, créez une nouvelle demande
        $demande = new DemandeAuteur();
        $demande ->objet = $this->objet;
        $demande ->about = $this->about;
        $demande->contrat = $this->contrat;
        $demande ->user_id = Auth::id();

        foreach ($this->planches as $key => $planche) {
            $imageName = Carbon::now()->timestamp . $key . '.' . $this->planches[$key]->extension();
            $this->planches[$key]->storeAs('demandes', $imageName);
            $this->planchesImages[] = $imageName; // Ajoutez le nom de fichier au tableau
        }

        $demande->planche = json_encode($this->planchesImages);
        // dd($demande);

        $demande->save();

    }

        return redirect()->route('user.dashboard');
    }
    public function render()
    {
        $this->choix;

        return view('livewire.user.user-demande-auteur-component');
    }
}
