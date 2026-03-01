@extends('layout.admin.admin')
@section('title', 'Simulation du Classement des Joueurs')

@section('content')

<h2>Simulation du Classement des Joueurs</h2>
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
                <div class="bleu text-center">Classement Simulé</div>
            </th>
        </tr>
    </thead>
    <tbody>
        @php
        $place = 1;
        @endphp
    @foreach ($classementsSimules as $joueur)
        <tr>
            <td>
                {{ $place++ }}
            </td>
            <td>
                {{ $joueur->personne->nom }} {{ $joueur->personne->prenom }}
            </td>
            <td>
                {{ $joueur->equipe->club->nomClub }}
            </td>
            <td>
                <i>{{ $joueur->classement_simule }}</i>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection