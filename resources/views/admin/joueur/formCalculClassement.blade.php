@extends('layout.admin.admin')
@section('title', 'Calcul du Classement - Tennis de table 17')
@section('content')

<h2>Basculement du classement</h2>
<hr>
<h4>Vous vous appretez à calculer le nouveau classement, regardez bien si toutes les rencontres souhaitez ont été remplis !</h4>

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

<form action="{{ route('admin.joueur.calculClassement') }}" method="POST">
    @METHOD('POST')
    @csrf
    <button type="submit" class="button primarybuttonBlue">
        <i class="fas fa-plus fa-sm"></i>&nbsp Calculer le nouveau classement
    </button>
</form>

@foreach($joueurs as $j)

<div class="joueur">
    <h3>{{ $j->personne->nom }} {{ $j->personne->prenom }}</h3>
    <p>Classement: {{ $j->classement }} <span style="color: {{ $j->classement_inter == 0 ? 'blue' : ($j->classement_inter > 1 ? 'green' : 'red') }}">
        {{ $j->classement_inter >= 0 ? '+' : '' }}{{ $j->classement_inter }} = {{ $j->classement + $j->classement_inter < 500 ? '('. $j->classement + $j->classement_inter .') 500' : $j->classement + $j->classement_inter}}
        </span>
    </p>
</div>

@endforeach


@endsection