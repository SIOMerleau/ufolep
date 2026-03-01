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

class RencontreController extends Controller
{
    //Afficher la vue pour modifier une rencontre
   public function edit($rencontre)
   {
    // Récupérer la rencontre
    $rencontre = Rencontre::find($rencontre);
    // Récupérer les arbitres, les équipes et les joueurs
    $arbitres = Arbitre::all();
    $equipes = Equipe::all()->where('idDivision', $rencontre->journee->championnat->idDivision);
    $joueurs = Joueur::all();
    //Log::info($joueurs);
    $equipeA = Equipe::find($rencontre->idEquipeA);
    $equipeB = Equipe::find($rencontre->idEquipeB);
    $joueursA = Joueur::all()->where('idClub', $equipeA->idClub)->where('visible', '1');
    $joueursB = Joueur::all()->where('idClub', $equipeB->idClub)->where('visible', '1');
    Log::info($joueursA);
    Log::info($joueursB);
    // Organiser les joueurs par équipe pour faciliter l'affichage dans la vue
  
    //dd($joueursA); dd($joueursB);
    return view('admin.championnat.rencontreCreate', compact('rencontre', 'arbitres', 'equipes', 'joueurs','joueursA','joueursB','equipeA','equipeB'));

}
   //Créer une rencontre
public function create(Request $request, $rencontre){
    try{
        //Récupération de la rencontre
        $rencontre = Rencontre::find($rencontre);
	//dd($request);
        // Validation des données
        $validator = Validator::make($request->all(), [
            //Validation des données de la rencontre
            'heure' => 'required|',
            'date' => 'required|date|',
            'lieu' => 'required|string|max:255',
            'arbitre' => 'required|exists:arbitre,idArbitre',
            'equipeA' => 'required|exists:equipe,idEquipe',
            'equipeB' => 'required|exists:equipe,idEquipe',
            //Validation du forfait ou match joué
            'WO' => 'required|in:J,A,B',
            //Validation des clés des joueurs
            'lettreR1' => 'required|in:A',
            'lettreR2' => 'required|in:B',
            'lettreR3' => 'required|in:C',
            'lettreV1' => 'required|in:X',
            'lettreV2' => 'required|in:Y',
            'lettreV3' => 'required|in:Z',
            //Validation des id des joueurs
            'idJR1' => 'required|integer',
            'idJR2' => 'required|integer',
            'idJR3' => 'required|integer',
            'idJV1' => 'required|integer',
            'idJV2' => 'required|integer',
            'idJV3' => 'required|integer',
        ]);


         // Ajout des règles de validation conditionnelles pour les équipes "smash"
        // Validation conditionnelle pour les équipes Smash
        /*
	if (strpos($rencontre->equipeA->nomEquipe, 'Smash') !== false) {
	    $validator->sometimes('lettreR4', 'required|in:D', function ($input) {
	        return $input->useJoueurA4 == 'on';
	    });
	    $validator->sometimes('idJR4', 'required|integer', function ($input) {
	        return $input->useJoueurA4 == 'on';
	    });
	}
	
	if (strpos($rencontre->equipeB->nomEquipe, 'Smash') !== false) {
	    $validator->sometimes('lettreV4', 'required|in:W', function ($input) {
	        return $input->useJoueurB4 == 'on';
	    });
	    $validator->sometimes('idJV4', 'required|integer', function ($input) {
	        return $input->useJoueurB4 == 'on';
	    });
	}*/
	     
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); // Redirection en cas d'erreur
        }
        
        // Mise à jour de la rencontre
        $rencontre->update([
            'heure' => $request->input('heure'),
            'date' => $request->input('date'),
            'lieu' => $request->input('lieu'),
            'idArbitre' => $request->input('arbitre'),
            'idEquipeA' => $request->input('equipeA'),
            'idEquipeB' => $request->input('equipeB'),
            'WO' => $request->input('WO'),
            //Si le forfait est de l'équipe A alors l'équipe B gagne, inversement et sinon null
            'victoire' => $request->input('WO') == 'A' ? 'B' : ($request->input('WO') == 'B' ? 'A' : null),
        ]);
        //Sauvegarde de rencontre
        $rencontre->save();
        
        //Création des 9 détails matchs
        //Récupération des différentes informations des joueurs résidents et visiteurs
        $idJR = [
            ['id' => $request->input('idJR1'), 'lettre' => $request->input('lettreR1')],
            ['id' => $request->input('idJR2'), 'lettre' => $request->input('lettreR2')],
            ['id' => $request->input('idJR3'), 'lettre' => $request->input('lettreR3')]
        ];
        
        $idJV = [
            ['id' => $request->input('idJV1'), 'lettre' => $request->input('lettreV1')],
            ['id' => $request->input('idJV2'), 'lettre' => $request->input('lettreV2')],
            ['id' => $request->input('idJV3'), 'lettre' => $request->input('lettreV3')]
        ];
/*
        if ($request->input('useJoueurA4') == 'on') {
            $idJR[] = ['id' => $request->input('idJR4'), 'lettre' => $request->input('lettreR4')];
        }
        if ($request->input('useJoueurB4') == 'on') {
            $idJV[] = ['id' => $request->input('idJV4'), 'lettre' => $request->input('lettreV4')];
        }
        
*/
        //Tout les joueurs résidents doivent rencontrer tous les différentes joueurs visiteurs
        /*
        * Tables des ordres des matchs en fonction des clés
        * 3c3    4c3     3c4
        * A-X   A-X     A-X
        * B-Y   B-Y     B-Y
        * C-Z   C-Z     C-Z
        * B-X   D-X     B-W
        * A-Z   B-Z     A-Y
        * C-Y   C-Y     C-X
        * B-Z   A-Z     B-Z
        * C-X   B-X     C-Y
        * A-Y   D-Y     A-W

        *lettreR1 = A, lettreR2 = B, lettreR3 = C, lettreR4 = D
        *lettreV1 = X, lettreV2 = Y, lettreV3 = Z, lettrev4 = W
        */
            
        //Création des ordres des matchs
        //Si aucune équipe est smash
        // Déterminer l'ordre des matchs en fonction du nombre de joueurs
if (count($idJR) == 3 && count($idJV) == 3) {
    $ordreClesMatch = [
        ['lettreR' => 'A', 'lettreV' => 'X'], ['lettreR' => 'B', 'lettreV' => 'Y'], ['lettreR' => 'C', 'lettreV' => 'Z'],
        ['lettreR' => 'B', 'lettreV' => 'X'], ['lettreR' => 'A', 'lettreV' => 'Z'], ['lettreR' => 'C', 'lettreV' => 'Y'],
        ['lettreR' => 'B', 'lettreV' => 'Z'], ['lettreR' => 'C', 'lettreV' => 'X'], ['lettreR' => 'A', 'lettreV' => 'Y']
    ];
} elseif (count($idJR) == 4 && count($idJV) == 3) {
    $ordreClesMatch = [
        ['lettreR' => 'A', 'lettreV' => 'X'], ['lettreR' => 'B', 'lettreV' => 'Y'], ['lettreR' => 'C', 'lettreV' => 'Z'],
        ['lettreR' => 'D', 'lettreV' => 'X'], ['lettreR' => 'B', 'lettreV' => 'Z'], ['lettreR' => 'C', 'lettreV' => 'Y'],
        ['lettreR' => 'A', 'lettreV' => 'Z'], ['lettreR' => 'B', 'lettreV' => 'X'], ['lettreR' => 'D', 'lettreV' => 'Y']
    ];
} elseif (count($idJR) == 3 && count($idJV) == 4) {
    $ordreClesMatch = [
        ['lettreR' => 'A', 'lettreV' => 'X'], ['lettreR' => 'B', 'lettreV' => 'Y'], ['lettreR' => 'C', 'lettreV' => 'Z'],
        ['lettreR' => 'B', 'lettreV' => 'W'], ['lettreR' => 'A', 'lettreV' => 'Y'], ['lettreR' => 'C', 'lettreV' => 'X'],
        ['lettreR' => 'B', 'lettreV' => 'Z'], ['lettreR' => 'C', 'lettreV' => 'Y'], ['lettreR' => 'A', 'lettreV' => 'W']
    ];
}
        

        //Création des détails matchs
        foreach($ordreClesMatch as $ordre){
            $detailMatch = new Detailmatch();
            $detailMatch->idRencontre = $rencontre->idRencontre;
            $detailMatch->lettreR = $ordre['lettreR'];
            $detailMatch->lettreV = $ordre['lettreV'];
            $detailMatch->idJR = $idJR[array_search($ordre['lettreR'], array_column($idJR, 'lettre'))]['id'];
            $detailMatch->idJV = $idJV[array_search($ordre['lettreV'], array_column($idJV, 'lettre'))]['id'];
            $detailMatch->pointsA = 0;
            $detailMatch->pointsB = 0;
            //enregistrer le classement des joueurs au moment de la création de la rencontre
            $detailMatch->classementJoueurA = Joueur::find($detailMatch->idJR)->classement;
            $detailMatch->classementJoueurB = Joueur::find($detailMatch->idJV)->classement;
            $detailMatch->save();
        }



        //Si forfait d'une équipe, on appelle la fonction de forfait dans ClassementController
        if($request->input('WO') == 'A' || $request->input('WO') == 'B'){
            $classementController = new ClassementController();
            $classementController->forfait($rencontre->journee->idChampionnat, $rencontre->idEquipeA, $rencontre->idEquipeB , $request->input('WO'));
        }
        
        //dd($detailMatch);

        return redirect()->route('admin.listeChampionnat')->with('success', 'Rencontre créer avec succès !');
    } catch(\Exception $e){
        Log::error($e->getMessage());
        return view('erreur', compact('e'));
    }
}


}

