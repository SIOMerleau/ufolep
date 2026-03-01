<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Equipe; // Importez le modèle Equipe
use App\Models\Club; // Importez le modèle
use App\Models\Division; // Importez le modèle Division
use App\Models\Joueur;


class EquipeController1 extends Controller{

    //Afficher la vue de la liste des équipes
    public function listeEquipe($equipeId) {
        // Trouver l'équipe par son ID
        $equipe = Equipe::find($equipeId);
    
        // Vérifier si l'équipe existe
        if (!$equipe) {
            abort(404, 'Équipe non trouvée.');
        }
    
        // Récupérer tous les joueurs de l'équipe
        $joueur = Joueur::where('idEquipe', $equipe->idEquipe)->get();
    
        // Retourner la vue avec les joueurs et l'équipe
        return view('equipe.listeEquipeJoueur', compact('joueur', 'equipe'));
    }
    
}