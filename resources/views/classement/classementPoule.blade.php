@extends('layout.guest.default')
@section('title', 'Classement - Tennis de table 17')
@section('content')
@php

@endphp

<h2>{{$championnat->nomChampionnat . ' '. $championnat->typeChampionnat . ' ' . $championnat->division->nomDivision}}
    {{$championnat->nomPoule ? 'Poule ' . $championnat->nomPoule : 'Poule Unique.'}}
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

<h3>Classement des équipes</h3>
    <a class="button primarybuttonWhite" href="{{route('championnats.listeActuelle')}}">Retour aux championnats</a>
<hr>

<div>
    <table class="data-table">
    <thead>
        <th>Place</th>
        <th>Equipes participantes</th>
        <th>Points</th>
        <th>Goal average</th>
    </thead>
    @php $place = 1; @endphp
    @foreach($classement as $c)
        <tr>
            <td>{{$place++}}</td>
            <td>{{$c->equipe->nomEquipe}}</td>
            <td>{{$c->nbPoints}}</td>
            <td>{{$c->differ}}</td>
        </tr>
    @endforeach
    </table>
</div>

@endsection