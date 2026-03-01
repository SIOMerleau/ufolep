<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreJourneesRequest;
use App\Models\Championnat;
use App\Models\Joueur;
use App\Models\Rencontre;
use App\Models\Division;
use App\Models\Equipe;
use App\Models\Journee;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Http\Requests\UpdateRencontreRequest;
use App\Models\Detailmatch;
use Log;

class ChampionnatController extends Controller
{
    
    public function index()
    {
        //année actuelle
        //$anneeActuelle = Carbon::now()->year;
        $anneeActuelle = Carbon::now()->year;
        $anneeActuelle += (date ("n")>=10 )?1:0;
        $value = '%Championnat ' . $anneeActuelle . '%';
        dump($value);
        $championnats = Championnat::with('division') // Eager load the division relationship
            ->orderBy('idChampionnat', 'desc')
            ->where('nomChampionnat', 'like', $value)
            ->get();//dd($championnats);
        return view('championnat.listeActuelle', compact('championnats'));
    }


    public function ancienneListe()
    {
        //année actuelle
        $anneeActuelle = Carbon::now()->year;
        $anneeActuelle += (date ("n")>=10 )?1:0;
        $value = '%Championnat ' . $anneeActuelle . '%';
        //Récupérer tous les championnats sauf ceux de cette année
        $championnats = Championnat::where('nomChampionnat', 'not like', $value)
                        ->orderBy('idDivision')->orderBy('idChampionnat', 'desc')->get();
        return view('championnat.ancienneListe', compact('championnats'));
    }

    public function create()
    {
        $anneeActuelle = Carbon::now()->year;
        $divisions = Division::all();
        $equipes = Equipe::all();
        return view('admin.championnat.create', compact('divisions', 'anneeActuelle', 'equipes'));
    }

    public function store(Request $request)
    {
        //Validation des données
        $validatedData = $request->validate([
            'nomChampionnat' => 'required|string|max:64',
            'typeChampionnat' => 'required|in:Départemental,Régional,National',
            'idDivision' => 'required|exists:division,idDivision',
            'nomPoule' => 'nullable|string|max:1',
            'nombre_journees' => 'required|integer|min:1',
        ]);

        $nomChampionnat = 'Championnat ' . $validatedData['nomChampionnat'];

        //Création du championnat
        $championnat = new Championnat();
        $championnat->nomChampionnat = $nomChampionnat;
        $championnat->typeChampionnat = $validatedData['typeChampionnat'];
        $championnat->idDivision = $validatedData['idDivision'];
        $championnat->nomPoule = $validatedData['nomPoule'];
        $championnat->save();

        //Création du classement
        //Appelle au controller ClassementController
        $classementController = new ClassementController();
        $classementController->createClassement($championnat->idChampionnat, $validatedData['idDivision']);

        //Redirection vers le formulaire pour créer les journées et les rencontres en passant par le controller
        return redirect()->route('championnat.createJournees', [$championnat->idChampionnat, $validatedData['nombre_journees']]);

        /*$championnatData = Arr::except($validatedData, ['nombre_journees']);
        
        $championnatId = DB::table('championnat')->insertGetId($championnatData);

        $divisionId = $validatedData['idDivision'];
        $nombreJournees = $validatedData['nombre_journees'];
        $dateDuJour = Carbon::now()->toDateString();

        $equipes = Equipe::where('idDivision', $divisionId)->get();
        $nombreEquipes = $equipes->count();

        if ($nombreEquipes < 2) {
            return back()->withErrors(['message' => 'Il faut au moins deux équipes dans la division pour créer des matchs.']);
        }

        for ($journeeNum = 1; $journeeNum <= $nombreJournees; $journeeNum++) {
            $journee = Journee::create([
                'idChampionnat' => $championnatId,
                'numJournee' => $journeeNum,
                'datePrev' => $dateDuJour,
            ]);
    
            $equipesMelangees = $equipes->shuffle();
            $nombreMatchsParJournee = 3;
    
            $rencontres = []; // Initialisation de $rencontres (CORRECTION IMPORTANTE)
    
            if ($nombreEquipes % 2 == 0) {
                $nombreMatchsACreer = min($nombreMatchsParJournee, $nombreEquipes / 2);
                for ($i = 0; $i < $nombreMatchsACreer * 2; $i += 2) {
                    $rencontre = Rencontre::create([ // Stockez la rencontre créée dans $rencontre
                        'idJournee' => $journee->idJournee,
                        'idEquipeA' => $equipesMelangees[$i]->idEquipe,
                        'idEquipeB' => $equipesMelangees[$i + 1]->idEquipe,
                        'ptsDbA' => 0,
                        'ptsDbB' => 0,
                        'scoreFinalA' => 0,
                        'scoreFinalB' => 0,
                        'D1' => 0, 'D2' => 0, 'D3' => 0, 'D4' => 0, 'D5' => 0,
                        'D1B' => 0, 'D2B' => 0, 'D3B' => 0, 'D4B' => 0, 'D5B' => 0,
                    ]);
                    $rencontres[] = $rencontre; // Ajoutez la rencontre au tableau $rencontres
                }
            } else {
                 $nombreMatchsACreer = min($nombreMatchsParJournee, ($nombreEquipes -1) / 2);
                for ($i = 0; $i < $nombreMatchsACreer * 2; $i += 2) {
                    $rencontre = Rencontre::create([ // Stockez la rencontre créée dans $rencontre
                        'idJournee' => $journee->idJournee,
                        'idEquipeA' => $equipesMelangees[$i]->idEquipe,
                        'idEquipeB' => $equipesMelangees[$i + 1]->idEquipe,
                        'ptsDbA' => 0,
                        'ptsDbB' => 0,
                        'scoreFinalA' => 0,
                        'scoreFinalB' => 0,
                        'D1' => 0, 'D2' => 0, 'D3' => 0, 'D4' => 0, 'D5' => 0,
                        'D1B' => 0, 'D2B' => 0, 'D3B' => 0, 'D4B' => 0, 'D5B' => 0,
                    ]);
                    $rencontres[] = $rencontre;// Ajoutez la rencontre au tableau $rencontres
                }
            }
            $journee->rencontres = $rencontres; // Ceci n'est pas nécessaire, la relation Eloquent s'en charge.
        }*/
        
    }

    //afficher la vue pour Création des journées et des rencontres
    public function createJournees($idChampionnat, $nombre_journees){
        try{
            $championnat = Championnat::findOrFail($idChampionnat);
            $equipes = Equipe::where('idDivision', $championnat->idDivision)->get();
            $ville = Ville::all();

            return view('admin.championnat.createJournees', compact('championnat', 'equipes', 'nombre_journees', 'ville'));
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Erreur lors de la création des journées et des rencontres : ' . $e->getMessage()])->withInput();
        }
    }

    //Enregistrer les journées et les rencontres
    public function storeJournees(StoreJourneesRequest $request,$idChampionnat, $nombre_journees){
        try{
            //Validation des données
            $validateData = $request->validated();
            //Log::info($validateData);
            //Création des journées et rencontres
            for($i=1; $i <= $nombre_journees; $i++){
                //Création de la journée
                $journee = new Journee();
                $journee->idChampionnat = $idChampionnat;
                $journee->numJournee = $i;
                $journee->datePrev = $validateData["datePrev-{$i}"];
                //Sauvegarde
                $journee->save();

                //Création des 3 rencontres de la journée
                for($j = 1; $j <= 3; $j++){
                    $rencontre = new Rencontre();
                    $rencontre->idJournee = $journee->idJournee;
                    $rencontre->lieu = $validateData["lieu_{$i}_{$j}"];
                    $rencontre->idEquipeA = $validateData["idEquipeA_{$i}_{$j}"];
                    $rencontre->idEquipeB = $validateData["idEquipeB_{$i}_{$j}"];
                    $rencontre->ptsDbA = 0;
                    $rencontre->ptsDbB = 0;
                    $rencontre->scoreFinalA = 0;
                    $rencontre->scoreFinalB = 0;
                    $rencontre->D1 = 0;
                    $rencontre->D2 = 0;
                    $rencontre->D3 = 0;
                    $rencontre->D4 = 0;
                    $rencontre->D5 = 0;
                    $rencontre->D1B = 0;
                    $rencontre->D2B = 0;
                    $rencontre->D3B = 0;
                    $rencontre->D4B = 0;
                    $rencontre->D5B = 0;
                    $rencontre->save();
                }
            }
            //Redirection vers la vue pour ajouter les détails des rencontres
            $championnat = Championnat::findOrFail($idChampionnat);
            return redirect()->route('admin.championnat.showAdmin', $championnat)->with('success', 'Journées et rencontres créées avec succès.');
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }



    public function show(Championnat $championnat)
{   //afficher les journées et les rencontres
    $championnat->load(['journees' => function ($query) {
        $query->orderBy('numJournee')->with(['rencontres' => function ($query) {
            $query->with(['equipeA', 'equipeB', 'detailsMatch' => function ($query) {
                // Charger detailsMatch seulement si la relation existe
            }]);
        }]);
    }, 'division']);//dd($championnat);

    return view('championnat.show', compact('championnat'));
}
    // public function showMatchs(Championnat $championnat)
    // {
    //     $championnat->load('journees');

    //     return view('championnat.showMatchs', compact('championnat'));
    // }

    public function editRencontre( Championnat $championnat, Rencontre $rencontre)
    {
        $rencontre->load(['equipeA', 'equipeB', 'journee.championnat']); // Chargez les relations nécessaires
        return view('admin.championnat.editRencontre', compact('championnat','rencontre'));
    }

    public function updateRencontre(UpdateRencontreRequest $request,  Championnat $championnat, Rencontre $rencontre)
    {
        //Validation des données
        $validatedData = $request->validated();
        try {
            //Mise à jour de la rencontre
            $rencontre->update($validatedData);
            //Redirection vers la vue de la rencontre
            return redirect()->route('championnat.show', $championnat)->with('success', 'Rencontre mise à jour avec succès.');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Erreur lors de la mise à jour de la rencontre : ' . $e->getMessage()])->withInput();
        }
    }


    public function showDetailsMatch($championnatId, $rencontreId)
{   //charger les relations
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

    if (!$rencontre) {
        abort(404);
    }

   //associer les lettres aux joueurs
    foreach ($rencontre->detailsMatch as $detail) {
        if ($detail->joueurA) {
            $detail->joueurA->lettre = $detail->lettreR;
        }
        if ($detail->joueurB) {
            $detail->joueurB->lettre = $detail->lettreV;
        }
    }

    return view('championnat.detailMatch', compact('rencontre'));
}


public function indexAdmin()
    { //affichage de la liste des championnats en admin
        $championnats = Championnat::with('division') 
            ->orderBy('idChampionnat', 'desc')
            ->get();

        return view('admin.listeChampionnat', compact('championnats'));
    }


    public function showAdmin(Championnat $championnat)
    { //affichages des rencontres et des journées en admin
        $championnat->load(['journees' => function ($query) {
            $query->orderBy('numJournee')->with(['rencontres' => function ($query) {
                $query->with(['equipeA', 'equipeB', 'detailsMatch' => function ($query) {
                    // Charger detailsMatch seulement si la relation existe
                }]);
            }]);
        }, 'division']);
    
        return view('admin.championnat.showAdmin', compact('championnat'));
    }

    
}