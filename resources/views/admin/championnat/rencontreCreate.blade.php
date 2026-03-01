<?php 
// dd($joueursA) ;
// dd($joueursB) ; 
?>
@extends('layout.admin.admin')

@section('title', 'Gestion des matches - T2T Ufolep17')

@section('content')
    <h2>Compléter la rencontre</h2>
    <hr>

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@elseif($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif
      

    <form method="POST" action="{{ route('rencontres.create', $rencontre->idRencontre) }}">
        @csrf
        @method('PUT')

        <table class="table">
            <tr>
                <th>Lieu</th>
                <td><input type="text" name="lieu" value="{{ $rencontre->lieu }}" required></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><input type="date" name="date" value="{{ $rencontre->journee->datePrev }}" required></td>
            </tr>
            <tr>
                <th>Heure</th>
                <td><input type="time" name="heure" value="{{ $rencontre->heure }}" required></td>
            </tr>
            <tr>
                <th>Arbitre</th>
                <td>
                    <select name="arbitre" required>
                        <option value="">Sélectionner un arbitre</option>
                        @foreach ($arbitres as $arbitre)
                            <option value="{{ $arbitre->idArbitre }}" {{ $rencontre->idArbitre == $arbitre->idArbitre ? 'selected' : '' }}>
                                {{ $arbitre->idArbitre }} {{ $arbitre->user->personne->prenom ?? 'NC'}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>Équipe Résidente</th>
                <td>
                   <input type="text" name="nomEquipeA" value="{{ $equipeA->nomEquipe }}" disabled="disabled">
                   <input type="hidden" name="equipeA" value="{{ $equipeA->idEquipe }}" >
                </td>
            </tr>
            <tr>
                <th>Équipe visiteuse</th>
                <td>
                   <input type="text" name="nomquipeB" value="{{ $equipeB->nomEquipe }}" disabled="disabled">
                   <input type="hidden" name="equipeB" value="{{ $equipeB->idEquipe }}" >
                </td>
            </tr>
            <tr>
                <th>Déclarer un forfait</th>
                <td>
                    <input type="radio" id="forfaitA" name="WO" value="A" required {{$rencontre->WO == 'A' ? 'checked' : ''}}>
                    <label for="forfaitA" id="labelForfaitA">Forfait {{ $equipeA->nomEquipe }}</label>

                    <input type="radio" id="WO" name="WO" value="J" required {{$rencontre->WO == 'J' ? 'checked' : ''}}>
                    <label for="WO">Match joué</label>

                    <input type="radio" id="forfaitB" name="WO" value="B" required {{$rencontre->WO == 'B' ? 'checked' : ''}}>
                    <label for="forfaitB" id="labelForfaitB">Forfait {{ $equipeB->nomEquipe }}</label>
                </td>
            </tr>
        </table>

        <h3>Détails des matchs</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Clés</th>
                    <th>Joueur Résident</th>
                    <th>Clés</th>
                    <th>Joueur Visiteur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A
                        <input type="hidden" name="lettreR1" value="A">
                    </td>
                    
                    <td>
                        <select class="idJR" name="idJR1" required>
                            <option value="">Sélectionner un joueur</option>
                            @foreach ($joueursA as $joueur)
                                <option value="{{ $joueur->idJoueur }}" data-equipe="{{ $joueur->idEquipe }}">
                                     {{ $joueur->personne->nom ?? 'NC'}} {{ $joueur->personne->prenom  ?? 'NC' }}
                                </option>
                            @endforeach
                        </select>
                    </td>

                    <td>X
                        <input type="hidden" name="lettreV1" value="X">
                    </td>

                    <td>
                        <select class="idJV" name="idJV1" required>
                            <option value="">Sélectionner un joueur</option>
                            @foreach ($joueursB as $joueur)
                                <option value="{{ $joueur->idJoueur }}" data-equipe="{{ $joueur->idEquipe }}">
                                     {{ $joueur->personne->nom ?? 'NC'}} {{ $joueur->personne->prenom  ?? 'NC' }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>B
                        <input type="hidden" name="lettreR2" value="B">
                    </td>
                    
                    <td>
                        <select class="idJR" name="idJR2" required>
                            <option value="">Sélectionner un joueur</option>
                            @foreach ($joueursA as $joueur)
                                <option value="{{ $joueur->idJoueur }}" data-equipe="{{ $joueur->idEquipe }}">
                                    {{ $joueur->personne->nom ?? 'NC'}} {{ $joueur->personne->prenom  ?? 'NC' }}
                                </option>
                            @endforeach
                        </select>
                    </td>

                    <td>Y
                        <input type="hidden" name="lettreV2" value="Y">
                    </td>

                    <td>
                        <select class="idJV" name="idJV2" required>
                            <option value="">Sélectionner un joueur</option>
                            @foreach ($joueursB as $joueur)
                                <option value="{{ $joueur->idJoueur }}" data-equipe="{{ $joueur->idEquipe }}">
                                      {{ $joueur->personne->nom ?? 'NC'}} {{ $joueur->personne->prenom  ?? 'NC' }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>C
                        <input type="hidden" name="lettreR3" value="C">
                    </td>
                    
                    <td>
                        <select class="idJR" name="idJR3" required>
                            <option value="">Sélectionner un joueur</option>
                            @foreach ($joueursA as $joueur)
                                <option value="{{ $joueur->idJoueur }}" data-equipe="{{ $joueur->idEquipe }}">
                                     {{ $joueur->personne->nom ?? 'NC'}} {{ $joueur->personne->prenom  ?? 'NC' }}
                                </option>
                            @endforeach
                        </select>
                    </td>

                    <td>Z
                        <input type="hidden" name="lettreV3" value="Z">
                    </td>

                    <td>
                        <select class="idJV" name="idJV3" required>
                            <option value="">Sélectionner un joueur</option>
                            @foreach ($joueursB as $joueur)
                                <option value="{{ $joueur->idJoueur }}" data-equipe="{{ $joueur->idEquipe }}">
                                    {{ $joueur->personne->nom ?? 'NC'}} {{ $joueur->personne->prenom  ?? 'NC' }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                         </tr>

    <!-- Quatrième joueur pour l'équipe A (Smash) -->
    @if (strpos(strtolower($rencontre->equipeA->nomEquipe), 'smash') !== false)
    <tr id="joueurA4Row">
        <td>D
            <input type="hidden" name="lettreR4" value="D">
        </td>
        <td>
            <select class="idJR" name="idJR4">
                <option value="">Sélectionner un joueur</option>
                @foreach ($joueurs as $joueur)
                    @if ($joueur->idEquipe == $rencontre->equipeA->idEquipe)
                        <option value="{{ $joueur->idJoueur }}" data-equipe="{{ $joueur->idEquipe }}">
                            {{ $joueur->personne->nom }} {{ $joueur->personne->prenom }}
                        </option>
                    @endif
                @endforeach
            </select>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="4">
            <input type="checkbox" id="useJoueurA4" name="useJoueurA4" checked>
            <label for="useJoueurA4">Utiliser 4 joueurs pour l'équipe {{ $rencontre->equipeA->nomEquipe }}</label>
        </td>
    </tr>
@endif

<!-- Quatrième joueur pour l'équipe B (Smash) -->
@if (strpos(strtolower($rencontre->equipeB->nomEquipe), 'smash') !== false)
    <tr id="joueurB4Row">
        <td></td>
        <td></td>
        <td>W
            <input type="hidden" name="lettreV4" value="W">
        </td>
        <td>
            <select class="idJV" name="idJV4">
                <option value="">Sélectionner un joueur</option>
                @foreach ($joueurs as $joueur)
                    @if ($joueur->idEquipe == $rencontre->equipeB->idEquipe)
                        <option value="{{ $joueur->idJoueur }}" data-equipe="{{ $joueur->idEquipe }}">
                            {{ $joueur->personne->nom }} {{ $joueur->personne->prenom }}
                        </option>
                    @endif
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <input type="checkbox" id="useJoueurB4" name="useJoueurB4">
            <label for="useJoueurB4">Utiliser 4 joueurs pour l'équipe {{ $rencontre->equipeB->nomEquipe }}</label>
        </td>
    </tr>
@endif
</tbody>
</table>

<button type="submit">Enregistrer les modifications</button>
</form>
    <script>
        //Script pour filtrer les joueurs selon l'équipe sélectionnée
        document.addEventListener('DOMContentLoaded', function() {
            function filterPlayers(teamSelect, playerSelect) {
                //Récupérer l'id des équipes sélectionnées
                var selectedTeamId = teamSelect.value;
                //Récupérer les options du select
                var options = playerSelect.querySelectorAll('option');

                //Parcourir les options et afficher celles qui correspondent à l'équipe sélectionnée
                options.forEach(function(option) {
                    //Récupérer l'id de l'équipe du joueur
                    var joueurEquipeId = option.getAttribute('data-equipe');
                    //Afficher l'option si l'équipe du joueur correspond à l'équipe sélectionnée
                    if (selectedTeamId === joueurEquipeId) {
                        option.style.display = "block";
                    } else {
                        option.style.display = "none";
                    } 
                });
            }
            //Récupérer les éléments du DOM
            var equipeASelect = document.getElementById('equipeA');
            var equipeBSelect = document.getElementById('equipeB');
            var idJRSelect = document.querySelectorAll('.idJR');
            var idJVSelect = document.querySelectorAll('.idJV');
            //Écouter les changements sur les selects des équipes
            equipeASelect.addEventListener('change', function() {
                idJRSelect.forEach(function(select) {
                    filterPlayers(equipeASelect, select);
                });
            });
            equipeBSelect.addEventListener('change', function() {
                idJVSelect.forEach(function(select) {
                    filterPlayers(equipeBSelect, select);
                });
            });

            //Filtrer les joueurs au chargement de la page
            idJRSelect.forEach(function(select) {
                filterPlayers(equipeASelect, select);
            });
            idJVSelect.forEach(function(select) {
                filterPlayers(equipeBSelect, select);
            });
        });
    
    
    //Script pour mettre à jour les labels des forfaits
    //Lors du chargements de la page appelle de la fonction pour mettre à jour les labels
    window.onload =updateLabels();
    //Fontion pour mettre à jour les labels
    function updateLabels() {
    //Récupération des éléments des équipes et des labels
        var equipeA = document.getElementById('equipeA');
        var equipeB = document.getElementById('equipeB');
        var labelForfaitA = document.getElementById('labelForfaitA');
        var labelForfaitB = document.getElementById('labelForfaitB');
        //Récupération des équipes sélectionnées
        var selectedEquipeA = equipeA.options[equipeA.selectedIndex].text;
        var selectedEquipeB = equipeB.options[equipeB.selectedIndex].text;
        //Mise à jour des labels
        labelForfaitA.textContent = 'Forfait ' + selectedEquipeA;
        labelForfaitB.textContent = 'Forfait ' + selectedEquipeB;
}
document.addEventListener('DOMContentLoaded', function() {
    var useJoueurA4Checkbox = document.getElementById('useJoueurA4');
    var useJoueurB4Checkbox = document.getElementById('useJoueurB4');
    var joueurA4Row = document.getElementById('joueurA4Row');
    var joueurB4Row = document.getElementById('joueurB4Row');

    function toggleJoueurRow(checkbox, row, select) {
        if (row) {
            row.style.display = checkbox.checked ? '' : 'none';
            if (select) {
                select.required = checkbox.checked;
                if (!checkbox.checked) {
                    select.value = ''; // Réinitialiser la sélection
                }
            }
        }
    }

    if (useJoueurA4Checkbox && joueurA4Row) {
        var selectA4 = joueurA4Row.querySelector('select[name="idJR4"]');
        toggleJoueurRow(useJoueurA4Checkbox, joueurA4Row, selectA4);
        useJoueurA4Checkbox.addEventListener('change', function() {
            toggleJoueurRow(this, joueurA4Row, selectA4);
        });
    }

    if (useJoueurB4Checkbox && joueurB4Row) {
        var selectB4 = joueurB4Row.querySelector('select[name="idJV4"]');
        toggleJoueurRow(useJoueurB4Checkbox, joueurB4Row, selectB4);
        useJoueurB4Checkbox.addEventListener('change', function() {
            toggleJoueurRow(this, joueurB4Row, selectB4);
        });
    }
});
    </script>
@endsection
