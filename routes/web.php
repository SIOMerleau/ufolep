<?php
//Middleware qui renvoie bien vers la page de connexion si l'utilisateur n'est pas connecté ->middleware(AuthUfolep::class)
use App\Http\Controllers\ClassementController;
use App\Http\Middleware\AuthUfolep;
//Controller
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChampionnatController;
use App\Http\Controllers\AideController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\Admin\EquipeController;
use App\Http\Controllers\EquipeController1;
use App\Http\Controllers\RencontreController;
use App\Http\Controllers\DetailMatchController;
//Route Admin
use App\Http\Controllers\Admin\JoueurController as AdminJoueurController;
use App\Http\Controllers\Admin\PersonneController as AdminPersonneController;
use App\Http\Controllers\Admin\UserController as AdminUserController;


//Route::get('/', function () {
  //  return view('championnat/index');
//})->name('championnat.liste');




Route::get('admin/listePersonne', function(){
    return view('auth.login');
})->name('admin.listePersonne');//TODO

// Groupe middleware pour les routes admin
Route::middleware([AuthUfolep::class])->group(function () {

    //Onglet Mon Profil
    //Afficher la vue de mon profil
    Route::get('admin/moncompte', [AdminUserController::class, 'monCompte'])
        ->name('admin.monCompte');
    //Route pour modifier mon profil
    Route::post('admin/monCompte/{id}', [AdminUserController::class, 'updateMonCompte'])
        ->name('admin.updateMonCompte');

    //Onglets Joueurs.euses
    //Route pour afficher le classement individuel des joueurs pour l'admin
    Route::get('admin/listeJoueur', [AdminJoueurController::class, 'listeJoueur'])
        ->name('admin.listeJoueur');
    //Route pour simuler un nouveau classement
    Route::get('admin/simulationNewClassement', [AdminJoueurController::class, 'simulationNewClassement'])
    ->name('admin.simulationNewClassement');
    //Route pour afficher le formulaire de création d'un joueur
    Route::get('admin/formJoueur', [AdminJoueurController::class, 'formJoueur'])
        ->name('admin.formJoueur');
    Route::post('admin/formJoueur', [AdminJoueurController::class, 'create'])
        ->name('admin.createJoueur');
    //Route pour modifier le détail d'un joueur
    Route::put('/joueur/update/{id}', [JoueurController::class, 'update'])
    ->name('joueur.update');
    //Route pour calculer les points
    Route::get('admin/joueur/calculClassement', [AdminJoueurController::class, 'formCalculClassement'])
        ->name('admin.joueur.calculClassement');
    Route::post('admin/joueur/calculClassement', [AdminJoueurController::class, 'calculClassement'])
        ->name('admin.joueur.calculClassement');

    //Onglet gestion des personnes
    //Route pour afficher la liste des personnes pour les gérants
    Route::get('admin/listePersonne', [AdminPersonneController::class, 'listePersonne'])
        ->name('admin.listePersonne');
    //Route pour afficher le formulaire de création d'une personne
    Route::get('admin/formPersonne', [AdminPersonneController::class, 'formPersonne'])
        ->name('admin.formPersonne');
    //Route pour créer une personne
    Route::post('admin/formPersonne', [AdminPersonneController::class, 'create'])
        ->name('admin.createPersonne');
    //Route pour afficher le formulaire de modification d'une personne
    Route::get('admin/formPersonne/{id}', [AdminPersonneController::class, 'modifPersonne'])
        ->name('admin.modifPersonne');
    //Route pour modifier une personne
    Route::put('admin/formPersonne/{id}', [AdminPersonneController::class, 'update'])
        ->name('admin.updatePersonne');
    //Route pour afficher le formulaire pour supprimer une personne
    Route::get('admin/deletePersonne/{id}', [AdminPersonneController::class, 'deletePersonneForm'])
        ->name('admin.deletePersonne');
    //Route pour supprimer une personne
    Route::delete('admin/deletePersonne/{id}', [AdminPersonneController::class, 'deletePersonne'])
        ->name('admin.deletePersonne');

    //Onglet gestion des utilisateurs
    //Afficher la liste des utilisateurs
    Route::get('admin/listeUser', [AdminUserController::class, 'listeUser'])
    ->name('admin.listeUser');
    //Route pour afficher le formulaire de création d'un utilisateur
    Route::get('admin/formUser', [AdminUserController::class, 'formUser'])
        ->name('admin.formUser');
    //Route pour créer un utilisateur
    Route::post('admin/formUser', [AdminUserController::class, 'create'])
        ->name('admin.createUser');
    //Route pour afficher le formulaire de modification
    Route::get('admin/modifUser/{id}', [AdminUserController::class, 'modifUser'])
        ->name('admin.modifUser');
    //Route pour modifier un utilisateur
    Route::put('admin/modifUser/{id}', [AdminUserController::class, 'update'])
        ->name('admin.updateUser');
    //Route pour afficher le formulaire pour supprimer un utilisateur
    Route::get('admin/deleteUser/{id}', [AdminUserController::class, 'deleteUser'])
        ->name('admin.deleteUser');
    //Route pour supprimer un utilisateur
    Route::delete('admin/deleteUser/{id}', [AdminUserController::class, 'delete'])
        ->name('admin.deleteUser');

    //Onglet Importation/Exportation
    //Afficher la vue pour l'Importation CSV
    Route::get('admin/formCsv', [AdminJoueurController::class, 'formCsv'])
        ->name('admin.formCsv');
    //Importation CSV
    Route::post('admin/importCsv', [AdminJoueurController::class, 'importCsv'])
        ->name('admin.importCsv');
    //Exportation CSV
    Route::get('admin/exportCsv', [AdminJoueurController::class, 'exportCsv'])
        ->name('admin.exportCsv');

    //Onglet Aides
    //Route pour afficher le formulaire de modification de l'aide
    Route::get('/aide/modif/{id}', [AideController::class, 'modif'])
        ->name('aide.modif');
    //Route pour modifier l'aide
    Route::post('/aide/modif/{id}', [AideController::class, 'update'])
        ->name('aide.update');
    //Route pour afficher le formulaire de création d'aide
    Route::get('aide/ajout', [AideController::class, 'ajout'])
        ->name('aide.ajout');
    //Route pour créer une aide
    Route::post('aide/ajout', [AideController::class, 'store'])
        ->name('aide.store');
    //Supprimer une aide
    Route::delete('/aide/{id}', [AideController::class, 'destroy'])
        ->name('aide.destroy');

    //Page d'accueil de "Mon Espace"
    Route::get('/admin/listeChampionnat', [ChampionnatController::class, 'indexAdmin'])
        ->name('admin.listeChampionnat');

    //Onglet Equipe
    Route::get('/equipe/liste', [EquipeController::class, 'index'])
        ->name('admin.equipe.listeEquipe');
    Route::get('/equipe/create', [EquipeController::class, 'create'])
        ->name('admin.equipe.create');
    // Route pour traiter l'envoi du formulaire de création d'équipe
    Route::post('/equipe/store', [EquipeController::class, 'store'])
        ->name('equipe.store');
    //Route pour afficher la vue de modification d'une équipe
    Route::get('/equipe/modif/{id}', [EquipeController::class, 'edit'])
        ->name('admin.equipe.edit');
    //Route pour modifier une équipe
    Route::post('/equipe/modif/{id}', [EquipeController::class, 'update'])
        ->name('admin.equipe.update');




    //Onglet championnat
    //Route pour afficher le formulaire de création d'un championnat
    Route::get('/championnat/create', [ChampionnatController::class, 'create'])->name('admin.championnat.create');
    //Route pour créer un championnat
    Route::post('/championnat', [ChampionnatController::class, 'store'])->name('championnat.store');

    //route show admin
    Route::get('admin/championnat/{championnat}', [ChampionnatController::class, 'showAdmin'])
        ->name('admin.championnat.showAdmin');
    //Route pour afficher le formulaire de création de rencontre et des journées
    Route::get('/championnat/{idChampionnat}/journee/create/{nombre_journees}', [ChampionnatController::class, 'createJournees'])
        ->name('championnat.createJournees');
    //Route pour créer les journées et rencontre
    Route::post('/championnat/{idChampionnat}/journee/create/{nombre_journees}', [ChampionnatController::class, 'storeJournees'])
        ->name('championnat.storeJournees');

    //Route pour les rencontres
    //Route pour afficher le formulaire de création d'une rencontre
    Route::get('/admin/rencontre/{rencontre}', [RencontreController::class, 'edit'])
        ->name('admin.championnat.rencontreCreate');
    //Route pour créer une rencontre
    Route::put('/admin/rencontres/{rencontre}', [RencontreController::class, 'create'])
        ->name('rencontres.create');
    //Route pour modifier une rencontre
    Route::post('/admin/rencontres', [RencontreController::class, 'store'])
        ->name('rencontres.update');
    //Route pour afficher le formulaire pour modifier un détailmatch
    Route::get('/championnat/{championnatId}/rencontre/{rencontreId}/edit', [DetailMatchController::class, 'editDetailsMatch'])
        ->name('admin.championnat.editDetailsMatch');
    //Route pour modifier un détailmatch
    Route::put('/championnat/{championnat}/rencontre/{rencontreId}', [DetailMatchController::class, 'updateDetailsMatch'])
        ->name('championnat.updateDetailsMatch');
    //Route pour simuler un nouveau classement
    Route::post('/admin/simulationClassement', [JoueurController::class, 'simulerClassement'])->name('admin.simulationClassement');
});





// Route::get('admin/listeEquipe', function(){
//     return view('auth.login');
// })->name('admin.listeEquipe');//TODO

//Route pour accéder aux détails d'un joueur
Route::get('/joueur/detail/{id}', [JoueurController::class, 'detail'])
->name('joueur.detail');
//Route pour accéder aux anciens championnats
Route::get('/championnat/ancienneListe', [ChampionnatController::class, 'ancienneListe'])->name('championnat.ancienneListe');//TODO

//Route liée aux vues aides
Route::get('/aide/liste', [AideController::class, 'liste'])->name('aide.liste');

//Route pour afficher le formulaire de contact et l'onglet info rgpd
Route::get('/info/contact', [InfoController::class, 'contact'])->name('info.contact');//TODO
Route::get('/info/rgpd', [InfoController::class, 'rgpd'])->name('info.rgpd');//TODO

//Route pour l'authentification
//Route pour afficher la page de connexion
Route::get('/auth/login', [AuthController::class, 'index'])
    ->name('auth.index');
//Route pour se connecter
Route::post('/auth/login', [AuthController::class, 'login'])
    ->name('auth.login');
//Route pour se déconnecter
Route::get('/auth/logout', [AuthController::class, 'logout'])
    ->middleware(AuthUfolep::class)->name('auth.logout');

//Route pour
Route::get('joueur/listeGenerale', [JoueurController::class, 'liste'])->name('joueur.listeGenerale');//TODO
    
//Route pour voir le classement individuel des joueurs
Route::get('/joueur/liste', [JoueurController::class, 'liste'])
    ->name('joueur.liste');

//Route pour afficher les championnats actelles
Route::get('/', [ChampionnatController::class, 'index'])->name('championnats.listeActuelle');
//Route pour afficher les détails d'un championnat et voir les matchs
Route::get('/championnat/{championnat}', [ChampionnatController::class, 'show'])->name('championnat.show');
Route::get('/championnat/{championnat}/matchs', [ChampionnatController::class, 'showMatchs'])->name('championnat.showMatchs');
//Route pour afficher les détails d'une rencontre
Route::get('/championnat/{championnat}/rencontre/{rencontre}', [ChampionnatController::class, 'showDetailsMatch'])->name('championnat.detailMatch');
//Route pour accéder au classement d'un championnat
Route::get('classement/championnat/{id}', [ClassementController::class, 'classement'])->name('classement');




//Route pour afficher les joueurs d'une équipe

Route::get('/equipe/{equipe}/joueurs',[EquipeController1::class, 'listeEquipe'])->name('equipe.listeEquipeJoueur');


