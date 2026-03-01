<?php

namespace App\Http\Controllers;

use App\Models\Joueur;
use App\Models\Equipe;
use App\Models\Club;
use Illuminate\Http\Request;
use App\Http\Requests\JoueurUpdateRequest;
use Carbon\Carbon;
//use Illuminate\Support\Facades\Log;

class JoueurController extends Controller
{
    public function liste(){
        try{
            //Récupération de la table joueur triée par classement décroissant et nom croissant
            $joueurs = Joueur::orderBy('classement', 'desc')->get();//dd($joueurs);
            //Filtre les joueurs en fonction de leur visibilité et de la connexion de l'utilisateur
            if (auth()->check()) {
                $joueurs = $joueurs->whereIn('visible', [1, 2]);
            } 
            else
            {
                $joueurs = $joueurs->whereIn('visible', 1);//dd($joueurs);
            }
            //$joueurs = Joueur::orderBy('classement', 'desc')->get();
            $anneeActuelle = Carbon::now()->year;
            $anneeAutre = $anneeActuelle + (date ("n")>=10 )?1:-1;
            $champ = '%Championnat ' . $anneeActuelle . '/'.$anneeAutre.'%';
            return view('joueur/liste', compact('joueurs','champ'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    public function detail($id){
        try{
            //Récupération du joueur
            $joueur = Joueur::find($id);
            //Récupération des équipes pour la vue gérant
            $equipes = Equipe::all();
            //Récupération de tous les clubs pour la vue gérant
            $clubs = Club::all();
            return view('joueur/detail', compact(['joueur', 'equipes', 'clubs']));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Modifier un joueur
    public function update(JoueurUpdateRequest $request, $id){
        try{
            //Valider les données
            $validateData = $request->validated();
            //Log::info($validateData);
            //Récupération du joueur
            $joueur = Joueur::find($id);
            //Mise à jour du joueur via les données validées du formulaire
            //Mise à jour du joueur
            $joueur->classement = $validateData['classement'] < 500 ? 500 : $validateData['classement'];//Un joueur ne peut pas être inférieur à 500 points
            $joueur->visible = $validateData['visible'];
            $joueur->classement_fftt = $validateData['classement_fftt'];
            $joueur->licenceJoueur = $validateData['licenceJoueur'];
            //Mise à jour du joueur lié à une équipe
            $joueur->idEquipe = $validateData['idEquipe'];
            //Mise à jour du joueur lié à un club
            $joueur->idClub = $validateData['idClub'];
            //Sauvegarde des modifications de la table joueur
            $joueur->save();
            return redirect()->route('joueur.liste')->with('success', 'Le joueur a bien été modifié');
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }
    public function simulerClassement(){
        try{
            // Récupération de tous les joueurs
            $joueurs = Joueur::all();

            // Simulation d'un nouveau classement pour chaque joueur
            $classementsSimules = $joueurs->map(function ($joueur) {
                $joueur->classement_simule = rand(1, 2000); // Exemple de classement entre 1 et 100
                return $joueur;
            });

             // Trier les joueurs par classement simulé du plus grand au plus petit
             $classementsSimules = $classementsSimules->sortByDesc('classement_simule');

            return view('admin.simulationClassement', compact('classementsSimules'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }
}
