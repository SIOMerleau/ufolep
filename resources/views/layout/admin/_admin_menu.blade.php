<div class="row mx-0">
    @php //Ajouter e si le genre de l'utilisateur est féminin
    $genre = Auth::user()->personne->sexe === 'M' ? '' : 'e'; 
    @endphp

    <div id="admin-menu" class="container-fluid col-lg-3">
        <div class="welcome-container" style="display: ;" name="cacher">
            <span class="welcome-message">
                Session de <b style="color: #00379a">{{Auth::user()->personne->prenom}} {{Auth::user()->nom}},</b>
            </span>
            <br>
            <span style="color: #fffff;">Vous êtes connecté{{$genre}} en tant que
                {!! Auth::user()->typeCompte === "GÉRANT" ? "<b style='color: #ffa500;'>GÉRANT{{strtoupper($genre)}}</b>"
                : "<b style='color: #00a800;'>correspondant{{$genre}} d'un club</b>" !!}.
            </span>
        </div>
        @php /* Les différents onglets */ @endphp
        <div style="display: ;" name="cacher">
            <h4 class="admin-menu-title">Panel de Gestion</h4>
            <a href={{route('admin.listeChampionnat')}}>
                <div class="row mx-0">
                    <div class="nav-item icon-container"><i class="fas fa-home"></i></div>
                    <div class="col nav-item">Tableau de bord</div>
                </div>
            </a>
            <hr>
            
            <a href={{route('admin.equipe.listeEquipe')}}>
                <div class="row mx-0">
                    <div class="nav-item icon-container"><i class="fas fa-users"></i></div>
                    <div class="col nav-item">Équipes</div>
                </div>
            </a>
            <a href={{route('admin.listeJoueur')}}>
                <div class="row mx-0">
                    <div class="nav-item icon-container"><i class="fas fa-table-tennis"></i></div>
                    <div class="col nav-item">Enregistrement des joueurs.euses<br>à partir des nouveaux adhérents</div>
                </div>
            </a>
            <hr>
           
                <a href={{route('admin.listePersonne')}}>
                    <div class="row mx-0">
                        <div class="nav-item icon-container"><i class="fas fa-user-cog"></i></div>
                        <div class="col nav-item">Inscription des nouveaux adhérents</div>
                    </div>
                </a>
                @php /*Si l'utilisateur est GÉRANT on affiche des onglets supplémentaires */ @endphp
                @if(Auth::user()->typeCompte === "GÉRANT")
                <a href={{route('admin.listeUser')}}>
                    <div class="row mx-0">
                        <div class="nav-item icon-container"><i class="fas fa-user-shield"></i></div>
                        <div class="col nav-item">Gestion des utilisateurs</div>
                    </div>
                </a>
            @endif
            
            <a href={{route('admin.monCompte')}}>
                <div class="row mx-0">
                    <div class="nav-item icon-container"><i class="fas fa-user-circle"></i></div>
                    <div class="col nav-item">Mon compte</div>
                </div>
            </a>
            
            <hr>
            <a class="disconnect-link" href={{route('auth.logout')}}>
                <div class="row mx-0">
                    <div class="nav-item icon-container"><i class="fas fa-power-off"></i></div>
                    <div class="col nav-item">Déconnexion</div>
                </div>
            </a>
        </div>
    </div>

    <div id="admin-body" class="col-lg-9">