@extends('layout.guest.default')
@section('title', 'Classemet Joueur - Tennis de table 17')
@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<h1> Equipe {{$equipe->nomEquipe}}</h1>
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
    @if($joueur->isEmpty())
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
    // Variable pour le classement
    $place = 1;

    //Note : Pas besoin d'appeller la relation personne car elle est déjà appelée dans le contrôleur avec la jointure dans $joueurs
    @endphp
    @foreach ($joueur as $j)
        <tr>
            <td>
                {{ $place++ }}
            </td>
            <td>
                <a href="{{route('joueur.detail', ['id' => $j->idJoueur])}}">
                {{ $j->personne->nom }} {{ $j->personne->prenom }}</a>
            </td>
            <td>
                {{ $j->equipe->club->nomClub }}
            </td>
            <td>
                <b>
                    {{ $j->nbPoints}}
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

@endsection