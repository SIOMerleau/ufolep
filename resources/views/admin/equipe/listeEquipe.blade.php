@extends('layout.admin.admin')
@section('title', 'Gestion des joueurs - Tennis de table 17')

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<h2>Liste des équipes</h2>
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


<a href="{{route('admin.equipe.create')}}" class="button primarybuttonBlue">
    <i class="fas fa-plus fa-sm"></i>&nbsp Nouvelle équipe</a>

<a href="{{route('admin.formJoueur')}}" class="button primarybuttonWhite">
    Retour au tableau de bord</a>

<table class="data-table">
    <thead>
        <tr>
            <th>Nom de l'équipe</th>
            <th>Club</th>
            <th>Division</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($equipes as $e)
            <tr>
                <td>
                    <a href="{{route('admin.equipe.edit', ['id' => $e->idEquipe])}}">
                    {{ $e->nomEquipe }}</a>
                </td>
                <td>{{ $e->club->nomClub }}</td> <td>{{ $e->division->nomDivision }}</td> </tr>
        @endforeach
    </tbody>
</table>
@endsection