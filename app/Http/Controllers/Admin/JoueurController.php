<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\formJoueurRequest;
use App\Http\Requests\Admin\ImportCsvRequest;
use Illuminate\Http\Request;
use App\Models\Joueur;
use App\Models\Equipe;
use App\Models\Club;
use App\Models\Personne;
//use Log;

class JoueurController extends Controller
{
    //afficher le classement individuel des joueurs pour l'admin
    public function listeJoueur(){
        try{
            //Récupération de la table joueur triée par classement décroissant et nom croissant
            $joueurs = Joueur::orderBy('classement', 'desc')->get();
            //Filtre les joueurs en fonction de leur visibilité et de la connexion de l'utilisateur
            if (auth()->check()) {
                $joueurs = $joueurs->whereIn('visible', [1, 2]);
            } else {
                $joueurs = $joueurs->where('visible', 2);
            }
            //Vérification de la date du jour, 
            //qui doit correspondre aux date 1er février au 10 mars ou 1er juin au 10 juillet
            $today = date('Y-m-d');
            //$today = '2025-02-02';//TEST DEV
            $dateDebut1 = date('Y') . '-02-01';
            $dateFin1 = date('Y') . '-03-10';
            $dateDebut2 = date('Y') . '-06-01';
            $dateFin2 = date('Y') . '-07-10';
            //Vérification de la date
            if(($today >= $dateDebut1 && $today <= $dateFin1) || ($today >= $dateDebut2 && $today <= $dateFin2)){
                $button = true;
            }else{
                $button = false;
            }
            
            //dd($joueurs);
            //$joueurs = Joueur::orderBy('classement', 'desc')->get();
            return view('admin/joueur/listeJoueur', compact('joueurs', 'button'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //simuler un nouveau classement
    public function simulationNewClassement(){
        return view('auth.login');
    }

    //Afficher le formulaire de création d'un joueur
    public function formJoueur(){
        //Récupérer toutes les personnes qui ne sont pas assignés à un joueur (idJoueur = null)
        $personnes = Personne::where('idJoueur', null)->orderBy('nom', 'asc')->get();
        //Récupérer toutes les équipes
        $equipes = Equipe::all();
        //Récupérer tous les clubs
        $clubs = Club::all();
        return view('admin/joueur/formJoueur', compact(['personnes','equipes', 'clubs']));
    }

    public function create(formJoueurRequest $request){
        try{
            //Validation des données
            $validateData = $request->validated();
            /*
            //Vérification de la bonne entrée de la licence
            if($validateData['licenceJoueur'] === '017_' && strlen($validateData['licenceJoueur']) !== 8){
                return back()->with('error', 'La licence n\'est pas complète');
            } elseif (substr($validateData['licenceJoueur'], 0, 4) !== '017_') {
                return back()->with('error', 'La licence n\'est pas conforme, doit commencer par 017_');
            }
            */
            //Vérification de l'unicité de la licence
            $joueur = Joueur::where('licenceJoueur', $validateData['licenceJoueur'])->first();
            if($joueur != null){
                return back()->with('error', 'La licence existe déjà (le joueur est déjà créé)');
            }


            //Création d'un joueur
            $joueur = new Joueur();
            //Insertion des données validées dans le joueur
            $joueur->idPersonne = $validateData['idPersonne'];
            $joueur->visible = $validateData['visible'];
            $joueur->classement = $validateData['classement'] < 500 ? 500 : $validateData['classement']; //Un joueur ne peut pas être inférieur à 500 points
            $joueur->classement_fftt = $validateData['classement_fftt'];
            $joueur->licenceJoueur = $validateData['licenceJoueur'];//$joueur->licenceJoueur = $validateData['licenceJoueur'];
            $joueur->idEquipe = $validateData['idEquipe'];
            $joueur->idClub = $validateData['idClub'];
            //Sauvegarde du joueur
            $joueur->save();
            //Mise à jour de la personne
            $personne = Personne::find($validateData['idPersonne']);
            $personne->idJoueur = $joueur->idJoueur;
            $personne->save();
            //Log::info($joueur);
            //Redirection vers la liste des joueurs
            return redirect()->route('admin.listeJoueur')->with('success', 'Joueur créé');
        }catch (\Exception $e) {
            return view('erreur', compact('e'));
        }

    }

    //Exportation du classement en fichier csv
    public function exportCsv(){
        try{
            //Récupération de la table joueur triée par classement décroissant et nom croissant
            $joueurs = Joueur::join('personne', 'joueur.idPersonne', '=', 'personne.idPersonne')
            ->orderBy('classement', 'desc')
            ->orderBy('personne.nom', 'asc')
            ->get();
            //Date du jour
            $today = date('d-m-Y');
            //Création du fichier csv
            $filename = 'classementJoueurs-' . $today . '.csv';
            $handle = fopen($filename, 'w+');
            //Entête du fichier csv
            fputcsv($handle, array('Place' ,'Nom', 'Prénom', 'Genre', 'classement', 'Classement FFTT', 'Licence', 'Equipe', 'Club', 'Personne', 'Personne = 0 -> création de la personne'));
            //Insertion des données dans le fichier csv
            $place = 1;
            foreach($joueurs as $joueur){
            //Informations lisibles
            fputcsv($handle, array($place++, $joueur->nom, $joueur->prenom, $joueur->sexe, $joueur->classement, $joueur->classement_fftt, $joueur->licenceJoueur, $joueur->equipe->nomEquipe, $joueur->equipe->club->nomClub, $joueur->idPersonne));
            }
            //Enregistrement du fichier csv
            fclose($handle);
            //Envoi du fichier csv
            $headers = array(
            'Content-Type' => 'text/csv',
            );
            //Envoie du téléchargement du fichier
            //Si le fichier est téléchargé, il est supprimé
            return response()->download($filename, 'classementJoueurs-' . $today . '.csv', $headers)->deleteFileAfterSend(true);
        } catch(\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Afficher la vue pour importer un fichier csv dans le classement
    public function formCsv(){
        try{
            return view('admin.joueur.formCsv');
        } catch(\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Importer un fichier csv dans le classement
    public function importCsv(ImportCsvRequest $request){
        try{
            //Récupérer le fichier CSV + validation
            $file = $request->file('csv_file');
            //Lecture du fichier
            $path = $file->getRealPath();
            $handle = fopen($path, 'r');
            $header = fgetcsv($handle, 1000, ',');

            //Vérifier les colonnes obligatoires
            $requiredColumns = ['Personne', 'Nom', 'Prénom', 'Genre', 'classement', 'Classement FFTT', 'Licence', 'Equipe', 'Club'];
            foreach($requiredColumns as $rc){
                if(!in_array($rc, $header)){
                    return back()->with('error', 'Le fichier CSV doit contenir les colonnes : Personne, Nom, Prénom, Genre, classement, Classement FFTT, Licence, Equipe, Club');
                }
            }

            //Traitement du fichier
            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE){
                $row = array_combine($header, $data);

                //Vérification si l'équipe et le club existe bien
                $equipe = Equipe::where('nomEquipe', $row['Equipe'])->first();
                if($equipe == null){
                    return back()->with('error', 'L\'équipe ' . $row['Equipe'] . ' n\'existe pas. Ligne = ' . json_encode($row));
                }
                $club = Club::where('nomClub', $row['Club'])->first();
                if($club == null){
                    return back()->with('error', 'Le club ' . $row['Club'] . ' n\'existe pas. Ligne = ' . json_encode($row));
                }
                //Vérifier que tous les champs sont remplis
                if($row['Nom'] == null || $row['Prénom'] == null || $row['Genre'] == null || $row['classement'] == null || $row['Classement FFTT'] == null || $row['Licence'] == null || $row['Equipe'] == null || $row['Club'] == null){
                    return back()->with('error', 'Tous les champs doivent être remplis');
                }

                //Création ou mise à jour des données pour personne
                $personne = Personne::updateOrCreate(
                    ['idPersonne' => $row['Personne']],//Recherche par idPersonne
                    ['nom' => $row['Nom'], 'prenom' => $row['Prénom'], 'sexe' => $row['Genre']]
                );
                //Création ou mise à jour des données pour joueur
                $joueur = Joueur::updateOrCreate(
                    ['licenceJoueur' => $row['Licence']],//Recherche par licenceJoueur
                    ['classement' => $row['classement'] < 500 ? 500 : $row['classement'],//Un joueur ne peut pas être inférieur à 500 points
                    'classement_fftt' => $row['Classement FFTT'], 'visible' => 1, 'licenceJoueur' => $row['Licence'],
                    'idClub' => Club::where('nomClub', $row['Club'])->first()->idClub, 'idEquipe' => Equipe::where('nomEquipe', $row['Equipe'])->first()->idEquipe,
                    'idPersonne' => $personne->idPersonne]
                );
                //Sauvegarde de joueur
                $joueur->save();
                //Mise à jour de la personne avec la clé étrangère dans idJoueur
                $personne->idJoueur = $joueur->idJoueur;
                //Sauvegarde de personne
                $personne->save();
            }
            //Fermeture du fichier
            fclose($handle);
            //Suppression du fichier
            unlink($path);
            //Redirection vers la liste des joueurs
            return redirect()->route('admin.listeJoueur')->with('success', 'Importation réussie');
        } catch(\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Afficher la vue pour la basculement du classement
    public function formCalculClassement(){
        try{
            //Vérification de la date du jour, 
            //qui doit correspondre aux date 1er février au 10 mars ou 1er juin au 10 juillet
            $today = date('Y-m-d');
            //$today = '2025-02-02';//TEST DEV
            $dateDebut1 = date('Y') . '-02-01';
            $dateFin1 = date('Y') . '-03-10';
            $dateDebut2 = date('Y') . '-06-01';
            $dateFin2 = date('Y') . '-07-10';
            //Vérification de la date
            if(($today >= $dateDebut1 && $today <= $dateFin1) || ($today >= $dateDebut2 && $today <= $dateFin2)){
                $joueurs = Joueur::all();
                return view('admin.joueur.formCalculClassement', compact('joueurs'));
            }else{
                return back()->with('error', 'La date du jour ne correspond pas à la période de calcul du classement');
            }
            
        } catch(\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Basculement des points de classement inter en classement
    public function calculClassement(){
        try{
            //Vérification de la date du jour, 
            //qui doit correspondre aux date 1er février au 10 mars ou 1er juin au 10 juillet
            $today = date('Y-m-d');
            //$today = '2025-02-02';//TEST DEV
            $dateDebut1 = date('Y') . '-02-01';
            $dateFin1 = date('Y') . '-03-10';
            $dateDebut2 = date('Y') . '-06-01';
            $dateFin2 = date('Y') . '-07-10';
            //Vérification de la date
            if(($today >= $dateDebut1 && $today <= $dateFin1) || ($today >= $dateDebut2 && $today <= $dateFin2)){
                
                //Ajouter la valeur de classement_inter dans classement
                $joueurs = Joueur::all();
                foreach($joueurs as $joueur){
                    $joueur->classement += $joueur->classement_inter;
                    $joueur->classement < 500 ? $joueur->classement = 500 : $joueur->classement; //Un joueur ne peut pas être inférieur à 500 points
                    $joueur->classement_inter = 0;
                    //Sauvegarde du joueur
                    $joueur->save();
                }
                //Redirection avec un message de succès
                return redirect()->route('admin.listeJoueur')->with('success', 'Calcul du classement réussi');
            }else{
                return back()->with('error', 'La date du jour ne correspond pas à la période de calcul du classement');
            }    
        } catch(\Exception $e) {
            return view('erreur', compact('e'));
        }
    }
}
