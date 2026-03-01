<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PersonneRequest;
use App\Models\Personne;
use App\Models\User;
use App\Models\Joueur;
use App\Models\Equipe;
use App\Models\Club;

class PersonneController extends Controller
{
    //Afficher la liste des personnes
    public function listePersonne(){
        try{
            //Récupération de la table personne triée par nom croissant
            $personnes = Personne::orderBy('nom', 'asc')->get();
            return view('admin/personne/listePersonne', compact('personnes'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Afficher le formulaire de création d'une personne
    public function formPersonne($id = null){
        try{
            return view('admin/personne/formPersonne',);
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }  
    }

    //Créer une personne
    public function create(PersonneRequest $request){
        try{
            //Validation des données
            $validateData = $request->validated();

            //Vérification des règles pour les noms composés
            //Si le nom est composé, un - entre les noms
            if(strpos($validateData['nom'], ' ') !== false){
                $noms = explode(' ', $validateData['nom']);
                $validateData['nom'] = $noms[0].'-'.$noms[1];
            }

            //Vérification des doublons
            if(Personne::where('nom', $validateData['nom'])->where('prenom', $validateData['prenom'])->exists()){
                return back()->with('error', 'La personne existe déjà');
            }


            //Création d'une personne
            $personne = new Personne();
            //Insertion des données validées dans la personne
            $personne->nom = strtoupper($validateData['nom']);//Toute en majuscule
            $personne->prenom = ucfirst(strtolower($validateData['prenom']));//Premiere lettre en majuscule
            $personne->date_naissance = $validateData['date_naissance'];
            $personne->age = $validateData['age'];
            $personne->sexe = $validateData['sexe'];
            $personne->mail = $validateData['mail'];
            $personne->adresse = $validateData['adresse'];
            //Sauvegarde de la personne
            $personne->save();
            //Redirection vers la liste des personnes
             //return redirect()->route('admin.listePersonne')->with('success', 'Personne créée');
             // MODIF 23/11/2025
             //Récupérer toutes les personnes qui ne sont pas assignés à un joueur (idJoueur = null)
            $personnes = Personne::where('idJoueur', null)->orderBy('nom', 'asc')->get();
       	    //Récupérer toutes les équipes
      	    $equipes = Equipe::all();
            //Récupérer tous les clubs
            $clubs = Club::all();
            $nouveaue = new Personne();
            $nouveau = $personne;
             
            return view('admin/joueur/formJoueur', compact(['personnes','equipes', 'clubs','nouveau']));
            // 
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //afficher le formulaire de modification
    public function modifPersonne($id){
        try{
            //Récupération de la personne
            $personne = Personne::find($id);
            return view('admin/personne/modifPersonne', compact('personne'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }
    //Modification d'une personne
    public function update(PersonneRequest $request, $id){
        try{
            //Validation des données
            $validateData = $request->validated();
            //Récupération de la personne
            $personne = Personne::find($id);
            //Insertion des données validées dans personne
            $personne->nom = $validateData['nom'];
            $personne->prenom = $validateData['prenom'];
            $personne->date_naissance = $validateData['date_naissance'];
            $personne->age = $validateData['age'];
            $personne->sexe = $validateData['sexe'];
            $personne->mail = $validateData['mail'];
            $personne->adresse = $validateData['adresse'];
            //Sauvegarde de la personne
            $personne->save();
            //Redirection vers la liste des personnes
            return redirect()->route('admin.listePersonne')->with('success', 'Personne modifiée');
        }catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Afficher le formulaire pour supprimer une personne
    public function deletePersonneForm($id){
        try{
            //Récupération de la personne
            $personne = Personne::find($id);
            return view('admin/personne/deletePersonne', compact('personne'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Supprimer une personne et les liaisons avec la table user et joueur
    public function deletePersonne($id){
        try{
            //Récupération de la personne
            $personne = Personne::find($id);
            //Récupération de l'utilisateur lié à la personne
            $user = User::where('idPersonne', $id)->first();
            //Récupération du joueur lié à la personne
            $joueur = Joueur::where('idPersonne', $id)->first();
            //Suppression de l'utilisateur lié à la personne
            if($user != null){
                $user->delete();
            }
            //Suppression du joueur lié à la personne
            if($joueur != null){
                $joueur->delete();
            }
            //Suppression de la personne
            $personne->delete();
            //Redirection vers la liste des personnes
            return redirect()->route('admin.listePersonne');
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }
}
