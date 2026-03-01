@extends('layout.admin.admin')
@section('title', 'Gestion des joueurs - Tennis de table 17')

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<h2>
    Classement individuel Charente-Maritime Saison
    <?= (date('Y') - 1) . '-' . (date('Y')); ?>
</h2>

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




<div class="button-group">
    <div class="button-item">
        <a href="{{ route('admin.formJoueur') }}" class="button primarybuttonBlue">
            <i class="fas fa-plus fa-sm"></i>&nbsp; Nouveau joueur
        </a>
    </div>
    <div class="button-item">
        <a href="{{ $button ? route('admin.joueur.calculClassement') : '#' }}" class="btn {{ $button ? 'btn-success' : 'btn-secondary' }}" {{ $button ? '' : 'style=pointer-events:none;' }}>
            Calcul du nouveau Classement
        </a>
        <form action="{{ route('admin.simulationClassement') }}" method="POST" class="d-inline">
            @csrf
            @method('POST')
            <input type="hidden" name="idEquipe" value="{{ $idEquipe ?? '' }}">
            <button type="submit" class="btn btn-primary">
                Simulation nouveau classement
            </button>
        </form>
    </div>
    <div class="button-item">
        <a href="{{ route('admin.formCsv') }}" class="btn btn-primary">
            Importation csv
        </a>
        <a href="{{ route('admin.exportCsv') }}" class="btn btn-primary" title="Exporter en CSV">
            Exportation CSV
        </a>
    </div>
</div>
<div>
    <input type="text" class="form-control" id="searchInput" onkeyup="searchPlayer()" placeholder="Rechercher un joueur par prénom ou nom">
</div>

<table class="data-table left-align-table">
    <thead class="thead-titre">
        <tr>
            <th colspan="3">
                <div class="bleu text-center">Informations joueurs</div>
            </th>
            <th colspan="2">
                <div class="bleu text-center">Classement</div>
            </th>
        </tr>
        <tr>
            <th>
                <div class="bleu text-center">Place</div>
            </th>
            <th>
                <div class="bleu text-center">Joueurs</div>
            </th>
            <th>
                <div class="bleu text-center">Club</div>
            </th>
            <th>
                <div class="bleu text-center">UFOLEP</div>
            </th>
            <th>
                <div class="bleu text-center">FFTT</div>
            </th>
        </tr>
    </thead>
    @if($joueurs->isEmpty())
    <tbody>
        <tr>
            <td>
                Aucun joueur trouvé
            </td>
        </tr>
    </tbody>
    @else
    <tbody>
    @php
    $place = 1;

    
    @endphp
    @foreach ($joueurs as $j)
        <tr>
            <td>
                {{ $place++ }}
            </td>
            <td>
                <a href="{{ route('joueur.detail', ['id' => $j->idJoueur]) }}">
                {{ $j->personne->nom }} {{ $j->personne->prenom }}</a>
            </td>
            <td>
                {{ $j->equipe->club->nomClub }}
            </td>
            <td>
                <b>
                    {{ $j->classement}}
                </b>
            </td>
            <td>
                <i>
                    @if($j->classement_fftt > 0)
                        {{ $j->classement_fftt }}
                    @endif
                </i>
            </td>
        </tr>
    @endforeach
    @endif
</tbody>
</table>

<script>
    //Script pour la recherche de joueur dans la liste
    function searchPlayer() {
        // Récupérer la valeur dans l'input
        const input = document.getElementById('searchInput');
        // Mettre la valeur dans le filtre
        const filter = input.value.toUpperCase();
        // Récupérer le tableau
        const table = document.querySelector('.data-table');
        const rows = table.getElementsByTagName('tr');
        // Parcourir les joueurs et cacher ceux qui ne correspondent pas à la recherche
        for (let i = 1; i < rows.length; i++) { // Commence à 1 pour éviter l'en-tête
            const row = rows[i];
            const nameCell = row.getElementsByTagName('td')[1]; // Nom et prénom sont dans la 2ème colonne
            if (nameCell) {
                const text = nameCell.textContent || nameCell.innerText;
                // Si le texte contient le filtre, on affiche la ligne
                if (text.toUpperCase().indexOf(filter) > -1) {
                    row.style.display = '';
                } else {
                    // Sinon, on cache la ligne
                    row.style.display = 'none';
                }
            }
        }
    }
</script>

@endsection
