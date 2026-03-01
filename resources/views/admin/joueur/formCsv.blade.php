@extends('layout.admin.admin')
@section('title', 'Importation de joueurs - Tennis de table 17')
@section('content')
@auth
<h2>Importation d'un classement individuel</h2>
<h4>Vous vous appretez à importer un nouveau classement à celui actuel.</h4>
<hr>
<br>

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


<h5>Attention, nous attendions que le fichier .csv que vous voulez envoyez contient bien ces informations suivantes :</h5>
<ul>
    <li>Les colonnes Nom, Prénom, Genre et Personne (pour la création des personnes).</li>
    <li>Concernant la colonne Personne, 0 = création de la personne</li>
    <li>Les colonnes classement, Classement FFTT, Licence (pour la création des joueurs).</li>
    <li>Les colonnes Equipe et Club (pour la liaison des joueurs).</li>
    <li>Les informations des équipes et des clubs doivent être correctement écrites.</li>
</ul>
<h5>Pour éviter des erreurs, ces 9 colonnes sont obligatoires !</h5>
<p>Si un joueur possède un compte, son identifiant et son mot de passe ne sera pas changé.</p>
<hr>
<br>
<p>L'importation supprimera le classement actuel et le remplacera par le nouveau, nous vous conseillons donc d'exporter le classement actuel par précaution.</p>

<form action="{{route('admin.importCsv')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @METHOD('POST')
    <div class="form-group">
        <label for="csv_file">Fichier CSV</label>
        <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
    </div>
    <button type="submit" class="btn btn-primary">Importer</button>
</form>

@endauth
@endsection