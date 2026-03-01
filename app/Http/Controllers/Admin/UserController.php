<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Arbitre;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personne;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Afficher la liste des utilisateurs
    public function listeUser()
    {
        try{//Récupération de tous les utilisateurs
            $users = User::all();
            return view('admin.user.listeUser', compact('users'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Afficher le formulaire de création d'utilisateur
    public function formUser(){
        try{
            //Récupération de toutes les personnes non liés à un compte (idCompte = null)
            $personnes = Personne::where('idCompte', null)->orderBy('nom', 'asc')->get();
            return view('admin.user.formUser', compact('personnes'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Créer un utilisateur
    public function create(UserRequest $request){
        try{
            //Validation des données
            $validateData = $request->validated();
            
            //Vérification que le mot de passe respecte les règles de sécurité données (8 caractères, une majuscule, une minuscule et un chiffre)
            if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $validateData['password'])){
                return redirect()->route('admin.formUser')->with('error', 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre');
            }

            //Création d'un utilisateur
            $user = new User();
            //Insertion des données
            $user->identifiant = $validateData['identifiant'];
            $user->password = Hash::make($validateData['password']);
            $user->typeCompte = $validateData['typeCompte'];
            $user->idPersonne = $validateData['idPersonne'];
            //Sauvegarde
            $user->save();
            //Création dans la table arbitre si le compte est ARBITRE
            if($user->typeCompte === "ARBITRE"){
                $arbitre = new Arbitre();
                $arbitre->idCompte = $user->idCompte;
                $arbitre->save();
            }
            //Ajout de la liason dans la table personne
            $personne = Personne::find($validateData['idPersonne']);
            $personne->idCompte = $user->idCompte;
            $personne->save();
            //Redirection vers la liste des utilisateurs
            return redirect()->route('admin.listeUser')->with('success', 'Utilisateur créé');
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Afficher le formulaire de modification d'un utilisateur
    public function modifUser($id){
        try{
            //Récupération de l'utilisateur
            $user = User::find($id);
            //Retourne la vue avec l'utilisateur
            return view('admin.user.modifUser', compact('user'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Modifier un utilisateur
    public function update(UserRequest $request, $id){
        try{
            //Validation des données
            $validateData = $request->validated();
            //Récupération de l'utilisateur
            $user = User::find($id);
            //Vérification que le mot de passe respecte les règles de sécurité données (8 caractères, une majuscule, une minuscule et un chiffre)
            if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $validateData['password'])){
                return redirect()->route('admin.modifUser', $user->idCompte)->with('error', 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre');
            }

            //Insertion des données
            $user->password = Hash::make($validateData['password']);
            $user->typeCompte = $validateData['typeCompte'];
            //Sauvegarde de l'utilsiateur
            $user->save();
            //Redirection vers la liste des utilisateurs
            return redirect()->route('admin.listeUser')->with('success', 'Utilisateur modifié');
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }


    //Afficher le formulaire pour supprimer un utilisateur
    public function deleteUser($id){
        try{
            //Récupération de l'utilisateur
            $user = User::find($id, );
            return view('admin.user.deleteUser', compact('user'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Supprimer un utilisateur
    public function delete($id){
        try{
            //Récupération de l'utilisateur
            $user = User::find($id);
            //Suppression de la liason dans la table personne
            $personne = Personne::find($user->idPersonne);
            $personne->idCompte = null;
            $personne->save();
            //Supression si arbitre
            if($user->typeCompte === "ARBITRE"){
                $arbitre = Arbitre::where('idCompte', $user->idCompte)->first();
                $arbitre->delete();
            }
            //Suppression de l'utilisateur
            $user->delete();
            //Redirection vers la liste des utilisateurs
            return redirect()->route('admin.listeUser')->with('success', 'Utilisateur supprimé');
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }

    //Affiche la vue "mon profil"
    public function monCompte(){
        try{
            //Récupération de l'utilisateur connecté
            $user = auth()->user();
            return view('admin.user.monCompte', compact('user'));
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
    }
    
    //Modifier le mot de passe de l'utilisateur connecté
    public function updateMonCompte($idCompte, Request $request){
        try{
            //Validation des données
            $validateData = $request->validate([
                'password' => 'required|string|confirmed',
            ]);
            //Vérification que le mot de passe respecte les règles de sécurité données (8 caractères, une majuscule, une minuscule et un chiffre)
            if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $validateData['password'])){
                return redirect()->route('admin.monCompte')->with('error', 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre');
            }

            //Récupération de l'utilisateur connecté
            $user = User::find($idCompte);
            //Changement du mot de passe
            $user->password = Hash::make($validateData['password']);
            //Sauvegarde de l'utilisateur
            $user->save();
            //Redirection vers la vue mon profil avec un message de succès
            return redirect()->route('admin.monCompte')->with('success', 'Mot de passe modifié');
            
        }  catch (\Illuminate\Validation\ValidationException $e){
            return redirect()->route('admin.monCompte')->with('error', 'La confirmation du mot de passe ne correspond pas.');
        } catch (\Exception $e) {
            return view('erreur', compact('e'));
        }
        
    }
    
}
