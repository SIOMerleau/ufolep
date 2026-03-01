<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\EquipeRequest;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Equipe; // Importez le modèle Equipe
use App\Models\Club; // Importez le modèle
use App\Models\Division; // Importez le modèle Division


class EquipeController extends Controller
{
    public function index()
    {
        $equipes = Equipe::orderBy('idDivision', 'asc')->get(); // Récupérez toutes les équipes depuis la base de données
        return view('admin.equipe.listeEquipe', compact('equipes')); // Passez les équipes à la vue
    }

    public function create()
    {

        $clubs = Club::all(); // Récupérez tous les clubs depuis la base de données
        $divisions = Division::all(); // Récupérez toutes les divisions depuis la base de données
        return view('admin.equipe.create', compact('clubs','divisions')); // Vue pour le formulaire de création d'équipe
    }

    public function store(EquipeRequest $request)
    {
        // Validez les données du formulaire (à adapter à vos besoins)
        $validatedData = $request->validated();
        //dd($request->all()); // Affichez les données du formulaire

        // Créez une nouvelle équipe
        Equipe::create([
            'nomEquipe' => $validatedData['nomEquipe'],
            'idClub' => $validatedData['idClub'],
            'idDivision' => $validatedData['idDivision'],
            'nbPts' => 0, // Valeur par défaut : 0
            'idChampionnat' => 0, // Valeur par défaut : 0
            'nomPoule' => null, // Ou une chaîne vide si vous préférez
            'matchesGagnes' => 0, // Valeur par défaut : 0
            'matchesPerdus' => 0, // Valeur par défaut : 0
            'manchesGagnees' => 0, // Valeur par défaut : 0
            'manchesPerdues' => 0, // Valeur par défaut : 0
        ]);

        return redirect()->route('admin.equipe.listeEquipe')->with('success', 'Équipe créée avec succès !');
    }

    //Afficher la vue pour modifier une équipe
    public function edit($id){
        try{
            $equipe = Equipe::findOrFail($id); // Récupérez l'équipe à modifier
            $clubs = Club::all(); // Récupérez tous les clubs depuis la base de données
            $divisions = Division::all(); // Récupérez toutes les divisions depuis la base de données
            return view('admin.equipe.edit', compact('equipe','clubs','divisions')); // Vue pour le formulaire de modification d'équipe
        } catch(\Exception $e){
            return view('erreur', compact('e')); // Vue pour afficher l'erreur
        }
    }

    //Mettre à jour une équipe
    public function update($id, EquipeRequest $request){
        try{
            //Validation des données du formulaire
            $validateData = $request->validated();
            //Récupérer l'équipe à modifier
            $equipe = Equipe::findOrFail($id);
            //Mettre à jour l'équipe
            $equipe->nomEquipe = $validateData['nomEquipe'];
            $equipe->idClub = $validateData['idClub'];
            $equipe->idDivision = $validateData['idDivision'];
            //Sauvegarde de l'équipe
            $equipe->save();
            //Redirection avec un message de succès
            return redirect()->route('admin.equipe.listeEquipe')->with('success', 'Équipe modifiée avec succès !');
        }catch(\Exception $e){
            return view('erreur', compact('e')); // Vue pour afficher l'erreur
        }
    }
}