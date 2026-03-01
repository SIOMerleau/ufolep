<?php

namespace App\Http\Controllers;

use App\Models\Aide;
use Illuminate\Http\Request;
use App\Http\Requests\AideRequest;

class AideController extends Controller
{

    //Afficher les différentes aides dans la vue aide/liste
    public function liste(){
        try {
            //Récupérer toutes les aides dans la table aide
            $aides = Aide::all();
            //Retourner la vue aide/liste avec les aides récupérées
            return view('aide/liste', compact('aides'));
        } catch (\Exception $e) {
            //Retourner la vue erreur
            return view('erreur', compact('e'));
        }
    }

    //Afficher le formulaire de modification d'une aide dans la vue aide/modif
    public function modif($id){
        try{
            //Récupérer l'aide correspondant à l'id passé en paramètre
            $aide = Aide::find($id);
            //Retourner la vue aide/modif avec l'aide récupérée
            return view('aide/modif', compact('aide'));
        } catch (\Exception $e) {
            //Retourner la vue erreur
            return view('erreur', compact('e'));
        }
    }

    //Modifier une aide dans la base de données
    public function update(AideRequest $request, $id){
        try{
            //Valider les données
            $validateData = $request->validated();
            //Récupérer l'aide correspondant à l'id passé en paramètre
            $aide = Aide::find($id);
            //Mettre à jour les données de l'aide
            $aide->titre_aide = $validateData['titre_aide'];
            $aide->lien = $validateData['lien'];
            //Sauvegarder les modifications
            $aide->save();
            //Rediriger vers la route aide.liste
            return redirect()->route('aide.liste')->with('success', 'Aide modifiée avec succès');
        } catch (\Exception $e) {
            //Retourner la vue erreur
            return view('erreur', compact('e'));
        }
    }
    //Afficher le formulaire d'ajout d'une aide dans la vue aide/ajout
    public function ajout(){
        return view('aide/ajout');
    }

    public function store(AideRequest $request){
        try{
            //Valider les données
            $validateData = $request->validated();
            //Créer une nouvelle aide
            $aide = new Aide();
            //Insérer les données du formulaire
            $aide->titre_aide = $validateData['titre_aide'];
            $aide->lien = $validateData['lien'];
            //Sauvegarder l'aide
            $aide->save();
            //Rediriger vers la route aide.liste
            return redirect()->route('aide.liste')->with('success', 'Aide ajoutée avec succès');
        } catch (\Exception $e) {
            //Retourner la vue erreur
            return view('erreur', compact('e'));
        }
    }

    //Supprimer une aide
    public function destroy($id){
        try{
            //Récupérer l'aide correspondant à l'id passé en paramètre
            $aide = Aide::find($id);
            //Supprimer l'aide
            $aide->delete();
            //Rediriger vers la route aide.liste
            return redirect()->route('aide.liste')->with('success', 'Aide supprimée avec succès');
        } catch (\Exception $e) {
            //Retourner la vue erreur
            return view('erreur', compact('e'));
        }
    }
}
