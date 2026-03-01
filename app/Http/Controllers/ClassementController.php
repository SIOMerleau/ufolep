<?php

namespace App\Http\Controllers;

use App\Models\Engagement;
use Illuminate\Http\Request;
use App\Models\Classement;
use App\Models\Equipe;
use App\Models\Championnat;
use Illuminate\Support\Facades\Log;
use App\Models\Rencontre;

class ClassementController extends Controller
{
    //Création du classement
    public function createClassement($idChampionnat, $idDivison){
        try{
            //Récupérer les équipes du championnat
            $equipes = Equipe::where('idDivision', $idDivison)->get();
            //Créer un classement pour chaque équipe
            foreach($equipes as $e){
                //Création dans la table engagement
                $engagement = new Engagement();
                $engagement->idChampionnat = $idChampionnat;
                $engagement->idEquipe = $e->idEquipe;
                $engagement->nbPoints = 0;
                $engagement->matchesGagnes = 0;
                $engagement->matchesPerdus = 0;
                $engagement->differ = 0;
                $engagement->oldScore = 0;
                $engagement->scoreFinal = 0;
                $engagement->save();
            }
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    //Affichage d'un classement
    public function classement($idChampionnat){
        try{
            $classement = Engagement::where('idChampionnat', $idChampionnat)->orderBy('nbPoints', 'desc')->orderBy('differ', 'desc')->get();
            $championnat = Championnat::find($idChampionnat);
            return view('classement/classementPoule', compact('classement', 'championnat'));
        } catch (\Exception $e) {
            return view('error', compact('e'));
        }
    }

    //Gestion des forfaits
    //$equipe = A ou B
    public function forfait($idChampionnat, $idEquipeA, $idEquipeB, $equipeForfait){
        try{
            //Si l'équipe A à fait forfait
            if($equipeForfait == 'A'){
                //Ajoute une défaite à l'équipe A et 0 points
                //Engagement Equipe A
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeA)->first();
                $engagement->matchesPerdus += 1;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
                //Ajoute 3 points et une victoire à l'équipe B
                //Engagement Equipe B
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeB)->first();
                $engagement->matchesGagnes += 1;
                $engagement->nbPoints += 3;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
            //Si l'équipe B à fait forfait
            } else {
                //Equipe B
                //Engagement Equipe B
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeB)->first();
                $engagement->matchesPerdus += 1;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
                //Engagement Equipe A
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeA)->first();
                $engagement->matchesGagnes += 1;
                $engagement->nbPoints += 3;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
            }
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function checkIfVictoire($idRencontre, $idChampionnat, $idEquipeA, $idEquipeB){
        //Vérification si la rencontre à déjà été jouer et gagner et si oui remplacer les anciennes valeurs
            //Trouver la rencontre
            $rencontre = Rencontre::where('idRencontre', $idRencontre)->where('idEquipeA', $idEquipeA)->where('idEquipeB', $idEquipeB)->first();
            if($rencontre->victoire == "A"){
                //Enlever la victoire
                $rencontre->victoire = null;
                $rencontre->save();
                //Enlever les points du classement
                //Equipe A
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeA)->first();
                $engagement->matchesGagnes -= 1;
                $engagement->nbPoints -= 3;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
                //Equipe B
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeB)->first();
                $engagement->matchesPerdus -= 1;
                $engagement->nbPoints -= 1;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
            }elseif($rencontre->victoire == 'B'){
                //Enlever la victoire
                $rencontre->victoire = null;
                $rencontre->save();
                //Enlever les points du classement
                //Equipe B
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeB)->first();
                $engagement->matchesGagnes -= 1;
                $engagement->nbPoints -= 3;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
                //Equipe A
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeA)->first();
                $engagement->matchesPerdus -= 1;
                $engagement->nbPoints -= 1;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
            }elseif($rencontre->victoire == 'N'){
                //Enlever la victoire
                $rencontre->victoire = null;
                $rencontre->save();
                //Enlever les points du classement
                //Equipe B
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeB)->first();
                $engagement->nbPoints -= 2;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
                //Equipe A
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeA)->first();
                $engagement->nbPoints -= 2;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
            }
    }

    //Gestion des résultats, si une équipe a gagné, ajout des points dans le classement
    public function resultat($idChampionnat, $idEquipeA, $idEquipeB, $resultat){
        try{
            //Si l'équipe A a gagné
            if($resultat == 'A'){
                //Equipe A
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeA)->first();
                $engagement->matchesGagnes += 1;
                $engagement->nbPoints += 3;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
                //Equipe B
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeB)->first();
                $engagement->matchesPerdus += 1;
                $engagement->nbPoints += 1;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
            //Si l'équipe B a gagné
            }elseif($resultat == 'B'){
                //Equipe B
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeB)->first();
                $engagement->matchesGagnes += 1;
                $engagement->nbPoints += 3;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
                //Equipe A
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeA)->first();
                $engagement->matchesPerdus += 1;
                $engagement->nbPoints += 1;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
            //Si match nul
            }elseif($resultat == 'N'){
                //Equipe B
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeB)->first();
                $engagement->nbPoints += 2;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
                //Equipe A
                $engagement = Engagement::where('idChampionnat', $idChampionnat)->where('idEquipe', $idEquipeA)->first();
                $engagement->nbPoints += 2;
                $engagement->differ = $engagement->matchesGagnes - $engagement->matchesPerdus;
                $engagement->save();
            }
            //dd($classement);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();}
    }
}
