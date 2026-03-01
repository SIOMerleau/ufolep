<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    //Redirection si l'utilisateur n'est pas connecté
    protected $redirectTo = 'auth.login';



    //Afficher la page de connexion
    public function index(){
        //Si l'utilisateur est déjà connecté, on le renvoie dans la page "Mon Espace"
        if(Auth::check()){
            return redirect()->route('admin.listeChampionnat');
        //Sinon, on affiche la page de connexion
        }else{
            return view('auth/login');
        }
    }

    //La fonction se connecter
    public function login(AuthRequest $request){
        try{
            //Validation des données selon les règles
            $validateData = $request->validated();
            //Vérification des informations de connexion
            if(Auth::attempt(['identifiant' => $validateData['user'], 'password' => $validateData['passwd']])){
                //Si les informations sont correctes, on redirige l'utilisateur vers la page "Mon Espace"
                return redirect()->route('admin.listeChampionnat');
            }else{
                //Sinon, on renvoie l'utilisateur vers la page de connexion avec un message d'erreur
                return redirect()->route('auth.index')->with('error', 'Identifiant ou mot de passe incorrect');
            }
        }catch(\Exception $e){
            //Si une erreur survient, on renvoie l'utilisateur vers la page de connexion avec un message d'erreur
            return redirect()->route('auth.index')->with('error', 'Une erreur est survenue' . $e->getMessage());
        }
    }


    //La fonction se déconnecter
    public function logout(Request $request){
        try{
            //Déconnexion de l'utilisateur
            Auth::logout();
            //Invalider la session et régénérer le jeton
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            //Redirection vers la page de connexion
            return redirect()->route('championnats.listeActuelle');
        }catch(\Exception $e){
            //Si une erreur survient, on renvoie l'utilisateur vers la page de connexion avec un message d'erreur
            return redirect()->route('auth.index')->with('error', 'Une erreur est survenue' . $e->getMessage());
        }

    }
}
