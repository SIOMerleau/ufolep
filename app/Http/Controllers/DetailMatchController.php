<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rencontre; // Assurez-vous d'avoir un modèle Rencontre
use App\Models\Arbitre;
use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Engagement;
use Illuminate\Support\Facades\Validator; // Pour la validation
use Illuminate\Support\Facades\Log;
use App\Models\Detailmatch;
use App\Models\Championnat;
use App\Http\Controllers\ClassementController;

class DetailMatchController extends Controller
{
    //Afficher la vue pour modifier les détails d'un match
    public function editDetailsMatch($championnatId, $rencontreId){
    //Récupération du championnat et de la rencontre
    $championnat = Championnat::find($championnatId);
    $rencontre = Rencontre::find($rencontreId);
    //Vérification de l'existence de la rencontre
    if (!$rencontre) {
        abort(404);
    }
    //relation de la rencontre avec detailsMatch
    $rencontre = Rencontre::with([
        'detailsMatch',
        'equipeA',
        'equipeB',
        'arbitre',
        'journee',
        'detailsMatch.joueurA', 
        'detailsMatch.joueurB', 
        'detailsMatch.joueurA.personne', 
        'detailsMatch.joueurB.personne',
    ])->find($rencontreId);
    
    //récupération des lettres clés
    foreach ($rencontre->detailsMatch as $detail) {
        if ($detail->joueurA) {
            $detail->joueurA->lettre = $detail->lettreR;
        }
        if ($detail->joueurB) {
            $detail->joueurB->lettre = $detail->lettreV;
        }
    }
    $equipeA = Joueur::all()->where('idEquipe', $rencontre->idEquipeA);
    $equipeB =Joueur::all()->where('idEquipe', $rencontre->idEquipeB);
    //    dd($equipeA, $equipeB);
    //retourne la vue avec les données pour modifier les détails du match
    return view('admin.championnat.editDetailsMatch', compact('rencontre','championnat', 'equipeA', 'equipeB'));
        
    }

    //Modifier les détails d'un match
    public function updateDetailsMatch(Request $request, $championnat, $rencontreId)
    {   //validation des données
        $validator = Validator::make($request->all(), [
            
            'scoreFinalA' => 'nullable|integer|min:0',
            'scoreFinalB' => 'nullable|integer|min:0',
            'victoire' => 'nullable|in:A,B,N',
            'joueurA_id_*' => 'required|integer',
            'joueurB_id_*' => 'required|integer',
            'pointsA_*' => 'nullable|integer|min:0',
            'pointsB_*' => 'nullable|integer|min:0',
        ], 
        //Messages en cas de non validation
        [
            
            'scoreFinalA.integer' => 'Le score final A doit être un nombre entier.',
            'scoreFinalB.integer' => 'Le score final B doit être un nombre entier.',
            'scoreFinalA.min' => 'Le score final A ne peut pas être inférieur à 0.',
            'scoreFinalB.min' => 'Le score final B ne peut pas être inférieur à 0.',
            'joueurA_id_*.required' => 'Le joueur A est requis.',
            'joueurB_id_*.required' => 'Le joueur A est requis.',
            'pointsA_*.integer' => 'Les points A doivent être un nombre entier.',
            'pointsB_*.integer' => 'Les points B doivent être un nombre entier.',
        ]);
        //Si la validation échoue on retourne les erreurs
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        //Récupération de la rencontre
        $rencontre = Rencontre::find($rencontreId);
        //Vérification de l'existence de la rencontre
        if (!$rencontre) {
            abort(404);
        }
        //Si la rencontre à été déclaré forfait on empêche la modification des détails du match
        if($rencontre->WO == 'A' || $rencontre->WO == 'B'){
            return back()->with('error', 'La rencontre a été déclarée forfait, vous ne pouvez pas modifier les détails du match.');
        }

        //Check si il y a déjà eu un résultat, si oui on le supprime le résultat pour le remplacer après
        $classementController = new ClassementController();
        $classementController->checkIfVictoire($rencontre->idRencontre, $rencontre->journee->idChampionnat, $rencontre->idEquipeA, $rencontre->idEquipeB );
        //récupération des données
        $rencontre->scoreFinalA = $request->input('scoreFinalA');
        $rencontre->scoreFinalB = $request->input('scoreFinalB');
        $rencontre->victoire = $request->input('victoire');
        //Vérification des données arbitre_id et journee_id
        if ($request->has('arbitre_id')) {
            $rencontre->arbitre_id = $request->input('arbitre_id');
        }
        if ($request->has('journee_id')) {
            $rencontre->journee_id = $request->input('journee_id');
        }
        //Sauvegarde de la rencontre
        $rencontre->save();

        //Mise a jours des détails du match
        foreach ($rencontre->detailsMatch as $detail) {
            //Mise a jours des points simple
            //Manche joueur A
            $detail->M1 = $request->input('M1_' . $detail->idMatch);
            $detail->M2 = $request->input('M2_' . $detail->idMatch);
            $detail->M3 = $request->input('M3_' . $detail->idMatch);
            $detail->M4 = $request->input('M4_' . $detail->idMatch);
            $detail->M5 = $request->input('M5_' . $detail->idMatch);
            //Manche joueur B
            $detail->M1B = $request->input('M1B_' . $detail->idMatch);
            $detail->M2B = $request->input('M2B_' . $detail->idMatch);
            $detail->M3B = $request->input('M3B_' . $detail->idMatch);
            $detail->M4B = $request->input('M4B_' . $detail->idMatch);
            $detail->M5B = $request->input('M5B_' . $detail->idMatch);
            
            $detail->pointsA = $request->input('pointsA_' . $detail->idMatch);
            $detail->pointsB = $request->input('pointsB_' . $detail->idMatch);
           // Maintien des joueurs sélectionnés
        // Maintien des joueurs sélectionnés ou assignation des nouveaux
       
        // $detail->idJR = $request->input('joueurA_id_match_' . $detail->idMatch);
        // $detail->idJV = $request->input('joueurB_id_match_' . $detail->idMatch);

        // // Vérification pour s'assurer que les valeurs ne sont pas nulles
        // if ($joueurAId !== null) {
        //     $detail->idJR = $joueurAId;
        // }
        // if ($joueurBId !== null) {
        //     $detail->idJV = $joueurBId;
        // }
        //dd($detail);

       //Sauvegarde des détails du match
        $detail->save();
         
          //Mise a jours des points double
            //Manche joueur A
            $rencontre->D1 = $request->input('D1');
            $rencontre->D2 = $request->input('D2');    
            $rencontre->D3 = $request->input('D3');  
            $rencontre->D4 = $request->input('D4');  
            $rencontre->D5 = $request->input('D5');
            //Manche joueur B   
            $rencontre->D1B = $request->input('D1B');
            $rencontre->D2B = $request->input('D2B');    
            $rencontre->D3B = $request->input('D3B');  
            $rencontre->D4B = $request->input('D4B');  
            $rencontre->D5B = $request->input('D5B');  
            $rencontre->ptsDbA = $request->input('pointsADouble');
            $rencontre->ptsDbB = $request->input('pointsBDouble');
            //Sauvegarde de la rencontre et des détails du match
            $rencontre->save();
            $rencontre->detailsMatch->first()->save();

        }
            //Classmenet_inter
            // Récupérer les IDs des joueurs A et B
            $idDetailMatch = $rencontre->detailsMatch->first()->idMatch;
            //boucle pour traiter les 9 joueurs
            for ($i = $idDetailMatch; $i < $idDetailMatch + 9; $i++) {
            $joueurAId = $request->input('joueurA_id_'. $i);
            $joueurBId = $request->input('joueurB_id_'. $i);

            //récupération des joueurs
            $joueurA = Joueur::find($joueurAId);
            $joueurB = Joueur::find($joueurBId);


            // dd($request->input('joueurA_id_*'));
            //dd($joueurA);

            //comparer les classements des joueurs
            $classementA = $joueurA->classement;
            $classementB = $joueurB->classement;
            $differenceClassement = $classementA - $classementB;

            // mise a 0 des points
            $pointsGagnesA = 0;
            $pointsPerdusA = 0;
            $pointsGagnesB = 0;
            $pointsPerdusB = 0;
                //mettre dans le positif la différence de classement
            if ($differenceClassement < 0) {
                $differenceClassement = abs($differenceClassement);
            }
            //dd($differenceClassement);
            
            //Attribution des points en fonction de la différence de classement
            if ($differenceClassement <= 24) {
                $pointsGagnesA = 50;
                $pointsPerdusA = 45;
                $pointsGagnesB = 50;
                $pointsPerdusB = 45;
            } elseif ($differenceClassement >= 25 && $differenceClassement <= 49) {
                if ($classementA > $classementB) {
                    $pointsGagnesA = 40;
                    $pointsPerdusA = 50;
                    $pointsGagnesB = 55;
                    $pointsPerdusB = 35;
                } else {
                    $pointsGagnesA = 55;
                    $pointsPerdusA = 35;
                    $pointsGagnesB = 40;
                    $pointsPerdusB = 50;
                }
            }elseif ($differenceClassement >= 50&& $differenceClassement <= 99) {
                if ($classementA > $classementB) {
                    $pointsGagnesA = 25;
                    $pointsPerdusA = 55;
                    $pointsGagnesB = 60;
                    $pointsPerdusB = 20;
                }else {
                    $pointsGagnesA = 20;
                    $pointsPerdusA = 60;
                    $pointsGagnesB = 55;
                    $pointsPerdusB = 25;
                }
            }elseif ($differenceClassement >= 100 && $differenceClassement <= 149) {
                if ($classementA > $classementB) {
                    $pointsGagnesA = 15;
                    $pointsPerdusA = 60;
                    $pointsGagnesB = 65;
                    $pointsPerdusB = 10;
                }else {
                    $pointsGagnesA = 65;
                    $pointsPerdusA = 10;
                    $pointsGagnesB = 15;
                    $pointsPerdusB = 60;
                }
            }elseif ($differenceClassement >= 150 && $differenceClassement <= 199){
                if ($classementA > $classementB) {
                    $pointsGagnesA = 5;
                    $pointsPerdusA = 65;
                    $pointsGagnesB = 70;
                    $pointsPerdusB = 0;
                }else {
                    $pointsGagnesA = 70;
                    $pointsPerdusA = 0;
                    $pointsGagnesB = 5;
                    $pointsPerdusB = 65;
                }
            }elseif ($differenceClassement >= 200){
                if ($classementA > $classementB) {
                    $pointsGagnesA = 0;
                    $pointsPerdusA = 70;
                    $pointsGagnesB = 75;
                    $pointsPerdusB = 0;
                }else {
                    $pointsGagnesA = 75;
                    $pointsPerdusA = 0;
                    $pointsGagnesB = 0;
                    $pointsPerdusB = 70; 
                }
            }
            //recuperation des points
            $pointA = $request->input('pointsA_'. $detail->idMatch);
            $pointB = $request->input('pointsB_'. $detail->idMatch);
    
                // Vérifier qui a gagné le match
                if ($pointA == 1 && $pointB == 0) {
                    //Si le joueur A gagne
                    $joueurA->classement_inter += $pointsGagnesA;
                    $joueurB->classement_inter -= $pointsPerdusB;
                }else {
                    //Sinon le joueur B gagne
                    $joueurA->classement_inter -= $pointsPerdusA;
                    $joueurB->classement_inter += $pointsGagnesB;
                }
                //verification des points
                // Log::info('jueurA -> '. $joueurA->classement_inter . $joueurA->personne->nom);
                $joueurA->save();
                $joueurB->save();
            }
            //Appelle de la fonction pour changer les résultats
            $classementController = new ClassementController();
            $classementController->resultat($rencontre->journee->idChampionnat, $rencontre->idEquipeA, $rencontre->idEquipeB 
            , $request->input('victoire'));
        
       
        //Redirection avec un message de succès
        return redirect()->route('admin.championnat.showAdmin', ['championnat' => $championnat, 'rencontreId' => $rencontre->idRencontre])
            ->with('success', 'Les détails du match ont été mis à jour avec succès !');
    }

    
}